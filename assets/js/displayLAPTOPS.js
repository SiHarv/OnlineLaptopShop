// FILE: displayLaptops.js

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
            tile.className = 'col-md-4 mb-4';
            
            // Truncate description
            const maxLength = 100;
            let description = laptop.description;
            if (description.length > maxLength) {
                description = description.substring(0, maxLength) + '...';
            }

            // Stock class
            let stockClass = parseInt(laptop.stock) === 0 ? 'text-danger text-decoration-line-through' : '';

            tile.innerHTML = `
                <div class="card h-100">
                    <img src="../../uploads/${laptop.image_url}" class="card-img-top" alt="${laptop.name}" style="height: 200px; object-fit: contain;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">${laptop.name}</h5>
                        <p class="card-text mb-1 flex-grow-1">${description}</p>
                        <div class="mt-auto">
                            <p class="card-text mb-1"><strong>Price: ₱${laptop.price}</strong></p>
                            <p class="card-text mb-1 ${stockClass}">Stock: ${laptop.stock}</p>
                            <div class="d-flex " style="gap:10px">
                                <button class="btn btn-primary btn-sm add-to-cart" data-product-id="${laptop.product_id}">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <button class="btn btn-success btn-sm buy-now" data-product-id="${laptop.product_id}" data-product-name="${laptop.name}" data-product-price="${laptop.price}">
                                    <i class="fas fa-money-bill"></i> Buy
                                </button>
                            </div>
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
                const productPrice = this.getAttribute('data-product-price');
                showPaymentModal(productId, productName, productPrice);
            });
        });
    }

    // Search and filter function
    function filterLaptops() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const priceFilter = document.getElementById('priceFilter').value;

        const filtered = laptopsData.filter(laptop => {
            // Search term filter
            const matchesSearch = laptop.name.toLowerCase().includes(searchTerm) ||
                                laptop.description.toLowerCase().includes(searchTerm);

            // Price filter
            let matchesPrice = true;
            if (priceFilter) {
                const price = parseFloat(laptop.price);
                const [min, max] = priceFilter.split('-').map(val => val === '+' ? Infinity : parseFloat(val));
                matchesPrice = price >= min && (max === Infinity || price <= max);
            }

            return matchesSearch && matchesPrice;
        });

        displayLaptops(filtered);
    }

    // Event listeners
    document.getElementById('searchInput').addEventListener('input', filterLaptops);
    document.getElementById('priceFilter').addEventListener('change', filterLaptops);

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
