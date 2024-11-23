<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../assets/css/loginPage.css"> <!-- Link to your actual CSS file -->
</head>
<body>
    <header>
        <h1>Welcome to Our Website</h1>
    </header>
    <div class="login-container">
        <h2 class="login-title">Login Page</h2>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form class="login-form" action="../backend/accountLOGIN.php" method="post">
            <div class="form-group">
                <label for="email">Email or Username:</label>
                <input type="text" id="email" name="emailOrUsername" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="login" value="1">
                <button type="submit" class="login-button">Login</button>
            </div>
        </form>
        <p class="forgot-password"><a href="forgot_password.php">Forgot Password?</a></p>
        <p class="register"><a href="user/userREGISTER.php">Register</a></p>
    </div>
    <footer>
        <p>&copy; 2024 Our Website. All rights reserved.</p>
    </footer>
</body>
</html>
