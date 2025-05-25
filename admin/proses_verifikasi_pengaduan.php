<?php
// proses_verifikasi_pengaduan.php
include('../config/koneksi.php');

$id   = intval($_POST['idpengaduan'] ?? 0);
$stat = $_POST['status'] ?? '';

if ($id > 0 && in_array($stat, ['Proses','Selesai'])) {
    $query = "UPDATE tbl_pengaduan SET status = ?, tanggal_update = NOW() WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $stat, $id);
    if ($stmt->execute()) {
        header("Location: admin.php?menu=3");
        exit;
    } else {
        die("Gagal memperbarui status: " . $stmt->error);
    }
} else {
    die("Parameter tidak valid.");
}