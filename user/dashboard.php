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
?>
<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Selamat Datang, <?php echo $_SESSION['user']['nama'] ?></p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo $_SESSION['user']['nama'] ?></h5>
                        <small>Kamar <?php echo $_SESSION['user']['idkamar'] ?></small>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Status Pembayaran</h5>
                        <p class="card-text">Lunas Hingga Desember 2025</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pengaduan</h5>
                        <p class="card-text">1 Pengaduan Selesai</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Notifikasi</h5>
                        <p class="card-text">1 Notifikasi Belum Di Baca</p>
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
                <tr>
                    <td>01/01/2025</td>
                    <td>Sewa Kamar Januari 2025</td>
                    <td>Rp. 700.000</td>
                    <td class="text-success">Lunas</td>
                </tr>
                <tr>
                    <td>01/02/2025</td>
                    <td>Sewa Kamar Februari 2025</td>
                    <td>Rp. 700.000</td>
                    <td class="text-success">Lunas</td>
                </tr>
                <tr>
                    <td>01/03/2025</td>
                    <td>Sewa Kamar Maret 2025</td>
                    <td>Rp. 700.000</td>
                    <td class="text-success">Lunas</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
