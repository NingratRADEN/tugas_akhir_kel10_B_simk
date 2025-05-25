<?php
include('../config/koneksi.php');

$now = new DateTime();
$notifikasi_hari_ini = [];
$notifikasi_lainnya = [];

// Pembayaran masuk yang belum diverifikasi
$stmt = $conn->prepare("
    SELECT u.nama, b.idkamar, b.tanggalbayar 
    FROM tbl_bayar b
    JOIN tbl_user u ON b.iduser = u.iduser
    WHERE b.status = 'Belum Diverifikasi'
    ORDER BY b.tanggalbayar DESC
");
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $tanggal = new DateTime($row['tanggalbayar']);
    $selisih = (int)$now->diff($tanggal)->format('%r%a');

    $data = [
        'jenis' => 'warning',
        'judul' => 'Pembayaran Baru',
        'isi'   => "Pembayaran baru dari <strong>{$row['nama']}</strong> (Kamar {$row['idkamar']}) perlu diverifikasi.",
        'waktu' => $tanggal->format('d-m-Y')
    ];

    if ($selisih === 0) {
        $notifikasi_hari_ini[] = $data;
    } else {
        $notifikasi_lainnya[] = $data;
    }
}
$stmt->close();

// Pengaduan baru atau belum ditindaklanjuti
$stmt = $conn->prepare("
    SELECT p.judul, p.tanggal, u.nama
    FROM tbl_pengaduan p
    JOIN tbl_user u ON p.iduser = u.iduser
    WHERE p.status = 'Menunggu Verifikasi'
    ORDER BY p.tanggal DESC
");
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $tanggal = new DateTime($row['tanggal']);
    $selisih = (int)$now->diff($tanggal)->format('%r%a');

    $data = [
        'jenis' => 'danger',
        'judul' => 'Pengaduan Baru',
        'isi'   => "Pengaduan baru dari <strong>{$row['nama']}</strong> : {$row['judul']}",
        'waktu' => $tanggal->format('d-m-Y')
    ];

    if ($selisih === 0) {
        $notifikasi_hari_ini[] = $data;
    } else {
        $notifikasi_lainnya[] = $data;
    }
}
$stmt->close();
?>

<!-- Tampilan HTML -->
 <!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Notifikasi</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?= $_SESSION['user']['nama'] ?></h5>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        
        <h5>Notifikasi (<?= count($notifikasi_hari_ini) + count($notifikasi_lainnya) ?>)</h5>

        <?php if (!empty($notifikasi_hari_ini)): ?>
            <div class="notification-item">
                <h6>Hari Ini</h6>
                <?php foreach ($notifikasi_hari_ini as $notif): ?>
                    <div class="alert alert-<?= $notif['jenis'] ?>" role="alert">
                        <strong><?= $notif['judul'] ?></strong><br>
                        <?= $notif['isi'] ?><br>
                        <small class="text-muted"><?= $notif['waktu'] ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($notifikasi_lainnya)): ?>
            <div class="notification-item">
                <h6>Sebelumnya</h6>
                <?php foreach ($notifikasi_lainnya as $notif): ?>
                    <div class="alert alert-<?= $notif['jenis'] ?>" role="alert">
                        <strong><?= $notif['judul'] ?></strong><br>
                        <?= $notif['isi'] ?><br>
                        <small class="text-muted"><?= $notif['waktu'] ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($notifikasi_hari_ini) && empty($notifikasi_lainnya)): ?>
            <div class="alert alert-secondary text-center mt-4" role="alert">
                Tidak ada notifikasi baru.
            </div>
        <?php endif; ?>
    </div>
</div>
