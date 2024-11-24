<link rel="stylesheet" href="../../assets/css/bootstrap.css">
<link rel="stylesheet" href="../../assets/css/userVIEW.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Proceed to Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="laptop-details"></div>
                <div class="form-group mt-3">
                    <label for="paymentOption">Payment Option</label>
                    <select class="form-control" id="paymentOption">
                        <option value="Cash on Delivery">Cash on Delivery</option>
                        <option value="Cash on Pickup">Cash on Pickup</option>
                        <option value="Meet Up">Meet Up</option>
                    </select>
                </div>
                <div class="form-group mt-3" id="carrier-group" style="display: none;">
                    <label for="carrier"><i class=""></i>Carrier</label>
                    <input type="text" id="carrier" name="carrier" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="proceedPayment">Proceed to Payment</button>
            </div>
        </div>
    </div>
</div>
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/your-code.js"></script>
<script src="../../assets/js/sidebar.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentOption = document.getElementById('paymentOption');
        const carrierGroup = document.getElementById('carrier-group');

        paymentOption.addEventListener('change', function() {
            if (this.value === 'Cash on Delivery' || this.value === 'Cash on Pickup') {
                carrierGroup.style.display = 'block';
            } else {
                carrierGroup.style.display = 'none';
            }
        });
    });
</script>