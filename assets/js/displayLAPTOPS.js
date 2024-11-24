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
                                <button class="btn btn-success btn-sm buy-now" data-product-id="${laptop.product_id}" data-product-name="${laptop.name}" data-product-price="${laptop.price}">Buy</button>
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
        })
        .catch(error => console.error('Error fetching laptops:', error));
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


function showPaymentModal(productId, productName, productPrice) {
    const laptopDetails = document.getElementById('laptop-details');
    laptopDetails.innerHTML = `
        <p><strong>Product:</strong> ${productName}</p>
        <p><strong>Price:</strong> ₱${productPrice}</p>
    `;
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    paymentModal.show();

    document.getElementById('proceedPayment').onclick = function() {
        proceedToPayment(productId, productPrice);
    };
}

function proceedToPayment(productId, productPrice) {
    const paymentOption = document.getElementById('paymentOption').value;
    const carrier = document.getElementById('carrier').value;

    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('total_amount', productPrice);
    formData.append('payment_option', paymentOption);
    formData.append('carrier', carrier);

    fetch('../../backend/userFUNCTIONS/proceedPAYMENT.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Order placed successfully!');
            window.location.reload();
        } else {
            alert('Failed to place order');
        }
    })
    .catch(error => {
        console.error('Error placing order:', error);
        alert('Error placing order');
    });
}