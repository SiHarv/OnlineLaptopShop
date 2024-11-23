<link rel="stylesheet" href="../../assets/css/userHEADER.css">
<header class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div class="user-info">
            <i class="fas fa-user-circle fa-2x"></i>
            <span>Welcome, <?php echo $_SESSION['username']; ?></span>
        </div>
        <!-- Add toggle button for mobile -->
        <button class="btn btn-dark d-md-none me-2" id="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="https://kit.fontawesome.com/your-code.js"></script>
