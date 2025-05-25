<?php

$user_id = $_SESSION['user']['iduser'];
$user = getUserKosInfo($conn, $user_id);

if (!$user) {
    die("Data kos tidak ditemukan.");
}
// Ambil pembayaran terakhir
$stmt_last = $conn->prepare("
    SELECT tanggalbayar, keterangan, metode, jumlah, status
    FROM tbl_bayar
    WHERE iduser = ?
    ORDER BY tanggalbayar DESC
    LIMIT 1
");
$stmt_last->bind_param("i", $user_id);
$stmt_last->execute();
$res_last = $stmt_last->get_result();
$row_data = $res_last->fetch_assoc();
$stmt_last->close();

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
                <p class="fs-1 h1">Pembayaran</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo $user['nama'] ?></h5>
                        <small>Kamar <?php echo $user['idkamar'] ?></small>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        <div class="card">
            <div class="card-body">
                <h5>Status Pembayaran</h5>
                    <h1 class="lunas-status mb-0">
                        <?= htmlspecialchars($row_data['status'] ?? 'Belum ada pembayaran') ?>
                    </h1>

                    <?php if (!empty($row_data['tanggalbayar'])): ?>
                        <p>Pembayaran terakhir: <?= date('d-m-Y', strtotime($row_data['tanggalbayar'])) ?></p>
                    <?php else: ?>
                        <p>Pembayaran terakhir: Belum ada pembayaran</p>
                    <?php endif; ?>

                    <?php if (!empty($user['tanggal_jatuh_tempo'])): ?>
                        <p>Pembayaran berikutnya: <?= date('d-m-Y', strtotime($user['tanggal_jatuh_tempo'])) ?></p>
                    <?php else: ?>
                        <p>Pembayaran berikutnya: Belum ada pembayaran</p>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <button type="button" class="btn btn-action" data-bs-toggle="modal" data-bs-target="#tambahbayar">
                            Bayar
                        </button>
                    </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>Riwayat Pembayaran</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Metode</th>
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
                                    <td><?= htmlspecialchars($row_hist['metode']) ?></td>
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
</div>

<!-- Modal -->
<div class="modal fade" id="tambahbayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Bayar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <form action="proses_bayar.php" method="POST">
            <div class="card">
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-3">Informasi Tagihan</h6>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Sewa Kamar + Uang air + Wifi</span>
                            <input type="hidden" name="iduser" value="<?php echo $user['iduser'];?>">
                            <input type="hidden" name="idkamar" value="<?php echo $user['idkamar'];?>">
                            <input type="hidden" name="harga" value="<?php echo $user['harga'];?>">
                            <span class="fw-bold">Rp. <?= number_format($user['harga'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">waktu sewa</label>
                        <div class="dropdown">
                            <div class="mb-3">
                                <input type="text" class="form-control" value="<?php echo $user['waktu_sewa'];?>" disabled>
                             </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Metode</label>
                        <div class="dropdown">
                            <select name="metode" class="form-select form-control d-flex justify-content-between align-items-center" aria-label="Default select example">
                                <option selected>pilih metode</option>
                                <option value="Cash">Cash - Bayar Langsung ke pemilik kos</option>
                                <option value="Transfer Bank">Transfer Bank - BCA 0123456789</option>
                                <option value="Ewallet">Ewallet - Dana 0812345678</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Bayar</button>
            </div>
        </form>    
      </div>
    </div>
  </div>
</div>
