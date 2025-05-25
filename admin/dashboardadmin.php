<?php
include('../config/koneksi.php');

// --- Ambil data user ---
$user_id = $_SESSION['user'] ?? null;

if ($user_id) {
    $query = "SELECT * FROM tbl_user WHERE iduser = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
} else {
    // Redirect atau tampilkan pesan error jika belum login
    die("Anda belum login.");
}

// Ambil semua data pembayaran
$query = "SELECT b.idbayar, u.nama, k.idkamar, b.jumlah, b.keterangan, b.metode, b.tanggalbayar, b.status, u.waktu_sewa
          FROM tbl_bayar b
          JOIN tbl_user u ON b.iduser = u.iduser
          JOIN tbl_infokos k ON b.idkamar = k.idkamar
          ORDER BY b.tanggalbayar DESC";
$result = $conn->query($query);

// 1. Jumlah pembayaran masuk (status: Pending)
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_bayar WHERE status = 'Belum Diverifikasi'");
$stmt->execute();
$res = $stmt->get_result();
$pembayaran_masuk = $res->fetch_assoc()['total'];
$stmt->close();

// 2. Jumlah pengaduan masuk (status: Baru)
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_pengaduan WHERE status = 'Menunggu Verifikasi'");
$stmt->execute();
$res = $stmt->get_result();
$pengaduan_masuk = $res->fetch_assoc()['total'];
$stmt->close();

// 3. Notifikasi masuk (jumlah aktivitas terbaru: pembayaran & pengaduan)
$notifikasi_masuk = $pembayaran_masuk + $pengaduan_masuk;
?>
<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Selamat Datang, <?php echo $_SESSION['user']['nama'] ?></p>
                <div class="user-profile">
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pembayaran</h5>
                        <p class="card-text"><?= $pembayaran_masuk ?> pembayaran masuk</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pengaduan</h5>
                        <p class="card-text"><?= $pengaduan_masuk ?> Pengaduan masuk</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Notifikasi</h5>
                        <p class="card-text"><?= $notifikasi_masuk ?> Notifikasi masuk</p>
                    </div>
                </div>
            </div>
        </div>

        <h3>Pembayaran</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Bayar</th>
                    <th>Kamar</th>
                    <th>Nama Penghuni</th>
                    <th>Waktu Sewa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['tanggalbayar']) ?></td>
                        <td><?= htmlspecialchars($row['idkamar']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['waktu_sewa']) ?></td>
                        <td class="<?= $row['status'] == 'Lunas' ? 'text-success' : 'text-warning' ?>">
                            <?= htmlspecialchars($row['status']) ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php if ($result->num_rows == 0): ?>
                    <tr><td colspan="5" class="text-center">Tidak ada data pembayaran.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
