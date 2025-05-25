<?php

$user_id = $_SESSION['user']['iduser'];
$user = getUserKosInfo($conn, $user_id);

if (!$user) {
    die("Data user tidak ditemukan.");
}

$now = new DateTime();
$notifikasi_hari_ini = [];
$notifikasi_lainnya = [];

// 1. Jatuh Tempo
if (!empty($user['tanggal_jatuh_tempo'])) {
    $tgl_jatuh_tempo = new DateTime($user['tanggal_jatuh_tempo']);
    $selisih = (int)$now->diff($tgl_jatuh_tempo)->format('%r%a');
    if ($selisih >= 0 && $selisih <= 5) {
        $data = [
            'jenis' => 'info',
            'judul' => 'Pengingat Pembayaran',
            'isi'   => "Sewa jatuh tempo dalam {$selisih} hari pada " . $tgl_jatuh_tempo->format('d M Y'),
            'waktu' => $now->format('d-m-Y')
        ];
        $notifikasi_hari_ini[] = $data;
    }
}

// 2. Pembayaran diverifikasi (hanya user yang login)
$stmt = $conn->prepare("
    SELECT tanggalbayar 
    FROM tbl_bayar 
    WHERE iduser = ? AND status = 'Lunas'
    ORDER BY tanggalbayar DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $tanggal = new DateTime($row['tanggalbayar']);
    $selisih = (int)$now->diff($tanggal)->format('%r%a');

    $data = [
        'jenis' => 'success',
        'judul' => 'Pembayaran Diverifikasi',
        'isi'   => "Pembayaran Anda telah diverifikasi oleh admin.",
        'waktu' => $tanggal->format('d-m-Y')
    ];

    if ($selisih === 0) {
        $notifikasi_hari_ini[] = $data;
    } else {
        $notifikasi_lainnya[] = $data;
    }
}
$stmt->close();

// 3. Pengaduan status 'Proses'
$stmt = $conn->prepare("
    SELECT judul, tanggal 
    FROM tbl_pengaduan 
    WHERE iduser = ? AND status = 'Proses'
    ORDER BY tanggal DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $tanggal = new DateTime($row['tanggal']);
    $selisih = (int)$now->diff($tanggal)->format('%r%a');

    $data = [
        'jenis' => 'secondary',
        'judul' => "Pengaduan - {$row['judul']}",
        'isi'   => 'Pengaduan Anda sedang diproses.',
        'waktu' => $tanggal->format('d-m-Y')
    ];

    if ($selisih === 0) {
        $notifikasi_hari_ini[] = $data;
    } else {
        $notifikasi_lainnya[] = $data;
    }
}
$stmt->close();

// 4. Pengaduan status 'Selesai'
$stmt = $conn->prepare("
    SELECT judul, tanggal 
    FROM tbl_pengaduan 
    WHERE iduser = ? AND status = 'Selesai'
    ORDER BY tanggal DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $tanggal = new DateTime($row['tanggal']);
    $selisih = (int)$now->diff($tanggal)->format('%r%a');

    $data = [
        'jenis' => 'primary',
        'judul' => "Pengaduan - {$row['judul']}",
        'isi'   => 'Pengaduan Anda telah diselesaikan.',
        'waktu' => $tanggal->format('d-m-Y')
    ];

    if ($selisih === 0) {
        $notifikasi_hari_ini[] = $data;
    } else {
        $notifikasi_lainnya[] = $data;
    }
}
$stmt->close();

// Update waktu baca notifikasi
$nowStr = $now->format('Y-m-d H:i:s');
$stmt = $conn->prepare("UPDATE tbl_user SET last_notif = ? WHERE iduser = ?");
$stmt->bind_param("si", $nowStr, $user_id);
$stmt->execute();
$stmt->close();
?>

<!-- Tampilan HTML -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Notifikasi</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo htmlspecialchars($user['nama']) ?></h5>
                        <small>Kamar <?php echo htmlspecialchars($user['idkamar']) ?></small>
                    </div>
                    <a href="?menu=5" style="text-decoration: none; color: inherit;">
                        <div class="profile-pic">
                            <i class="fa-solid fa-circle-user"></i>
                        </div>
                    </a>
                </div>
            </div>
        </nav>

        <h5>Notifikasi (<?= count($notifikasi_hari_ini)?>)</h5>

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