$(document).ready(function() {
    function loadReturnOrders() {
        $.ajax({
            url: '../../backend/adminFUNCTIONS/fetchReturnOrders.php',
            type: 'GET',
            success: function(response) {
                if(response.returns) {
                    let html = '';
                    response.returns.forEach(function(ret) {
                        html += `
                            <tr>
                                <td>${ret.username}</td>
                                <td>${ret.product_name}</td>
                                <td>${ret.reason}</td>
                                <td><img src="../../${ret.image_path}" width="50" height="50"></td>
                                <td>
                                    <select class="form-select status-select" data-return-id="${ret.return_id}">
                                        <option value="Pending" ${ret.status === 'Pending' ? 'selected' : ''}>Pending</option>
                                        <option value="Approved" ${ret.status === 'Approved' ? 'selected' : ''}>Approved</option>
                                        <option value="Rejected" ${ret.status === 'Rejected' ? 'selected' : ''}>Rejected</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm view-btn" data-id="${ret.return_id}">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#returnOrdersTable').html(html);

                    // Add change event listener to status dropdowns
                    $('.status-select').on('change', function() {
                        const returnId = $(this).data('return-id');
                        const newStatus = $(this).val();
                        updateReturnStatus(returnId, newStatus);
                    });
                }
            }
        });
    }

    function updateReturnStatus(returnId, newStatus) {
        // Confirm before updating
        if (confirm(`Are you sure you want to update this return status to ${newStatus}?`)) {
            $.ajax({
                url: '../../backend/adminFUNCTIONS/updateReturnStatus.php',
                type: 'POST',
                data: {
                    return_id: returnId,
                    status: newStatus
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert(`Return status successfully updated to ${newStatus}!`);
                        loadReturnOrders();
                    } else {
                        alert('Error: ' + (response.message || 'Failed to update status'));
                        loadReturnOrders(); // Reload to reset select
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Failed to update status. Please try again.');
                    loadReturnOrders(); // Reload to reset select
                }
            });
        } else {
            loadReturnOrders(); // Reset select if cancelled
        }
    }

    // Initial load
    loadReturnOrders();

    // Refresh every 30 seconds
    setInterval(loadReturnOrders, 30000);
});