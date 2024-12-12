$(document).ready(function() {
    let currentReceiverId = null;

    // Add function to toggle chat interface
    function toggleChatInterface(hasSelectedUser) {
        if (hasSelectedUser) {
            $('.no-user-selected').hide();
            $('.message-form').show();
        } else {
            $('.no-user-selected').show();
            $('.message-form').hide();
            $('#chat-box').html(`
                <div class="no-user-selected">
                    <i class="fas fa-comments mb-3" style="font-size: 3em;"></i>
                    <p>Select a user to start messaging</p>
                </div>
            `);
        }
    }

    // Initialize with no user selected
    toggleChatInterface(false);

    function fetchMessages(receiver_id) {
        // Store scroll info before refresh
        const chatBox = $('#chat-box');
        const wasAtBottom = (chatBox.scrollTop() + chatBox.innerHeight() + 30 >= chatBox[0].scrollHeight);

        $.ajax({
            url: '../../backend/adminFUNCTIONS/adminFetchMessages.php',
            method: 'GET',
            data: { receiver_id },
            dataType: 'json',
            success: function(messages) {
                chatBox.html('');
                messages.forEach(message => {
                    // Match userChat.js logic - compare receiver_id with passed parameter
                    const isReceiver = parseInt(message.receiver_id) === parseInt(receiver_id);
                    let attachmentHtml = '';
                
                    if (message.attachment_link) {
                        const fileExt = message.attachment_link.split('.').pop().toLowerCase();
                        if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
                            attachmentHtml = `
                                <div class="mt-2">
                                    <img src="../../${message.attachment_link}" style="max-width: 200px; max-height: 200px; border-radius: 5px;">
                                </div>`;
                        } else {
                            attachmentHtml = `
                                <div class="mt-2">
                                    <a href="../../${message.attachment_link}" class="btn btn-sm btn-light" download>
                                        <i class="fas fa-download"></i> Download Attachment
                                    </a>
                                </div>`;
                        }
                    }

                    messageHtml = `
                        <div style="display: flex; justify-content: ${isReceiver ? 'flex-end' : 'flex-start'}; margin: 10px 0;">
                            <div style="max-width: 70%; padding: 10px; border-radius: 10px; 
                                background-color: ${isReceiver ? '#007bff' : '#e3f2e0'}; 
                                color: ${isReceiver ? 'white' : 'black'};">
                                <div><strong>${isReceiver ? 'You' : message.sender_name}</strong></div>
                                <div>${message.message_text}</div>
                                ${attachmentHtml}
                                <small style="opacity: 0.7;">${message.timestamp}</small>
                            </div>
                        </div>
                    `;
                    chatBox.append(messageHtml);
                });

                // Only scroll to bottom if user was already at bottom
                if (wasAtBottom) {
                    chatBox.scrollTop(chatBox[0].scrollHeight);
                }
            }
        });
    }

    function fetchUsers() {
        $.ajax({
            url: '../../backend/adminFUNCTIONS/adminFetchUsers.php',
            method: 'GET',
            success: function(users) {
                const userList = $('#user-list');
                userList.empty();
                
                users.forEach(user => {
                    userList.append(`
                        <li class="user-item list-group-item" data-id="${user.user_id}">
                            ${user.first_name} ${user.last_name}
                        </li>
                    `);
                });
            }
        });
    }

    $('#chat-form').submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const receiver_id = $('#receiver_id').val();
        
        $.ajax({
            url: '../../backend/adminFUNCTIONS/adminFetchMessages.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    $('#message_text').val('');
                    $('#attachment').val('');
                    fetchMessages(receiver_id);
                }
            }
        });
    });

    // Add keypress handler for textarea
    $('#message_text').keypress(function(e) {
        // Check if Enter was pressed without Shift
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault(); // Prevent default line break
            $('#chat-form').submit(); // Submit the form
        }
    });

    // Update user click handler
    $('#user-list').on('click', '.user-item', function() {
        const receiver_id = $(this).data('id');
        currentReceiverId = receiver_id;
        const userName = $(this).text().trim();
        $('#receiver_id').val(receiver_id);
        $('#selected-user-name').text('with ' + userName).show();
        toggleChatInterface(true);
        fetchMessages(receiver_id);
    });

    // Auto-refresh messages every 3 seconds if a user is selected
    setInterval(function() {
        if (currentReceiverId) {
            fetchMessages(currentReceiverId);
        }
    }, 3000);

    fetchUsers();
});