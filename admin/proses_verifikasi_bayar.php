<?php
include('../config/koneksi.php');

if (isset($_POST['idbayar'])) {
    $idbayar = $_POST['idbayar'];
    $query = "UPDATE tbl_bayar SET status = 'Lunas' WHERE idbayar = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idbayar);

    if ($stmt->execute()) {
        echo "<script>alert('Pembayaran berhasil diverifikasi sebagai LUNAS');window.location='admin.php?menu=2';</script>";
    } else {
        echo "Gagal memverifikasi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
