<?php
$user_id = $_SESSION['user']['iduser'];
$user = getUserKosInfo($conn, $user_id);

if (!$user) {
    die("Data kos tidak ditemukan.");
}
// Hitung jumlah pengaduan user
$jumlah_total = 0;
$jumlah_proses = 0;
$jumlah_selesai = 0;

$sql_stat = "SELECT status, COUNT(*) AS jumlah FROM tbl_pengaduan WHERE iduser = ? GROUP BY status";
$stmt_stat = $conn->prepare($sql_stat);
$stmt_stat->bind_param("i", $user_id);
$stmt_stat->execute();
$result_stat = $stmt_stat->get_result();
while ($row = $result_stat->fetch_assoc()) {
    $jumlah_total += $row['jumlah'];
    if ($row['status'] == 'Selesai') $jumlah_selesai = $row['jumlah'];
    elseif ($row['status'] == 'Proses') $jumlah_proses = $row['jumlah'];
}
?>
<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Pengaduan</p>
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
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle document-circle">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div>
                            <h2 class="mb-0"><?= $jumlah_total ?></h2>
                            <p class="mb-0">Total Pengaduan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle time-circle">
                            <i class="fa-solid fa-bars-progress"></i>
                        </div>
                        <div>
                            <h2 class="mb-0"><?= $jumlah_proses ?></h2>
                            <p class="mb-0">Sedang Diproses</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="status-circle check-circle">
                            <i class="fa-solid fa-check-double"></i>
                        </div>
                        <div>
                            <h2 class="mb-0"><?= $jumlah_selesai ?></h2>
                            <p class="mb-0">Selesai Ditangani</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-4">
            <form action="" method="POST">
                <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#tambahpengaduan">
                    Buat Pengaduan Baru
                </button>
            </form>
            <div>
                <button class="filter-btn btn btn-success active-filter" data-filter="Semua">Semua</button>
                <button class="filter-btn btn btn-outline-secondary" data-filter="Diproses">Diproses</button>
                <button class="filter-btn btn btn-outline-secondary" data-filter="Selesai">Selesai</button>
            </div>
        </div>

        <?php
        // Ambil semua pengaduan milik user yang sedang login
        $sql_pengaduan = "SELECT * FROM tbl_pengaduan WHERE iduser = ? ORDER BY tanggal DESC";
        $stmt = $conn->prepare($sql_pengaduan);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result_pengaduan = $stmt->get_result();

        if ($result_pengaduan->num_rows > 0):
            while ($row = $result_pengaduan->fetch_assoc()):
                // Format tanggal
                $tanggal = date("d/m/Y", strtotime($row['tanggal']));

                // Tentukan warna status
                $status = $row['status'];
                $badge_class = "secondary";
                if ($status == "Selesai") $badge_class = "success";
                elseif ($status == "Proses") $badge_class = "primary";
                elseif ($status == "Menunggu Verifikasi") $badge_class = "warning";

                // Tentukan data-status untuk filter
                $dataStatus = ($status == "Proses") ? "Diproses" :
                  (($status == "Selesai") ? "Selesai" : "Lainnya");
        ?>
        <div class="complaint-card mb-3" data-status="<?= $dataStatus ?>">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h4><?= htmlspecialchars($row['judul']) ?></h4>
                    <p class="mb-1">Kategori : <?= htmlspecialchars($row['kategori']) ?></p>
                    <p class="mb-1">Dilaporkan : <?= $tanggal ?></p>
                    <p>keterangan : <?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
                </div>
                <span class="btn btn-sm btn-<?= $badge_class ?>"><?= $status ?></span>
            </div>
        </div>
        <?php
            endwhile;
        else:
        ?>
            <p class="text-muted">Belum ada pengaduan.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahpengaduan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Pengaduan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <div class="card shadow-sm">
                <div class="card-body">
                    <form action="proses_pengaduan.php" method="POST">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Pengaduan</label>
                            <input type="hidden" name="iduser" value="<?php echo $user['iduser'];?>">
                            <input type="text" class="form-control" name="judul" placeholder="Masukan Judul Pengaduan">
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="kategori" placeholder="tulis Kategori">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="5" placeholder="Jelaskan detail pengaduan"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
  </div>
</div>

<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    // update active class
    document.querySelectorAll('.filter-btn').forEach(b=>b.classList.replace('btn-success','btn-outline-secondary'));
    btn.classList.replace('btn-outline-secondary','btn-success');
    const filter = btn.dataset.filter; // "Semua", "Diproses", "Selesai"
    document.querySelectorAll('.complaint-card').forEach(card => {
      const stat = card.dataset.status; // sama key
      if (filter === 'Semua' || stat === filter) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  });
});
</script>