<link rel="stylesheet" href="../../assets/css/bootstrap.css">
<link rel="stylesheet" href="../../assets/css/userSIDEBAR.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Sidebar -->
<nav class="sidebar">
    <h3 class="mb-4">My Dashboard</h3>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="userVIEW.php">
                <i class="fas fa-home"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userCartVIEW.php">
                <i class="fas fa-shopping-cart"></i> My Cart
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userOrderHISTORY.php">
                <i class="fas fa-history"></i> Order History
            </a>
        <li class="nav-item"></li>
            <a class="nav-link" href="userMESSAGES.php">
            <i class="fas fa-envelope"></i> Message Admin
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userPROFILE.php">
            <i class="fas fa-user"></i> Profile
            </a>
        </li>
        <li class="nav-item"></li>
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutConfirmModal">
            <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</nav>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutConfirmModal" tabindex="-1" role="dialog" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutConfirmModalLabel">Logout Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="../../backend/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="https://kit.fontawesome.com/your-code.js"></script>
<script src="../../assets/js/sidebar.js"></script>
<script>
    $(document).ready(function() {
        $('#confirmLogout').click(function() {
            window.location.href = '../../backend/logout.php';
        });
    });
</script>