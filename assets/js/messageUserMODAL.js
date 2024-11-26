function openMessageModal(email, orderId) {
    $('#recipient_email').val(email);
    $('#order_id').val(orderId);
    $('#display_email').text(email);
    $('#messageModal').modal('show');
}

$(document).ready(function() {
    $('#sendMessageBtn').click(function() {
        const formData = {
            recipient_email: $('#recipient_email').val(),
            order_id: $('#order_id').val(),
            message_content: $('#message_content').val()
        };

        $.ajax({
            type: 'POST',
            url: '../../includes/sendCustomerMESSAGE.php',
            data: formData,
            success: function(response) {
                alert('Message sent successfully!');
                $('#messageModal').modal('hide');
                $('#messageForm')[0].reset();
            },
            error: function(xhr, status, error) {
                alert('Error sending message: ' + error);
            }
        });
    });
});