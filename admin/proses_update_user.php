<?php
session_start();
include('../config/koneksi.php');

// ID user dikirim via URL
if (!isset($_GET['iduser'])) {
    die("ID User tidak diberikan.");
}
$iduser = (int) $_GET['iduser'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Tangkap data POST
    $nama         = trim($_POST['namaLengkap']      ?? '');
    $tgl_lahir    = trim($_POST['tanggalLahir']     ?? '');
    $jk           = trim($_POST['jenisKelamin']     ?? '');
    $alamat       = trim($_POST['alamat']           ?? '');
    $pekerjaan    = trim($_POST['pekerjaan']        ?? '');
    $hp           = trim($_POST['nomorHandphone']   ?? '');  // perbaikan
    $tgl_masuk    = trim($_POST['tanggalMasuk']     ?? '');
    $waktu_sewa   = trim($_POST['waktuSewa']        ?? '');
    $email        = trim($_POST['email']            ?? '');
    $password     = trim($_POST['password']         ?? '');
    $idkamar_new  = isset($_POST['idkamar']) 
                     ? (int) $_POST['idkamar'] 
                     : 0;

    $conn->begin_transaction();
    try {
        // 2. Update tbl_user
        $u = $conn->prepare("
            UPDATE tbl_user SET
              nama              = ?,
              tanggal_lahir     = ?,
              jenis_kelamin     = ?,
              alamat            = ?,
              pekerjaan         = ?,
              No_handphone      = ?,
              tanggal_masuk_kos = ?,
              waktu_sewa        = ?,
              email             = ?,
              password          = ?
            WHERE iduser = ?
        ");
        $u->bind_param(
          "ssssssssssi",
          $nama, $tgl_lahir, $jk, $alamat,
          $pekerjaan, $hp, $tgl_masuk, $waktu_sewa,
          $email, $password, $iduser
        );
        $u->execute();
        $u->close();

        // 3. Bebaskan kamar lama jika berbeda
        if ($idkamar_new) {
            $conn->query("
              UPDATE tbl_infokos 
              SET iduser = NULL 
              WHERE iduser = {$iduser} 
                AND idkamar <> {$idkamar_new}
            ");
        }

        // 4. Set iduser di kamar baru
        $stmt2 = $conn->prepare("
            UPDATE tbl_infokos
            SET iduser = ?
            WHERE idkamar = ?
        ");
        $stmt2->bind_param("ii", $iduser, $idkamar_new);
        $stmt2->execute();
        $stmt2->close();

        $conn->commit();
        header("Location: admin.php?menu=6&iduser={$iduser}&updated=1");
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        die("Update gagal: " . $e->getMessage());
    }
}