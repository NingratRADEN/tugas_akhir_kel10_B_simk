<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Profile</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo $_SESSION['user']['nama'] ?></h5>
                        <small>Kamar <?php echo $_SESSION['user']['idkamar'] ?></small>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
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
                    <h3 class="profile-name">Alex</h3>
                    <p class="profile-room">Kamar 20</p>
                    <a href="#" class="edit-btn">Edit Profil</a>
                    <p class="profile-contact">0812-3456-7890</p>
                    <p class="profile-contact">Angel123@email.com</p>
                    <p class="profile-contact">Mahasiswa</p>
                </div>
            </div>

            <!-- Right Column - Detailed Info -->
            <div class="col-md-8">
                <!-- Personal Information Card -->
                <div class="info-card">
                    <h4 class="info-title">Informasi Pribadi</h4>
                    
                    <div class="info-row">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value">Angel</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Tanggal Lahir</div>
                        <div class="info-value">15 Mei 1995</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Jenis Kelamin</div>
                        <div class="info-value">Perempuan</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Alamat Asal</div>
                        <div class="info-value">Jl. Kenanga No. 15, Bandung, Jawa Barat</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Pekerjaan</div>
                        <div class="info-value">Mahasiswa</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Kontak Darurat</div>
                        <div class="info-value">Siti (Ibu) 0857-1234-5678</div>
                    </div>
                </div>

                <!-- Room Information Card -->
                <div class="info-card">
                    <h4 class="info-title">Informasi Kamar</h4>
                    
                    <div class="info-row">
                        <div class="info-label">Nomor Kamar</div>
                        <div class="info-value">20</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Tipe Kamar</div>
                        <div class="info-value">Standar</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Tanggal Masuk</div>
                        <div class="info-value">1 Januari 2025</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Kontrak Sampai</div>
                        <div class="info-value">31 Januari 2025</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Harga Sewa</div>
                        <div class="info-value">Rp. 700.000/ bulan</div>
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
