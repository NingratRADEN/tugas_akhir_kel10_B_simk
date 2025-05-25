<?php
include('../config/koneksi.php');

// Ambil data user dari tbl_user
$sql    = "SELECT * FROM tbl_user AS u JOIN tbl_infokos AS k ON u.iduser = k.iduser";
$result = $conn->query($sql);

// Hitung kamar terisi
$kamar_terisi = $result->num_rows;
$total_kamar  = 30;
$kamar_kosong = $total_kamar - $kamar_terisi;

// 2. Ambil data kamar kosong untuk dropdown
$sql_kosong = "SELECT idkamar, no_kamar, tipe, harga 
               FROM tbl_infokos 
               WHERE iduser IS NULL 
               ORDER BY no_kamar";
$res_kosong = $conn->query($sql_kosong);
$kamar_tersedia = [];
while ($r = $res_kosong->fetch_assoc()) {
    $kamar_tersedia[] = $r;
}
?>
<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Informasi Kos</p>
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
        
        <!-- Informasi Kamar Card -->
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomor Kamar</th>
                            <th>Nama Penghuni</th>
                            <th>Tipe Kamar</th>
                            <th>Durasi Sewa</th>
                            <th>Harga Sewa</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                         <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['idkamar']) ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['tipe']) ?></td>
                                    <td><?= htmlspecialchars($row['waktu_sewa']) ?></td>
                                    <td>Rp. <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <a class="btn btn-detail" href="?menu=6&iduser=<?= $row['iduser'] ?>">Detail</a>
                                    </td>
                                    <td>
                                        <form action="proses_delete_user.php" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            <input type="hidden" name="delete_iduser" value="<?= $row['iduser'] ?>">
                                            <button type="submit" class="btn btn-danger" style="background-color: #f7a3a3; border-radius: 25px; padding: 6px 12px;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6">Tidak ada data penghuni.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="px-3 mb-3">
                <form action="" method="POST">
                    <button type="button" class="btn btn-tambah" data-bs-toggle="modal" data-bs-target="#tambahuser">
                        Tambah User
                    </button>
                </form>
            </div>
            <div class="room-stats">
                <div>Jumlah Kamar : <?= $total_kamar ?></div>
                <div>Terisi : <?= $kamar_terisi ?></div>
                <div>Kosong : <?= $kamar_kosong ?></div>
            </div>
        </div>
    </div>
</div>
<?php $conn->close(); ?>

<div class="modal fade" id="tambahuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <form action="proses_tambah_user.php" method="POST">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="namaLengkap">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggalLahir">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" name="jenisKelamin">
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan">
                        </div>
                        <div class="col-md-6">
                            <label for="nomorHandphone" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" name="nomorHandphone">
                        </div>
                        <div class="col-md-6">
                            <label for="nomorHandphone" class="form-label">Kontak Darurat</label>
                            <input type="text" class="form-control" name="darurat">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                            <div class="input-with-icon">
                                <input type="date" class="form-control" name="tanggalMasuk" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="waktuSewa" class="form-label">Waktu Sewa</label>
                            <select class="form-select form-control" name="waktuSewa">
                                <option selected>1 bulan</option>
                                <option>3 bulan</option>
                                <option>6 bulan</option>
                                <option>12 bulan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="noKamar" class="form-label">No Kamar / Tipe Kamar</label>
                            <select name="idkamar" id="noKamar" class="form-control form-select" required>
                                <option value="" disabled selected>— Pilih kamar —</option>
                                <?php foreach($kamar_tersedia as $k): ?>
                                    <option value="<?= $k['idkamar'] ?>"data-harga="<?= $k['harga'] ?>">
                                        <?= $k['no_kamar'] ?> / <?= ucfirst($k['tipe']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="biayaSewa" class="form-label">Biaya Sewa</label>
                            <input type="text" class="form-control" id="biayaSewa" name="biayaSewa" readonly placeholder="Rp. 0">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Buat Akun</label>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-tambah">Tambah</button>
            </div>
        </form>    
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kamarSelect = document.getElementById('noKamar');
    const biayaSewaInput = document.getElementById('biayaSewa');

    kamarSelect.addEventListener('change', function () {
        const selectedOption = kamarSelect.selectedOptions[0];
        const harga = selectedOption.getAttribute('data-harga') || 0;

        // Format ke Rupiah
        const hargaFormatted = parseInt(harga).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

        biayaSewaInput.value = hargaFormatted;
    });
});
</script>
