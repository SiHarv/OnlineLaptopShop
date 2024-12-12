$(document).ready(function() {
    function fetchMessages() {
        // Store scroll info before refresh
        const chatBox = $('#chat-box');
        const wasAtBottom = (chatBox.scrollTop() + chatBox.innerHeight() + 30 >= chatBox[0].scrollHeight);

        $.ajax({
            url: '../../backend/userFUNCTIONS/userFetchMessages.php',
            method: 'GET',
            data: { receiver_id: 2 },
            dataType: 'json',
            success: function(messages) {
                $('#chat-box').html('');
                messages.forEach(message => {
                    const isReceiver = message.receiver_id === 2;
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
                    $('#chat-box').append(messageHtml);
                });
                
                // Only scroll if user was at bottom
                if (wasAtBottom) {
                    chatBox.scrollTop(chatBox[0].scrollHeight);
                }
            }
        });
    }

    $('#chat-form').submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('receiver_id', 2);
        
        $.ajax({
            url: '../../backend/userFUNCTIONS/userFetchMessages.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    $('#message_text').val('');
                    $('#attachment').val('');
                    fetchMessages();
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

    fetchMessages();
    setInterval(fetchMessages, 3000);
});