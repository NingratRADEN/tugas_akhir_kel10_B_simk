<?php
include('../config/koneksi.php');

// Ambil semua data admin
$result = $conn->query("SELECT * FROM tbl_admin");
$adminList = $result->fetch_all(MYSQLI_ASSOC);

// Ambil data user (misalnya user dengan peran admin)
$result_user = $conn->query("SELECT * FROM tbl_user WHERE role = 'admin'");
$userList = $result_user->fetch_all(MYSQLI_ASSOC);
?>
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Profile</p>
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
        
        <div class="row">
            <!-- Left Column - Profile Info -->
            <div class="col-md-4">
                <div class="profile-card text-center">
                    <div class="profile-picture">
                        <span><i class="fa-solid fa-circle-user"></i></span>
                    </div>
                    <h3 class="profile-name"><?= htmlspecialchars($adminList[0]['nama']) ?></h3>
                    <p class="profile-room">Pemilik Kos</p>
                    <p class="profile-contact"><?= htmlspecialchars($userList[0]['email']) ?></p>
                    <p class="profile-contact"><?= htmlspecialchars($userList[0]['No_handphone']) ?></p>
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
                        <div class="info-value"><?= htmlspecialchars($adminList[0]['nama']) ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Tanggal Lahir</div>
                        <div class="info-value"><?= htmlspecialchars($adminList[0]['tanggal_lahir']) ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Jenis Kelamin</div>
                        <div class="info-value"><?= htmlspecialchars($adminList[0]['jenis_kelamin']) ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Alamat Asal</div>
                        <div class="info-value"><?= htmlspecialchars($adminList[0]['alamat']) ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Pekerjaan</div>
                        <div class="info-value"><?= htmlspecialchars($adminList[0]['pekerjaan']) ?></div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
