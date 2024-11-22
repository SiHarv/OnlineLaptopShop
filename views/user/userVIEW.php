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
    <title>Laptop Shop - Welcome <?php echo $_SESSION['username']; ?></title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            transition: transform 0.2s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            padding: 1rem;
            background: #f8f9fa;
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card-text {
            flex-grow: 1;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 20px;
            position: fixed;  /* Make sidebar fixed */
            top: 0;          /* Align to top */
            left: 0;         /* Align to left */
            height: 100vh;   /* Full viewport height */
            overflow-y: auto; /* Allow scrolling if content is too long */
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        @media (max-width: 768px) {
            .sidebar-backdrop.show {
                display: block;
            }
        }

        .main-content {
            margin-left: 250px; /* Add margin equal to sidebar width */
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background: #212529;
            color: white;
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            color: rgba(255,255,255,.8);
            padding: 8px 16px;
            transition: all 0.3s;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(255,255,255,.1);
            text-decoration: none;
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
        }

        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        
        <div class="main-content">
            <!--  Header -->
            <?php include 'userHEADER.php'; ?>
            <!-- Main Content -->
            <div class="content p-4">
                <h3>Available Laptops</h3>
                <div id="laptop-container" class="row g-4"></div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/your-code.js"></script>
    <script src="../../assets/js/displayLAPTOPS.js"></script>
    <!-- Add this JavaScript before closing body tag -->  
</body>
</html>