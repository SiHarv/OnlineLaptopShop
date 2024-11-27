<!-- messageUserModal.php -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Send Message to Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="messageForm">
                    <input type="hidden" id="recipient_email" name="recipient_email">
                    <input type="hidden" id="order_id" name="order_id">
                    <div class="mb-3">
                        <label class="form-label">Sending to: <span id="display_email" class="text-primary"></span></label>
                    </div>
                    <div class="mb-3">
                        <label for="message_content" class="form-label">Message</label>
                        <textarea class="form-control" id="message_content" name="message_content" rows="4" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="sendMessageBtn">Send Message</button>
            </div>
        </div>
    </div>
</div>