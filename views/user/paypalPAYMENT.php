<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Payment</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AfT2gltVx7p_ayYSMKIffKAPcpyR8ADMEw5n95kjpXZ560zuX7rfN3Pioye9NK63HFZ8j2Q3CKG-q2ct&currency=PHP"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pay with PayPal</h1>
        <div id="paypal-button-container"></div>
    </div>

    <script>
        // Get the total amount and other details from the URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const totalAmount = urlParams.get('totalAmount');
        const productId = urlParams.get('productId');
        const qty = urlParams.get('qty');
        const paymentOption = urlParams.get('paymentOption');
        const carrier = urlParams.get('carrier');

        console.log('Redirected to PayPal payment page with:', {
            totalAmount: totalAmount,
            productId: productId,
            qty: qty,
            paymentOption: paymentOption,
            carrier: carrier
        });

        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: totalAmount // Use the total amount from the URL parameters
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    /* alert('Transaction completed by ' + details.payer.name.given_name); */

                    console.log('Payment approved with details:', details);

                    // Send the payment details and order details to proceedPAYMENT.php
                    fetch('../../backend/userFUNCTIONS/proceedPAYMENT.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            qty: qty,
                            totalAmount: totalAmount,
                            carrier: carrier,
                            payment_option: paymentOption,
                            order_id: details.id,
                            status: details.status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Response from proceedPAYMENT.php:', data);
                        if (data.status === 'success') {
                            window.alert('Transaction completed by ' + details.payer.name.given_name);
                            // Redirect after alert is closed
                            window.onbeforeunload = null;
                            setTimeout(() => {
                                window.location.href = 'userVIEW.php';
                            }, 1000);
                        } else {
                            alert('Failed to place order: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while placing the order. Please try again.');
                    });
                });
            },
            onError: function(err) {
                console.error('PayPal Checkout onError', err);
                alert('An error occurred during the transaction. Please try again.');
            }
        }).render('#paypal-button-container'); // Render the PayPal button into the container
    </script>
</body>
</html>