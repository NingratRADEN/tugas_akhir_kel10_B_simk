<?php
session_start();
include "koneksi.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validate input
    if (empty($email) || empty($password)) {
        $error = "Email dan password harus diisi!";
    } else {
        // Check if email exists in admin table first
        $adminSql = "SELECT * FROM tbl_admin WHERE email = ?";
        $adminStmt = $conn->prepare($adminSql);
        $adminStmt->bind_param("s", $email);
        $adminStmt->execute();
        $adminResult = $adminStmt->get_result();
        
        if ($adminResult->num_rows == 1) {
            // Admin login
            $adminRow = $adminResult->fetch_assoc();
            
            // Verify password (using password_verify if passwords are hashed)
            if (password_verify($password, $adminRow['password'])) {
                // Password is correct, create session
                $_SESSION['id'] = $adminRow['id'];
                $_SESSION['email'] = $adminRow['email'];
                $_SESSION['user_role'] = 'admin';
                
                // Redirect to admin dashboard
                header('Location: ./admin/admin.php');
            } else {
                $error = "Password salah!";
            }
        } else {
            // Check if email exists in user table
            $userSql = "SELECT * FROM tbl_user WHERE email = ?";
            $userStmt = $conn->prepare($userSql);
            $userStmt->bind_param("s", $email);
            $userStmt->execute();
            $userResult = $userStmt->get_result();
            
            if ($userResult->num_rows == 1) {
                // User login
                $userRow = $userResult->fetch_assoc();
                
                // Verify password
                if (password_verify($password, $userRow['password'])) {
                    // Password is correct, create session
                    $_SESSION['user_id'] = $userRow['iduser'];
                    $_SESSION['email'] = $userRow['email'];
                    $_SESSION['user_role'] = 'user';
                    
                    // Redirect to user dashboard
                    header('Location: ./user/user.php');
                } else {
                    $error = "Password salah!";
                }
            } else {
                $error = "Email tidak ditemukan!";
            }
        }
    }
}
?>