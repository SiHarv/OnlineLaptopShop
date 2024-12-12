$(document).ready(function() {
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
                    messageHtml = `
                        <div style="display: flex; justify-content: ${isReceiver ? 'flex-end' : 'flex-start'}; margin: 10px 0;">
                            <div style="max-width: 70%; padding: 10px; border-radius: 10px; 
                                background-color: ${isReceiver ? '#007bff' : '#e3f2e0'}; 
                                color: ${isReceiver ? 'white' : 'black'};">
                                <div><strong>${isReceiver ? 'You' : message.sender_name}</strong></div>
                                <div>${message.message_text}</div>
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

    $('#chat-form').submit(function(e) {
        e.preventDefault();
        const receiver_id = $('#receiver_id').val();
        const message_text = $('#message_text').val();

        if (!message_text.trim()) return;

        $.ajax({
            url: '../../backend/adminFUNCTIONS/adminFetchMessages.php',
            method: 'POST',
            data: { receiver_id, message_text },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#message_text').val('');
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

    // Click handler for user selection
    $('#user-list').on('click', '.user-item', function() {
        const receiver_id = $(this).data('id');
        const userName = $(this).text().trim();
        $('#receiver_id').val(receiver_id);
        $('#selected-user-name').text('with ' + userName).show();
        fetchMessages(receiver_id);
    });

    // Auto-refresh messages every 3 seconds if a user is selected
    setInterval(function() {
        const receiver_id = $('#receiver_id').val();
        if (receiver_id) {
            fetchMessages(receiver_id);
        }
    }, 3000);
});