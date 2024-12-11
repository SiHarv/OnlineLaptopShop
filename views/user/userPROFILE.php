<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../loginPAGE.php");
    exit();
}

include '../../config/database.php';

if (isset($_POST['update'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password == $confirmpassword) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `Users` SET `username`='$username', `first_name`='$first_name', `last_name`='$last_name', `phone_number`='$phone_number', `location`='$location', `email`='$email', `password`='$hash' WHERE `id`='$user_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: userPROFILE.php?update=success");
        } else {
            header("Location: userPROFILE.php?update=failed");
        }
    } else {
        header("Location: userPROFILE.php?error=Passwords do not match!");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/userPROFILE.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <?php include 'userHEADER.php'; ?>
        <div class="content p-4 d-flex justify-content-center align-items-center">
            <div class="background">
                <img src="../../assets/images/no-bg-images/laptop1.png" class="laptop-shape first-shape" alt="laptop">
                <img src="../../assets/images/no-bg-images/laptop2.png" class="laptop-shape second-shape" alt="laptop">
            </div>
            <div class="registration-container">
                <h3>Update Profile</h3>
                <form method="POST" action="userPROFILE.php" class="registration-form">
                    <div class="form-group">
                        <label for="username"><i class="fas fa-user"></i> Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="first_name"><i class="fas fa-user"></i> First Name</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name"><i class="fas fa-user"></i> Last Name</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number"><i class="fas fa-phone"></i> Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label for="location"><i class="fas fa-map-marker-alt"></i> Location</label>
                        <input type="text" id="location" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword"><i class="fas fa-lock"></i> Confirm Password</label>
                        <input type="password" id="confirmpassword" name="confirmpassword" required>
                    </div>
                    <button type="submit" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
</body>
</html>