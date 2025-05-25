<?php
include('../config/koneksi.php');

// Proses penghapusan user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_iduser'])) {
    $id = intval($_POST['delete_iduser']);

    // Hapus dari tbl_infokos dulu (relasi dengan iduser)
    $conn->query("UPDATE tbl_infokos SET iduser = NULL WHERE iduser = $id");

    // Hapus dari tbl_user
    $conn->query("DELETE FROM tbl_user WHERE iduser = $id");

    echo "<script>window.location.href = admin.php?menu=4;</script>";
}

?>
?>