<?php
include('../config/koneksi.php');

//Tangkap iduser
if (!isset($_GET['iduser'])) {
    die("ID user tidak diberikan.");
}
$iduser = (int) $_GET['iduser'];

//Ambil data user + kamar
$sql = "
  SELECT 
    u.nama,
    u.tanggal_lahir,
    u.jenis_kelamin,
    u.alamat,
    u.pekerjaan,
    u.No_handphone,
    u.tanggal_masuk_kos,
    u.waktu_sewa,
    u.kontak_darurat,
    u.email,
    u.password,
    k.no_kamar,
    k.tipe,
    k.harga
  FROM tbl_user u
  LEFT JOIN tbl_infokos k ON u.iduser = k.iduser
  WHERE u.iduser = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $iduser);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    die("User tidak ditemukan.");
}
$data = $res->fetch_assoc();
$stmt->close();

// helper format tanggal
function formatTgl($d) {
  return date("d/m/Y", strtotime($d));
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
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        
        <!-- Detail User Card -->
        <div class="card">
            <div class="form-header">
                Detail User
            </div>
            <div class="form-container">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" value="<?= htmlspecialchars($data['nama']) ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input type="text" class="form-control" id="tanggalLahir" value="<?= htmlspecialchars($data['tanggal_lahir']) ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jenisKelamin" value="<?= htmlspecialchars($data['jenis_kelamin']) ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" value="<?= htmlspecialchars($data['pekerjaan']) ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="nomorHandphone" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" id="nomorHandphone" value="<?= htmlspecialchars($data['No_handphone']) ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                            <input type="text" class="form-control" id="tanggalMasuk" value="<?= htmlspecialchars($data['tanggal_masuk_kos']) ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="waktuSewa" class="form-label">Waktu Sewa</label>
                            <input type="text" class="form-control" id="waktuSewa" value="<?= htmlspecialchars($data['waktu_sewa']) ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="noKamar" class="form-label">No Kamar / Tipe Kamar</label>
                            <input type="text" class="form-control" id="noKamar" value="<?= htmlspecialchars($data['no_kamar']) ?> / <?= htmlspecialchars($data['tipe']) ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="biayaSewa" class="form-label">Biaya Sewa</label>
                            <input type="text" class="form-control" id="biayaSewa" value="<?= htmlspecialchars($data['harga']) ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="section-title">Akun</div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($data['email']) ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" value="<?= htmlspecialchars($data['password']) ?>" readonly>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="footer">
                        <a class="btn btn-edit" href="?menu=4">Batal</a>
                        <a class="btn btn-edit" href="?menu=7&iduser=<?= $iduser ?>">Edit User</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>