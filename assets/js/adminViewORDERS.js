$(document).ready(function() {
    fetchOrders();

    // Add event listener for the Export PDF button
    $('#exportPdfBtn').on('click', function() {
        exportTableToPDF();
    });

    // Select All Checkbox
    $('#selectAll').on('change', function() {
        $('input[type="checkbox"].order-checkbox').prop('checked', this.checked);
    });

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
                            <td><input type="checkbox" class="order-checkbox" data-order-id="${order.order_id}"></td>
                            <td>${order.location}</td>
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
                                    <option value="Complete" ${order.status === 'Returned' ? 'Returned' : ''}>Complete</option>
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
                    const product = $(this).closest('tr').find('td:nth-child(4)').text();
                    const quantity = $(this).closest('tr').find('td:nth-child(5)').text();
                    const unitPrice = $(this).closest('tr').find('td:nth-child(6)').text();
                    const totalPrice = $(this).closest('tr').find('td:nth-child(7)').text();
                    const paymentMethod = $(this).closest('tr').find('td:nth-child(8)').text();
                    const carrier = $(this).closest('tr').find('td:nth-child(10)').text();
                    
                    $('#recipient_email').val(email);
                    $('#order_id').val(orderId);
                    $('#product').val(product);
                    $('#quantity').val(quantity);
                    $('#unitPrice').val(unitPrice);
                    $('#totalPrice').val(totalPrice);
                    $('#paymentMethod').val(paymentMethod);
                    $('#carrier').val(carrier);

                    $('#display_email').text(email);
                    $('#display_product').text(product);
                    $('#display_quantity').text(quantity);
                    $('#display_unitPrice').text(unitPrice);
                    $('#display_totalPrice').text(totalPrice);
                    $('#display_paymentMethod').text(paymentMethod);
                    $('#display_carrier').text(carrier);
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

    function exportTableToPDF() {
        const selectedRows = Array.from(document.querySelectorAll('.order-checkbox:checked')).map(checkbox => {
            return checkbox.closest('tr');
        });

        const data = selectedRows.map(row => {
            return Array.from(row.querySelectorAll('th, td')).map((cell, index) => {
                // Exclude the last column (Message)
                if (index < row.children.length - 1) {
                    return cell.textContent;
                }
            }).filter(cell => cell !== undefined);
        });

        $.ajax({
            url: '../../backend/adminFUNCTIONS/exportPDF.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ data: data }),
            success: function(response) {
                const link = document.createElement('a');
                link.href = 'data:application/pdf;base64,' + response;
                link.download = 'orders.pdf';
                link.click();
            },
            
        });
    }

    // Refresh data every 30 seconds
    setInterval(fetchOrders, 30000);
});