<?php
// --- Ambil data user ---
$user_id = $_SESSION['user']['iduser'];
$user = getUserKosInfo($conn, $user_id);

if (!$user) {
    die("Data kos tidak ditemukan.");
}
?>
<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Profile</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo $user['nama'] ?></h5>
                        <small>Kamar <?php echo $user['idkamar'] ?></small>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        
        <div class="container profile-container">
            <div class="form-title">
                Detail User
            </div>
            
            <form action="proses_update_profile.php" method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-sm" name="nama" value="<?php echo $user['nama'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control form-control-sm" name="tanggallahir" value="<?php echo $user['tanggal_lahir'] ?>">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control form-control-sm" name="jeniskelamin" value="<?php echo $user['jenis_kelamin'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control form-control-sm" name="alamat" value="<?php echo $user['alamat'] ?>">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control form-control-sm" name="pekerjaan" value="<?php echo $user['pekerjaan'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="noHP" class="form-label">No Handphone</label>
                        <input type="text" class="form-control form-control-sm" name="noHP" value="<?php echo $user['No_handphone'] ?>">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                        <input type="text" class="form-control form-control-sm" id="tanggalMasuk" value="<?php echo $user['tanggal_masuk_kos'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="waktuSewa" class="form-label">Waktu Sewa</label>
                        <input type="text" class="form-control form-control-sm" id="waktuSewa" value="<?php echo $user['waktu_sewa'] ?>" disabled>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="noKamar" class="form-label">No Kamar / Tipe Kamar</label>
                        <input type="text" class="form-control form-control-sm" id="noKamar" value="<?php echo $user['idkamar'] ?> / <?php echo $user['tipe'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="biayaSewa" class="form-label">Biaya Sewa</label>
                        <input type="text" class="form-control form-control-sm" id="biayaSewa" value="<?php echo $user['harga'] ?>" disabled>
                    </div>
                </div>
                
                <div class="form-title">
                    Akun
                </div>
                
                <div class="form-section">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-sm" id="email" value="<?php echo $user['email'] ?>" disabled>
                </div>
                <div class="primary-footer">
                    <button type="submit" class="btn btn-update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
