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
    <link rel="stylesheet" href="../../assets/css/userVIEW.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <?php include 'buyMODAL.php'; ?>

    <!-- Laptop Detail Modal -->
    <?php include 'laptopDetailModal.php'; ?>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        
        <div class="main-content">
            <!--  Header -->
            <?php include 'userHEADER.php'; ?>
            <!-- Main Content -->
            <div class="content p-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4>Available Laptops</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex " style="gap: 10px">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search laptops...">
                                    <select id="priceFilter" class="form-select">
                                        <option value="">Filter by Price</option>
                                        <option value="0-20000">₱0 - ₱20,000</option>
                                        <option value="20001-40000">₱20,001 - ₱40,000</option>
                                        <option value="40001-60000">₱40,001 - ₱60,000</option>
                                        <option value="60001+">Above ₱60,000</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="laptop-container" class="row g-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/your-code.js"></script>
    <script src="../../assets/js/displayLAPTOPS.js"></script>
    <script src="../../assets/js/sidebar.js"></script>

</body>
</html>