<?php
session_start();
include('../config/koneksi.php');

$user_id = $_SESSION['user']['iduser'];
$user = getUserKosInfo($conn, $user_id);

if (!$user) {
    die("Data kos tidak ditemukan.");
}

$iduser = $_POST['iduser'];
$idkamar = $_POST['idkamar'];
$keterangan = $_POST['keterangan'];
$metode = $_POST['metode'];
$tanggal = date('Y-m-d');
$status = 'Belum Diverifikasi'; // Default, nanti bisa diubah jika diperlukan

// Ambil harga dan durasi
$bulan = (int) filter_var($user['waktu_sewa'], FILTER_SANITIZE_NUMBER_INT);
$harga_per_bulan = (float) $user['harga'];
$total = $bulan * $harga_per_bulan;

$query = "INSERT INTO tbl_bayar (iduser, idkamar, jumlah, keterangan, metode, tanggalbayar, status)
          VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("iidssss", $iduser, $idkamar, $total, $keterangan, $metode, $tanggal, $status);

if (!$stmt->execute()) {
    die("Gagal menyimpan pembayaran: " . $stmt->error);
}
$stmt->close();

// LOGIKA: Update tanggal jatuh tempo di tbl_user
$jatuhTempoLama = $user['tanggal_jatuh_tempo'];
$startDate = $jatuhTempoLama ? new DateTime($jatuhTempoLama) : new DateTime();
$startDate->modify("+{$bulan} months");
$tanggalJatuhTempoBaru = $startDate->format('Y-m-d');

$updateTempo = $conn->prepare("UPDATE tbl_user SET tanggal_jatuh_tempo = ? WHERE iduser = ?");
$updateTempo->bind_param("si", $tanggalJatuhTempoBaru, $iduser);
$updateTempo->execute();
$updateTempo->close();

echo "<script>
        alert('Pembayaran Rp. ".number_format($total,0,',','.')." terkirim, menunggu verifikasi admin.');
        window.location = 'user.php?menu=2';
      </script>";
?>