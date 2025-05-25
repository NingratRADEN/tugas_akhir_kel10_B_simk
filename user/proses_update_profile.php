<?php
session_start();
include('../config/koneksi.php');

// 1) Ambil user_id dari session
$user_id = $_SESSION['user']['iduser'] ?? null;
if (!$user_id) {
    die("Anda belum login.");
}

// 2) Tangkap dan sanitize input
$nama          = isset($_POST['nama'])         ? trim($_POST['nama'])         : '';
$tanggallahir  = isset($_POST['tanggallahir']) ? trim($_POST['tanggallahir']) : '';
$jeniskelamin  = isset($_POST['jeniskelamin']) ? trim($_POST['jeniskelamin']) : '';
$alamat        = isset($_POST['alamat'])       ? trim($_POST['alamat'])       : '';
$pekerjaan     = isset($_POST['pekerjaan'])    ? trim($_POST['pekerjaan'])    : '';
$hp            = isset($_POST['noHP'])         ? trim($_POST['noHP'])         : '';

// 4) Prepare dan eksekusi UPDATE
$sql = "
    UPDATE tbl_user
       SET nama          = ?,
           tanggal_lahir = ?,
           jenis_kelamin = ?,
           alamat        = ?,
           pekerjaan     = ?,
           No_handphone  = ?
     WHERE iduser        = ?
";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// pastikan urutan & tipe param:
// s = string, i = integer
$stmt->bind_param(
    "ssssssi",
    $nama,
    $tanggallahir,
    $jeniskelamin,
    $alamat,
    $pekerjaan,
    $hp,
    $user_id
);

if ($stmt->execute()) {
    echo "<script>
            alert('Profil berhasil diperbarui.');
            window.location = 'user.php?menu=5';
          </script>";
} else {
    echo "Gagal menyimpan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>