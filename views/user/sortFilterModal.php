<!-- FILE: sortFilterModal.php -->
<div class="modal fade" id="sortFilterModal" tabindex="-1" aria-labelledby="sortFilterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sortFilterModalLabel">Sort and Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="priceFilterModal">Sort by Price</label>
                    <select id="priceFilterModal" class="form-control">
                        <option value="">All Prices</option>
                        <option value="low-to-high">Price: Low to High</option>
                        <option value="high-to-low">Price: High to Low</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="applyFilters" data-dismiss="modal">Apply</button>
            </div>
        </div>
    </div>
</div>