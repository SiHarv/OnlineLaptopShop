<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../loginPAGE.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - <?php echo $_SESSION['username']; ?></title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/userCartVIEW.css">
    
</head>
<body>
    <div class="wrapper">
        <!-- Include Header here -->
        <?php include 'sidebar.php'; ?>

        <div class="main-content">
            <div class="container">
                <h2 class="mb-4">Shopping Cart</h2>
                <div id="cart-items"></div>
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Total: $<span id="cart-total">0.00</span></h4>
                            <button class="btn btn-success" id="checkout-btn">Proceed to Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/userCartVIEW.js"></script>
</body>
</html>