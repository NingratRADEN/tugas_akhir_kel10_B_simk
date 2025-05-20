<?php
session_start();
include('./config/koneksi.php');

// Ambil data dari form login
$username_user = htmlspecialchars($_POST['email']);
$password_user = htmlspecialchars($_POST['password']);

// Query untuk cek username dan password
$query = "SELECT * FROM tbl_user WHERE email = '$username_user' AND password = '$password_user'";
$hasil = mysqli_query($conn, $query);
$data_user = mysqli_fetch_assoc($hasil);

// Cek apakah data user ditemukan
if ($data_user != null) {
    $_SESSION['user'] = $data_user;

    // Redirect berdasarkan role
    if ($data_user['role'] == 'admin') {
        header('Location: ./admin/admin.php');
    } elseif ($data_user['role'] == 'user') {
        header('Location: ./user/user.php');
    } else {
        // Jika role tidak dikenali
        echo "<script>alert('Role tidak dikenali'); window.location.href='./login.php';</script>";
    }
} else {
    // Jika username atau password salah
    echo "<script>alert('Username atau password salah'); window.location.href='./login.php';</script>";
}
?>