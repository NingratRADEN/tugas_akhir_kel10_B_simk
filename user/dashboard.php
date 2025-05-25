<?php

// --- Ambil data user ---
$user_id = $_SESSION['user']['iduser'];
$user = getUserKosInfo($conn, $user_id);

if (!$user) {
    die("Data kos tidak ditemukan.");
}
// Ambil riwayat pembayaran
$stmt_hist = $conn->prepare("
    SELECT tanggalbayar, keterangan, metode, jumlah, status
    FROM tbl_bayar
    WHERE iduser = ?
    ORDER BY tanggalbayar DESC
");
$stmt_hist->bind_param("i", $user['iduser']);
$stmt_hist->execute();
$res_hist = $stmt_hist->get_result();

// 1. Status Pembayaran
$stmt = $conn->prepare("
    SELECT MAX(tanggal_jatuh_tempo) as terakhir_bayar
    FROM tbl_user
    WHERE iduser = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();

$status_pembayaran = "Belum Ada Data";
if ($row['terakhir_bayar']) {
    $tanggal = new DateTime($row['terakhir_bayar']);
    $status_pembayaran = "Lunas Hingga " . $tanggal->format('F Y'); // contoh: Desember 2025
}

// 2. Jumlah Pengaduan Selesai
$stmt = $conn->prepare("
    SELECT COUNT(*) as total
    FROM tbl_pengaduan
    WHERE iduser = ? AND status = 'Selesai'
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$jumlah_pengaduan = $res->fetch_assoc()['total'];
$stmt->close();

// 3. Notifikasi Belum Dibaca
$last_notif = isset($user['last_notif']) ? new DateTime($user['last_notif']) : new DateTime('2000-01-01');

$notif_baru = 0;
?>

<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Selamat Datang, <?php echo $user['nama'] ?></p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo $user['nama'] ?></h5>
                        <small>Kamar <?php echo $user['idkamar'] ?></small>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Status Pembayaran </h5>
                        <p class="card-text"><?= htmlspecialchars($status_pembayaran) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pengaduan</h5>
                        <p class="card-text"><?= $jumlah_pengaduan ?> Pengaduan Selesai</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Notifikasi</h5>
                        <p class="card-text"><?= $notif_baru ?> Notifikasi Belum Di Baca</p>
                    </div>
                </div>
            </div>
        </div>

        <h3>Riwayat Pembayaran</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($res_hist->num_rows): ?>
                    <?php while ($row_hist = $res_hist->fetch_assoc()): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($row_hist['tanggalbayar'])) ?></td>
                            <td><?= htmlspecialchars($row_hist['keterangan']) ?></td>
                            <td>Rp. <?= number_format($row_hist['jumlah'], 0, ',', '.') ?></td>
                            <td class="<?= $row_hist['status']=='Lunas' ? 'text-success' : 'text-warning' ?>"><?= htmlspecialchars($row_hist['status']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada riwayat pembayaran.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
