// FILE: displayLaptops.js

document.addEventListener('DOMContentLoaded', function() {
    fetch('../../backend/userFUNCTIONS/fetchLAPTOP.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('laptop-container');
            data.forEach(laptop => {
                const tile = document.createElement('div');
                tile.className = 'col-md-4 mb-4';
                tile.innerHTML = `
                    <div class="card h-100">
                        <img src="../../uploads/${laptop.image_url}" class="card-img-top" alt="${laptop.name}" style="height: 200px; object-fit: contain;">
                        <div class="card-body">
                            <h5 class="card-title">${laptop.name}</h5>
                            <p class="card-text">${laptop.description}</p>
                            <p class="card-text"><strong>Price: ₱${laptop.price}</strong></p>
                            <p class="card-text text-muted">Stock: ${laptop.stock}</p>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary btn-sm add-to-cart" data-product-id="${laptop.product_id}">Add to Cart</button>
                                <button class="btn btn-success btn-sm">Buy</button>
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
        })
        .catch(error => console.error('Error fetching laptops:', error));
});

function addToCart(productId) {
    const formData = new FormData();
    formData.append('product_id', productId);

    fetch('../../backend/userFUNCTIONS/addToCART.php', {
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