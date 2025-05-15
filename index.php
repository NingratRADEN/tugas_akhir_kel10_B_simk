<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect based on user role
    if ($_SESSION['user_role'] === 'admin') {
        header("Location: admin/admin.php");
    } else {
        header("Location: user/user.php");
    }
    exit();
}

// Redirect to login page
header("Location: login.php");
exit();
?>