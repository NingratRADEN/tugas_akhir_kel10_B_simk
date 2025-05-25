<?php
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
?>
<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Informasi Kos</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo $user['nama'] ?></h5>
                        <small>Kamar <?php echo $user['idkamar'] ?></small>
                    </div>
                    <a href="?menu=5" style="text-decoration: none; color: inherit;">
                        <div class="profile-pic">
                            <i class="fa-solid fa-circle-user"></i>
                        </div>
                    </a>
                </div>
            </div>
        </nav>
        
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-7">
                <!-- Room Information Card -->
                <div class="info-card mb-4">
                    <div class="info-card-header">
                        <h4 class="mb-0">Informasi Kamar</h4>
                        <span class="status-active">Aktif</span>
                    </div>
                    <div class="info-card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Nomor Kamar</p>
                                <h5><?php echo $user['idkamar'] ?></h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tipe Kamar</p>
                                <h5><?php echo $user['tipe'] ?></h5>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tanggal Masuk</p>
                                <h5><?php echo $user ['tanggal_masuk_kos'] ?></h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tanggal Jatuh Tempo</p>
                                <h5><?php echo $user ['tanggal_jatuh_tempo'] ?></h5>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Durasi Sewa</p>
                                <h5><?php echo $user['waktu_sewa'] ?></h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Harga Sewa</p>
                                <h5>Rp. <?= number_format($user['harga'], 0, ',', '.') ?></h5>
                            </div>
                        </div>
                        
                        <button class="btn btn-action">Perpanjang Sewa</button>
                    </div>
                </div>

                <!-- Payment History Card -->
                <div class="info-card">
                    <div class="info-card-header">
                        <h4 class="mb-0">Riwayat Pembayaran</h4>
                    </div>
                    <div class="info-card-body p-0">
                        <table class="table-custom">
                            <thead style="background-color: #f1f1f1;">
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
            </div>

            <!-- Right Column -->
            <div class="col-md-5">
                <!-- Payment Status Card -->
                <div class="info-card mb-4">
                    <div class="info-card-header">
                        <h4 class="mb-0">Status Pembayaran</h4>
                    </div>
                    <div class="info-card-body">
                        <p class="text-muted mb-1">Periode Bulan Ini</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <?php
                            $last_status = null;
                            $res_hist->data_seek(0); // Reset pointer ke awal hasil
                            if ($res_hist->num_rows > 0) {
                                $first_row = $res_hist->fetch_assoc();
                                $last_status = $first_row['status'];
                            }
                            ?>
                            <h4 class="lunas-status mb-0"><?= htmlspecialchars($last_status ?? 'Belum ada data') ?></h4>
                            <div class="payment-circle">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                        <p class="mb-4">Jatuh Tempo Pada : <?php echo $user ['tanggal_jatuh_tempo'] ?></p>
                    </div>
                </div>

                <!-- Room Facilities Card -->
                <div class="info-card mb-4">
                    <div class="info-card-header">
                        <h4 class="mb-0">Fasilitas Kamar</h4>
                    </div>
                    <div class="info-card-body">
                        <div class="d-flex flex-wrap">
                            <div class="facility-card">
                                <i class="bi bi-bed"></i> Kasur Single
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-droplet"></i> Kamar Mandi Dalam
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-wind"></i> Kipas Dinding
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-layout-text-window"></i> Meja dan Kursi
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-wifi"></i> Wifi
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-bed"></i> Kasur Single
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rules Card -->
                <div class="info-card mb-4">
                    <div class="info-card-header">
                        <h4 class="mb-0">Peraturan</h4>
                    </div>
                    <div class="info-card-body">
                        <ul class="list-unstyled">
                            <li class="rule-item">Dilarang membuat keributan</li>
                            <li class="rule-item">Menjaga kebersihan dan merawat fasilitas</li>
                            <li class="rule-item">Pembayaran sewa paling lambat tanggal 5</li>
                        </ul>
                    </div>
                </div>

                <!-- Owner Contact Card -->
                <div class="info-card">
                    <div class="info-card-header">
                        <h4 class="mb-0">Kontak Pemilik</h4>
                    </div>
                    <div class="info-card-body">
                        <div class="contact-owner">
                            <div class="owner-pic">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Puri</h5>
                                <p class="mb-0">0812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
