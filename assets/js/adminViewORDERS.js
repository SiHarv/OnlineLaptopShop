// assets/js/adminViewORDERS.js
$(document).ready(function() {
    fetchOrders();

    function fetchOrders() {
        $.ajax({
            url: '../../backend/adminFUNCTIONS/fetchALLORDERS.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let tableBody = '';
                data.forEach(function(order) {
                    tableBody += `
                        <tr>
                            <td>#${order.order_id}</td>
                            <td>${order.username}</td>
                            <td>${order.product_name}</td>
                            <td>${order.quantity}</td>
                            <td>₱${parseFloat(order.price).toFixed(2)}</td>
                            <td>₱${(parseFloat(order.price) * parseInt(order.quantity)).toFixed(2)}</td>
                            <td>${order.payment_option}</td>
                            <td>
                                <select class="form-select status-select" data-order-id="${order.order_id}">
                                    <option value="Pending" ${order.status === 'Pending' ? 'selected' : ''}>Pending</option>
                                    <option value="Out for Delivery" ${order.status === 'Out for Delivery' ? 'selected' : ''}>Out for Delivery</option>
                                    <option value="Complete" ${order.status === 'Complete' ? 'selected' : ''}>Complete</option>
                                    <option value="Canceled" ${order.status === 'Canceled' ? 'selected' : ''}>Canceled</option>
                                </select>
                            </td>
                            <td>${order.carrier || '-'}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm message-btn"
                                        data-toggle="modal" 
                                        data-target="#messageModal"
                                        data-email="${order.email}"
                                        data-orderid="${order.order_id}">
                                    <i class="fas fa-envelope"></i> Message
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('#ordersTableBody').html(tableBody);

                // Add change event listener to status dropdowns
                $('.status-select').on('change', function() {
                    const orderId = $(this).data('order-id');
                    const newStatus = $(this).val();
                    updateOrderStatus(orderId, newStatus);
                });

                // Add click event listener to message buttons
                $('.message-btn').on('click', function() {
                    const email = $(this).data('email');
                    const orderId = $(this).data('orderid');
                    
                    $('#recipient_email').val(email);
                    $('#order_id').val(orderId);
                    $('#display_email').text(email);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching orders:', error);
                alert('Error loading orders. Please try again.');
            }
        });
    }

    function updateOrderStatus(orderId, newStatus) {
        $.ajax({
            url: '../../backend/adminFUNCTIONS/updateOrderSTATUS.php',
            type: 'POST',
            data: {
                order_id: orderId,
                status: newStatus
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Order status updated successfully!');
                    fetchOrders(); // Refresh table
                } else {
                    alert('Failed to update status: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating status:', error);
                alert('Error updating order status. Please try again.');
            }
        });
    }

    // Refresh data every 30 seconds
    setInterval(fetchOrders, 30000);

    // Update message button click handler in adminViewORDERS.js
    $(document).on('click', '.btn-primary', function() {
        const email = $(this).data('email');
        const orderId = $(this).data('orderid');
        
        $('#recipient_email').val(email);
        $('#order_id').val(orderId);
        
        // Initialize and show modal
        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        messageModal.show();
    });

    // Handle send message button click
    $('#sendMessageBtn').click(function() {
        const formData = {
            recipient_email: $('#recipient_email').val(),
            message_content: $('#message_content').val(),
            order_id: $('#order_id').val()
        };

        console.log('Sending message with data:', formData); // Debug log

        $.ajax({
            url: '../../backend/adminFUNCTIONS/sendMessage.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response); // Debug log
                if (response.status === 'success') {
                    $('#messageModal').modal('hide');
                    $('#messageForm')[0].reset();
                } else {
                    alert('Failed to send message: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error details:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
            }
        });
    });
});