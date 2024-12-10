// FILE: displayLaptops.js

// Function to format number with commas
function formatNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

document.addEventListener('DOMContentLoaded', function() {
    let laptopsData = []; // Store all laptops data

    // Fetch laptops
    function fetchLaptops() {
        fetch('../../backend/userFUNCTIONS/fetchLAPTOP.php')
            .then(response => response.json())
            .then(data => {
                laptopsData = data; // Store the data
                displayLaptops(data); // Initial display
            })
            .catch(error => console.error('Error:', error));
    }

    // Display laptops
    function displayLaptops(laptops) {
        const container = document.getElementById('laptop-container');
        container.innerHTML = ''; // Clear existing content

        laptops.forEach(laptop => {
            const tile = document.createElement('div');
            // Update class to work better with mobile
            tile.className = 'col-6 col-md-4 mb-4'; // col-6 makes it 2 per row on mobile

            // Truncate name
            const nameMaxLength = 30;
            let displayName = laptop.name;
            if (displayName.length > nameMaxLength) {
                displayName = displayName.substring(0, nameMaxLength) + '...';
            }
            
            // Truncate description
            const maxLength = 50;
            let description = laptop.description;
            if (description.length > maxLength) {
                description = description.substring(0, maxLength) + '...';
            }

            // Stock check
            const isOutOfStock = parseInt(laptop.stock) === 0;
            let stockClass = isOutOfStock ? 'text-danger text-decoration-line-through' : '';
            
            // Disable buy button if out of stock
            const buyButtonDisabled = isOutOfStock ? 'disabled' : '';
            const buyButtonClass = isOutOfStock ? 'btn btn-success btn-sm buy-now disabled' : 'btn btn-success btn-sm buy-now';

            tile.innerHTML = `
                <div class="card h-100" data-laptop='${JSON.stringify(laptop)}'>
                    <img src="../../uploads/${laptop.image_url}" class="card-img-top modal-trigger" alt="${laptop.name}" style="height: 200px; object-fit: contain; cursor: pointer;">
                    <div class="card-body d-flex flex-column">
                        <div class="details-container modal-trigger" style="cursor: pointer;">
                            <h5 class="card-title mb-1">${displayName}</h5>
                            <p class="card-text mb-1 flex-grow-1">${description}</p>
                            <div class="specs-details mt-auto d-none d-md-block">
                                <p class="card-text mb-1"><strong>CPU: ${laptop.cpu}</strong></p>
                                <p class="card-text mb-1"><strong>GPU: ${laptop.gpu}</strong></p>
                                <p class="card-text mb-1"><strong>Price: ₱${formatNumberWithCommas(laptop.price)}</strong></p>
                                <p class="card-text mb-1 ${stockClass}">Stock: ${laptop.stock}</p>
                            </div>
                            <div class="price-mobile d-md-none">
                                <p class="card-text mb-1"><strong>₱${formatNumberWithCommas(laptop.price)}</strong></p>
                            </div>
                        </div>
                        <div class="action-buttons d-flex" style="gap:10px">
                            <button class="btn btn-primary btn-sm add-to-cart" data-product-id="${laptop.product_id}">
                                <i class="fas fa-shopping-cart"> Add to Cart</i>
                            </button>
                            <button class="${buyButtonClass}" data-product-id="${laptop.product_id}" data-product-name="${laptop.name}" data-product-price="${laptop.price}" ${buyButtonDisabled}>
                                <i class="fas fa-money-bill"> Buy</i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(tile);
        });

        // Add click handlers for Add to Cart buttons
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                addToCart(productId);
            });
        });

        // Add click handlers for Buy buttons
        document.querySelectorAll('.buy-now').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                const productPrice = parseFloat(this.getAttribute('data-product-price').replace(/,/g, ''));
                showPaymentModal(productId, productName, productPrice);
            });
        });

        // Add click handler for cards
        document.querySelectorAll('.modal-trigger').forEach(element => {
            element.addEventListener('click', function(e) {
                const laptopData = JSON.parse(this.closest('.card').dataset.laptop);
                document.getElementById('modalLaptopName').textContent = laptopData.name;
                document.getElementById('modalLaptopImage').src = `../../uploads/${laptopData.image_url}`;
                document.getElementById('modalLaptopDescription').textContent = laptopData.description;
                document.getElementById('modalLaptopCPU').textContent = laptopData.cpu;
                document.getElementById('modalLaptopGPU').textContent = laptopData.gpu;
                document.getElementById('modalLaptopPrice').textContent = formatNumberWithCommas(laptopData.price);
                document.getElementById('modalLaptopStock').textContent = laptopData.stock;
                
                const modal = new bootstrap.Modal(document.getElementById('laptopDetailModal'));
                modal.show();
            });
        });
    }

    // Search and filter function
    function filterLaptops() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const priceFilter = document.getElementById('priceFilterModal').value;

        let filtered = laptopsData;

        // Apply search term filter
        if (searchTerm) {
            filtered = filtered.filter(laptop => {
                const matchesSearch = laptop.name.toLowerCase().includes(searchTerm) ||
                         laptop.description.toLowerCase().includes(searchTerm) ||
                         laptop.cpu.toLowerCase().includes(searchTerm) ||
                         laptop.gpu.toLowerCase().includes(searchTerm);

                return matchesSearch;
            });
        }

        // Apply price filter
        if (priceFilter === 'low-to-high') {
            filtered.sort((a, b) => a.price - b.price);
        } else if (priceFilter === 'high-to-low') {
            filtered.sort((a, b) => b.price - a.price);
        }

        displayLaptops(filtered);
    }

    // Event listeners
    document.getElementById('searchInput').addEventListener('input', filterLaptops);

    // Event listeners for modal inputs
    document.getElementById('applyFilters').addEventListener('click', function() {
        const priceFilter = document.getElementById('priceFilterModal').value;

        filterLaptops();
        $('#sortFilterModal').modal('hide');
    });

    // Initial fetch
    fetchLaptops();
});

function addToCart(productId) {
    const formData = new FormData();
    formData.append('product_id', productId);

    fetch('../../backend/userFUNCTIONS/Cart/addToCART.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message); // You can replace this with a nicer notification
        } else {
            alert('Failed to add item to cart');
        }
    })
    .catch(error => {
        console.error('Error adding to cart:', error);
        alert('Error adding item to cart');
    });
}
