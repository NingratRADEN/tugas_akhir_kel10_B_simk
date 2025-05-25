<?php
include('../config/koneksi.php');

//Tangkap iduser
if (!isset($_GET['iduser'])) {
    die("ID user tidak diberikan.");
}
$iduser = (int) $_GET['iduser'];

$sql = "
  SELECT u.*, k.idkamar, k.no_kamar, k.tipe, k.harga
  FROM tbl_user u
  LEFT JOIN tbl_infokos k ON u.iduser = k.iduser
  WHERE u.iduser = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $iduser);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows===0) die("User tidak ditemukan.");
$data = $res->fetch_assoc();
$stmt->close();

// Ambil daftar kamar: yang kosong + kamar user ini
$sql2 = "
  SELECT idkamar, no_kamar, tipe, harga
  FROM tbl_infokos
  WHERE iduser IS NULL OR iduser = ?
  ORDER BY no_kamar
";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("i", $iduser);
$stmt->execute();
$res2 = $stmt->get_result();
$rooms = $res2->fetch_all(MYSQLI_ASSOC);
$stmt->close();
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
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        
        <!-- Edit User Form -->
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-4">Edit User</h3>
                <form action="proses_update_user.php?iduser=<?= $iduser ?>" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="namaLengkap" value="<?= htmlspecialchars($data['nama']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggalLahir" value="<?= htmlspecialchars($data['tanggal_lahir']) ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" name="jenisKelamin" value="<?= htmlspecialchars($data['jenis_kelamin']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan" value="<?= htmlspecialchars($data['pekerjaan']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="nomorHandphone" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" name="nomorHandphone" value="<?= htmlspecialchars($data['No_handphone']) ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggalMasuk" value="<?= htmlspecialchars($data['tanggal_masuk_kos']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="waktuSewa" class="form-label">Waktu Sewa</label>
                            <select class="form-select form-control" name="waktuSewa">
                                <?php foreach(['1 bulan','3 bulan','6 bulan','12 bulan'] as $opt): ?>
                                    <option value="<?= $opt ?>"
                                        <?= $data['waktu_sewa']==$opt?'selected':'' ?>>
                                        <?= $opt ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="noKamar" class="form-label">No Kamar / Tipe Kamar</label>
                            <select class="form-select form-control" id="idkamar" name="idkamar">
                               <?php foreach($rooms as $r): ?>
                                    <option value="<?= $r['idkamar'] ?>"
                                        data-harga="<?= $r['harga'] ?>"
                                        <?= $data['idkamar']==$r['idkamar']?'selected':'' ?>>
                                        <?= $r['no_kamar'] ?> / <?= ucfirst($r['tipe']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="biayaSewa" class="form-label">Biaya Sewa</label>
                            <input type="text" class="form-control" id="biayaSewa" name="biayaSewa" value="<?= number_format($data['harga'],0,',','.') ?>" readonly>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Akun</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($data['email']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" name="password" value="<?= htmlspecialchars($data['password']) ?>">
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-edit">Update user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kamarSelect = document.getElementById('idkamar');
    const biayaSewaInput = document.getElementById('biayaSewa');

    kamarSelect.addEventListener('change', function () {
        const selectedOption = kamarSelect.selectedOptions[0];
        const harga = selectedOption.getAttribute('data-harga') || 0;

        const hargaFormatted = parseInt(harga).toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        biayaSewaInput.value = hargaFormatted;
    });

    // Trigger saat pertama load (biar update harga sesuai select awal)
    kamarSelect.dispatchEvent(new Event('change'));
});

</script>