<?php
function checkUserSession() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../loginPAGE.php");
        exit();
    }
}

function checkAdminSession() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../loginPAGE.php");
        exit();
    }
}
?>