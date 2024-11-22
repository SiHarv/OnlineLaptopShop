<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="../../backend/accountVERIFY.php" method="post">
            <input type="hidden" name="email" value="<?php if (isset($_GET['email'])) {echo $_GET['email']; } ?>">
            <label for="otp">Enter OTP:</label>
            <div>
            <input type="text" name="otp"><br>
            </div>
            <br>
            <input type="submit" name="verify" value="Verify">
        </form>
</body>
</html>