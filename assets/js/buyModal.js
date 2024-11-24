document.addEventListener('DOMContentLoaded', function() {
    const paymentOption = document.getElementById('paymentOption');
    const carrierGroup = document.getElementById('carrier-group');
    const qtyInput = document.getElementById('qty');
    const totalAmountSpan = document.getElementById('totalAmount');
    const totalAmountInput = document.getElementById('totalAmountInput');

    // Show qty input
    document.getElementById('qtyGroup').style.display = 'block';

    paymentOption.addEventListener('change', function() {
        if (this.value === 'Cash on Delivery' || this.value === 'Cash on Pickup') {
            carrierGroup.style.display = 'block';
        } else {
            carrierGroup.style.display = 'none';
        }
    });

    // Update total when quantity changes
    qtyInput.addEventListener('input', function() {
        const priceElement = document.querySelector('#laptop-details p:nth-child(2)');
        const basePrice = parseFloat(priceElement.textContent.split('₱')[1]);
        const quantity = parseInt(this.value) || 0;
        const total = basePrice * quantity;
        
        totalAmountSpan.textContent = '₱' + total.toFixed(2);
        totalAmountInput.value = total.toFixed(2);
    });

    // Set initial quantity to 1 and trigger calculation
    qtyInput.value = 1;
    qtyInput.dispatchEvent(new Event('input'));
});



function showPaymentModal(productId, productName, productPrice) {
    console.log('Modal opened with:', { productId, productName, productPrice });
    
    const laptopDetails = document.getElementById('laptop-details');
    laptopDetails.innerHTML = `
        <p><strong>Product:</strong> ${productName}</p>
        <p><strong>Price:</strong> ₱${productPrice}</p>
    `;
    
    // Reset and recalculate total
    const qtyInput = document.getElementById('qty');
    qtyInput.value = 1;
    qtyInput.dispatchEvent(new Event('input'));

    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    paymentModal.show();

    document.getElementById('proceedPayment').onclick = function() {
        console.log('Proceed button clicked with productId:', productId);
        proceedToPayment(productId, productName, productPrice);
    };
}

function proceedToPayment(productId, productName, productPrice) {
    console.log('Starting payment process with:', {
        productId: productId,
        productName: productName,
        basePrice: productPrice,
        quantity: document.getElementById('qty').value,
        paymentOption: document.getElementById('paymentOption').value,
        carrier: document.getElementById('carrier').value
    });

    const qty = document.getElementById('qty').value;
    const paymentOption = document.getElementById('paymentOption').value;
    const carrier = document.getElementById('carrier').value;
    const totalAmount = parseFloat(productPrice) * parseInt(qty);

    console.log('Calculated total amount:', totalAmount);

    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('qty', qty);
    formData.append('totalAmount', totalAmount.toFixed(2));
    formData.append('payment_option', paymentOption);
    formData.append('carrier', carrier);

    console.log('FormData entries:');
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    fetch('../../backend/userFUNCTIONS/proceedPAYMENT.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        console.log('Raw server response:', text);
        return JSON.parse(text);
    })
    .then(data => {
        console.log('Parsed server response:', data);
        if (data.status === 'success') {
            alert('Order placed successfully!');
            window.location.reload();
        } else {
            
        }
    })
    .catch(error => {
        console.error('Error details:', error);
        alert('Error placing order: ' + error.message);
    });
}