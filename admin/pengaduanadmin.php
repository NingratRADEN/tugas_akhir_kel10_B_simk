<?php
include('../config/koneksi.php');

// Ambil semua pengaduan
$query = "
  SELECT p.id, u.nama, p.judul, p.kategori, p.deskripsi, p.tanggal, p.status
  FROM tbl_pengaduan p
  JOIN tbl_user u ON p.iduser = u.iduser
  ORDER BY p.tanggal DESC
";
$result = $conn->query($query);

// Hitung jumlah pengaduan user
$jumlah_total = 0;
$jumlah_proses = 0;
$jumlah_selesai = 0;
$jumlah_menunggu = 0;

// Query untuk menghitung jumlah pengaduan per status
$sql_stat = "SELECT status, COUNT(*) AS jumlah FROM tbl_pengaduan GROUP BY status";
$result_stat = $conn->query($sql_stat);

if ($result_stat->num_rows > 0) {
    while ($row = $result_stat->fetch_assoc()) {
        $jumlah_total += $row['jumlah'];
        if ($row['status'] == 'Selesai') {
            $jumlah_selesai = $row['jumlah'];
        } elseif ($row['status'] == 'Proses') {
            $jumlah_proses = $row['jumlah'];
        }elseif ($row['status'] == 'Menunggu Verifikasi') {
            $jumlah_menunggu = $row['jumlah'];
        }
    }
}
?>
?>
<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Pengaduan</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo $_SESSION['user']['nama'] ?></h5>
                    </div>
                    <a href="?menu=5" style="text-decoration: none; color: inherit;">
                        <div class="profile-pic">
                            <i class="fa-solid fa-circle-user"></i>
                        </div>
                    </a>
                </div>
            </div>
        </nav>
        <div class="container my-1">
            <div class="row g-3">
                <div class="col-md-3 col-6">
                    <div class="card shadow-sm text-center p-3">
                        <div class="fs-2"><i class="fa-regular fa-circle"></i></div>
                        <h3 class="mt-2"><?php echo $jumlah_total; ?></h3>
                        <p class="mb-0">Total Pengaduan</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card shadow-sm text-center p-3">
                        <div class="fs-2 text-warning"><i class="fa-regular fa-clock"></i></div>
                        <h3 class="mt-2"><?php echo $jumlah_menunggu; ?></h3>
                        <p class="mb-0">Menunggu</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card shadow-sm text-center p-3">
                        <div class="fs-2"><i class="fa-regular fa-circle"></i></div>
                        <h3 class="mt-2"><?php echo $jumlah_proses; ?></h3>
                        <p class="mb-0">Sedang Diproses</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card shadow-sm text-center p-3">
                        <div class="fs-2 text-success"><i class="fa-solid fa-circle"></i></div>
                        <h3 class="mt-2"><?php echo $jumlah_selesai; ?></h3>
                        <p class="mb-0">Selesai Ditangani</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-4">
            <div>
                <button class="btn btn-outline-success filter-btn active" data-filter="Semua">Semua</button>
                <button class="btn btn-outline-warning filter-btn" data-filter="Menunggu Verifikasi">Menunggu Verifikasi</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="Proses">Proses</button>
                <button class="btn btn-outline-success filter-btn" data-filter="Selesai">Selesai</button>
            </div>
        </div>
        <?php while ($row = $result->fetch_assoc()): 
            $status = $row['status'];
            $badge = $status == 'Selesai' ? 'success' : ($status == 'Proses' ? 'primary' : 'warning');
        ?>
            <div class="complaint-card" data-status="<?= $status ?>">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4><?= htmlspecialchars($row['nama']) ?></h4>
                        <p class="mb-1"><?= htmlspecialchars($row['judul']) ?></p>
                        <p class="mb-1">Kategori : <?= htmlspecialchars($row['kategori']) ?></p>
                        <p class="mb-1">Dilaporkan : <?= date('d-m-Y', strtotime($row['tanggal'])) ?></p>
                        <p>Keterangan : <?= htmlspecialchars($row['deskripsi']) ?></p>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <button class="btn">
                            <?php if ($row['status'] == 'Selesai'): ?>
                                <span class="badge bg-success">Selesai</span>
                            <?php elseif ($row['status'] == 'Proses'): ?>
                                <span class="badge bg-primary">Proses</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                            <?php endif; ?>
                        </button>
                        <button class="btn">
                            <?php if ($row['status'] == 'Menunggu Verifikasi'): ?>
                                <form action="proses_verifikasi_pengaduan.php" method="POST" style="display:inline">
                                <input type="hidden" name="idpengaduan" value="<?= $row['id'] ?>">
                                <input type="hidden" name="status" value="Proses">
                                <button type="submit" class="btn btn-sm btn-primary"
                                        onclick="return confirm('Tandai sebagai Proses?')">
                                    Terima
                                </button>
                                </form>
                            <?php elseif ($row['status'] == 'Proses'): ?>
                                <form action="proses_verifikasi_pengaduan.php" method="POST" style="display:inline">
                                <input type="hidden" name="idpengaduan" value="<?= $row['id'] ?>">
                                <input type="hidden" name="status" value="Selesai">
                                <button type="submit" class="btn btn-sm btn-success"
                                        onclick="return confirm('Tandai sebagai Selesai?')">
                                    Selesai
                                </button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Filter Script -->
<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;

        document.querySelectorAll('.complaint-card').forEach(card => {
            const stat = card.dataset.status;
            if (filter === 'Semua' || stat === filter) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>