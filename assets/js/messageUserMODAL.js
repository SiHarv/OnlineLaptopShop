function openMessageModal(email, orderId, product, quantity, unitPrice, totalPrice, paymentMethod, carrier) {
    $('#recipient_email').val(email);
    $('#order_id').val(orderId);
    $('#display_email').text(email);
    
    // Store order details in hidden inputs
    $('#product').val(product);
    $('#quantity').val(quantity);
    $('#unit_price').val(unitPrice);
    $('#total_price').val(totalPrice);
    $('#payment_method').val(paymentMethod);
    $('#carrier').val(carrier);
    
    $('#messageModal').modal('show');
}

$(document).ready(function() {
    $('#sendMessageBtn').click(function() {
        const formData = {
            recipient_email: $('#recipient_email').val(),
            order_id: $('#order_id').val(),
            message_content: $('#message_content').val(),
            product: $('#product').val(),
            quantity: $('#quantity').val(),
            unit_price: $('#unit_price').val(),
            total_price: $('#total_price').val(),
            payment_method: $('#payment_method').val(),
            carrier: $('#carrier').val()
        };

        $.ajax({
            type: 'POST',
            url: '../../includes/sendCustomerMESSAGE.php',
            data: formData,
            success: function(response) {
                // Properly cleanup modal
                $('#messageModal').modal('hide');
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('padding-right', '');
                $('#messageForm')[0].reset();
                alert('Message sent successfully!');
            },
            error: function(xhr, status, error) {
                alert('Error sending message: ' + error);
            }
        });
    });

    // Add event listener for modal hidden
    $('#messageModal').on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});