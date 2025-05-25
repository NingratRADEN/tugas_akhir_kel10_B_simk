<?php
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
                    <a href="?menu=5" style="text-decoration: none; color: inherit;">
                        <div class="profile-pic">
                            <i class="fa-solid fa-circle-user"></i>
                        </div>
                    </a>
                </div>
            </div>
        </nav>
        
        <div class="row">
            <!-- Left Column - Profile Info -->
            <div class="col-md-4">
                <div class="profile-card text-center">
                    <div class="profile-picture">
                        <span>O</span>
                    </div>
                    <h3 class="profile-name"><?php echo $user['nama'] ?></h3>
                    <p class="profile-room">Kamar <?php echo $user['idkamar'] ?></p>
                    <a href="?menu=6" class="btn edit-btn">Edit Profil</a>
                    <p class="profile-contact"><?php echo $user['No_handphone'] ?></p>
                    <p class="profile-contact"><?php echo $user['email'] ?></p>
                    <p class="profile-contact"><?php echo $user['pekerjaan'] ?></p>
                </div>
                <a href="../login/logout.php" class="btn btn-danger">Log Out</a>
            </div>

            <!-- Right Column - Detailed Info -->
            <div class="col-md-8">
                <!-- Personal Information Card -->
                <div class="info-card">
                    <h4 class="info-title">Informasi Pribadi</h4>
                    
                    <div class="info-row">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value"><?php echo $user['nama'] ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Tanggal Lahir</div>
                        <div class="info-value"><?php echo $user['tanggal_lahir'] ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Jenis Kelamin</div>
                        <div class="info-value"><?php echo $user['jenis_kelamin'] ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Alamat Asal</div>
                        <div class="info-value"><?php echo $user['alamat'] ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Pekerjaan</div>
                        <div class="info-value"><?php echo $user['pekerjaan'] ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Kontak Darurat</div>
                        <div class="info-value"><?php echo $user['kontak_darurat'] ?></div>
                    </div>
                </div>

                <!-- Room Information Card -->
                <div class="info-card">
                    <h4 class="info-title">Informasi Kamar</h4>
                    
                    <div class="info-row">
                        <div class="info-label">Nomor Kamar</div>
                        <div class="info-value"><?php echo $user['idkamar'] ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Tipe Kamar</div>
                        <div class="info-value"><?php echo $user['tipe'] ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Tanggal Masuk</div>
                        <div class="info-value"><?php echo $user['tanggal_masuk_kos'] ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Waktu sewa</div>
                        <div class="info-value"><?php echo $user['waktu_sewa'] ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Harga Sewa</div>
                        <div class="info-value"><?= number_format($user['harga'], 0, ',', '.') ?>/ bulan</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Status Pembayaran</div>
                        <div class="info-value payment-status">Lunas(Januari 2025)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
