<?php
session_start();
include('../config/koneksi.php');

// Tangkap data POST (sesuaikan name di form)
$nama        = $_POST['namaLengkap']        ?? '';
$tgl_lahir   = $_POST['tanggalLahir'] ?? '';
$jk          = $_POST['jenisKelamin']?? '';
$alamat      = $_POST['alamat']      ?? '';
$pekerjaan   = $_POST['pekerjaan']   ?? '';
$hp          = $_POST['nomorHandphone']?? '';
$darurat     = $_POST['darurat']?? '';
$tgl_masuk   = $_POST['tanggalMasuk']?? '';
$waktu_sewa  = $_POST['waktuSewa']  ?? '';
$idkamar     = $_POST['idkamar']     ?? '';
$email       = $_POST['email']       ?? '';
$password    = $_POST['password']    ?? '';
$role = 'user';

// Mulai transaksi
$conn->begin_transaction();

try {
    // 1. Insert ke tbl_user
    $stmt = $conn->prepare("
      INSERT INTO tbl_user 
        (nama, tanggal_lahir, jenis_kelamin, alamat, pekerjaan, No_handphone, tanggal_masuk_kos, waktu_sewa, email, password, kontak_darurat, role) 
      VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "ssssssssssss", $nama, $tgl_lahir, $jk, $alamat, $pekerjaan, $hp, $tgl_masuk, $waktu_sewa, $email, $password,$darurat, $role);
    $stmt->execute();

    // Ambil iduser hasil insert
    $new_iduser = $stmt->insert_id;
    $stmt->close();

    // 2. Update tbl_infokos: set iduser = $new_iduser untuk kamar terpilih
    $stmt2 = $conn->prepare("
      UPDATE tbl_infokos
      SET iduser = ?
      WHERE idkamar = ?
    ");
    $stmt2->bind_param("ii", $new_iduser, $idkamar);
    $stmt2->execute();
    $stmt2->close();

    // Commit transaksi
    $conn->commit();

    // Redirect atau tampilkan pesan sukses
    header('Location: admin.php?menu=4');
    exit;

} catch (Exception $e) {
    // Rollback jika ada error
    $conn->rollback();
    die("Proses gagal: " . $e->getMessage());
}
