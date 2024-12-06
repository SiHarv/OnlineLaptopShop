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
        // Get the total amount from the URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const totalAmount = urlParams.get('totalAmount');

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
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    // Optionally, you can redirect the user to a success page or update your database
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