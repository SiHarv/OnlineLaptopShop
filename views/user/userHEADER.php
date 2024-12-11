<link rel="stylesheet" href="../../assets/css/userHEADER.css">
<header class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div class="user-info">
            <i class="fas fa-user-circle fa-2x"></i>
            <span>Welcome, <span id="username-display"><?php echo $_SESSION['username']; ?></span></span>
        </div>
        <!-- Add toggle button first -->
        <button class="btn btn-dark d-md-none" id="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="https://kit.fontawesome.com/your-code.js"></script>

<script>
function updateUsername() {
    $.ajax({
        url: 'get_username.php',
        type: 'GET',
        dataType: 'json',
        cache: false, // Prevent caching
        success: function(response) {
            if(response.success) {
                $('#username-display').text(response.username);
            }
        }
    });
}

// Call immediately when script loads
updateUsername();

// Still keep event listener for other components
$(document).on('profileUpdated', function() {
    updateUsername();
});
</script>
