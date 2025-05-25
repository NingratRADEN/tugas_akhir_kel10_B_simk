<?php
include('../config/koneksi.php');

$iduser = $_POST['iduser'];
$judul = $_POST['judul'];
$kategori = $_POST['kategori'];
$deskripsi = $_POST['deskripsi'];
$tanggal = date('Y-m-d');
$status = 'Menunggu Verifikasi'; // Default, nanti bisa diubah jika diperlukan

$query = "INSERT INTO tbl_pengaduan (iduser, judul, kategori, deskripsi, tanggal, status)
          VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("isssss", $iduser, $judul, $kategori, $deskripsi, $tanggal , $status);

if ($stmt->execute()) {
    echo "<script>
            alert('Pengaduan terkirim, menunggu verifikasi admin.');
            window.location='user.php?menu=3';
          </script>";
} else {
    echo "Gagal menyimpan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
