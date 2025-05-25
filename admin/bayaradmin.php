<?php
include('../config/koneksi.php');

// Ambil semua data pembayaran
$query = "SELECT b.idbayar, u.nama, k.idkamar, b.jumlah, b.keterangan, b.metode, b.tanggalbayar, b.status
          FROM tbl_bayar b
          JOIN tbl_user u ON b.iduser = u.iduser
          JOIN tbl_infokos k ON b.idkamar = k.idkamar
          ORDER BY b.tanggalbayar DESC";
$result = $conn->query($query);
?>
<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Data Pembayaran</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?= $_SESSION['user']['nama'] ?></h5>
                    </div>
                    <a href="?menu=5" style="text-decoration: none; color: inherit;">
                        <div class="profile-pic">
                            <i class="fa-solid fa-circle-user"></i>
                        </div>
                    </a>
                </div>
            </div>
        </nav>

        <div class="card mt-3">
            <div class="card-body">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal Bayar</th>
                            <th>Kamar / Penghuni</th>
                            <th>Keterangan</th>
                            <th>Metode</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['tanggalbayar']) ?></td>
                                <td><?= htmlspecialchars($row['idkamar']) ?> / <?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                <td><?= htmlspecialchars($row['metode']) ?></td>
                                <td>Rp. <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($row['status'] == 'Lunas'): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Belum Diverifikasi</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['status'] == 'Belum Diverifikasi'): ?>
                                        <form action="proses_verifikasi_bayar.php" method="POST" style="display:inline">
                                            <input type="hidden" name="idbayar" value="<?= $row['idbayar'] ?>">
                                            <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Tandai pembayaran ini sebagai LUNAS?')">
                                                Verifikasi
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
