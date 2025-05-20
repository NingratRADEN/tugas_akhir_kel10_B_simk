<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding: 20px 50px 0;
            background-color: #f8f9fa;
        }
        .sidebar a {
            color: #343a40;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .user-profile {
            display: flex;
            align-items: center;
        }
        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #000;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 10px;
        }
        .profile-container {
            margin: 0 auto;
            background-color: white;
            padding: 15px;
            border-radius: 5px;
        }
        .form-title {
            font-weight: bold;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9e9e9;
            margin-bottom: 15px;
        }
        .form-label {
            color: #555;
            margin-bottom: 4px;
        }
        .form-control {
            padding: 6px 12px;
            border-color: #e9e9e9;
        }
        .profile-image {
            width: 100px;
            height: 100px;
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }
        .profile-image i {
            color: white;
            font-size: 40px;
        }
        .btn-update {
            background-color: #00af66;
            color: white;
            border: none;
            padding: 5px 15px;
            font-size: 14px;
            border-radius: 15px;
        }
        .btn-update-foto {
            background-color: white;
            color: #333;
            border: 1px solid #ccc;
            padding: 3px 10px;
            font-size: 12px;
            border-radius: 15px;
        }
        .form-section {
            margin-bottom: 15px;
        }
        .primary-footer {
            text-align: right;
            padding: 10px 20px;
        }
        .active-user {
            background-color: #e8f4ff;
            border-radius: 50%;
            position: relative;
        }
        .active-user::after {
            content: "";
            width: 8px;
            height: 8px;
            background-color: #2196f3;
            border-radius: 50%;
            position: absolute;
            bottom: 5px;
            right: 10px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar d-flex flex-column justify-content-between border border-start-0 border-top-0 border-buttom-0">
    <h2 class="text-black text-center">SIMK</h2>
    <div>
        <ul class="nav flex-column">
            <li class="nav-item fs-1 h5">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-house"></i>
                    Beranda
                </a>
            </li>
            <li class="nav-item fs-1 h5">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-bell"></i>
                    Notifikasi
                </a>
            </li>
            <li class="nav-item fs-1 h5">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-wallet"></i>
                    Pembayaran
                </a>
            </li>
            <li class="nav-item fs-1 h5">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-person-circle-exclamation"></i>
                    Pengaduan
                </a>
            </li>
            <li class="nav-item fs-1 h5">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-circle-info"></i>
                    Informasi Kos
                </a>
            </li>
        </ul>
    </div>    
    <ul class="nav flex-column">
        <li class="nav-item fs-1 h5">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-user"></i>
                Profile
            </a>
        </li>
    </ul>
</div>

<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Profile</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0">Angel</h5>
                        <small>Kamar 20</small>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        
        <div class="container profile-container">
            <div class="form-title">
                Detail User
            </div>
            
            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-sm" id="nama" value="User">
                    </div>
                    <div class="col-md-6">
                        <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm" id="tanggalLahir" value="01/01/2000">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control form-control-sm" id="jenisKelamin" value="Perempuan">
                    </div>
                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control form-control-sm" id="alamat" value="Jl. palem no.2 bandung barat, bandung">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control form-control-sm" id="pekerjaan" value="Mahasiswa">
                    </div>
                    <div class="col-md-6">
                        <label for="noHP" class="form-label">No Handphone</label>
                        <input type="text" class="form-control form-control-sm" id="noHP" value="08123456789">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                        <input type="text" class="form-control form-control-sm" id="tanggalMasuk" value="01/02/2022">
                    </div>
                    <div class="col-md-6">
                        <label for="waktuSewa" class="form-label">Waktu Sewa</label>
                        <input type="text" class="form-control form-control-sm" id="waktuSewa" value="1 bulan">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="noKamar" class="form-label">No Kamar / Tipe Kamar</label>
                        <input type="text" class="form-control form-control-sm" id="noKamar" value="20 / Standar">
                    </div>
                    <div class="col-md-6">
                        <label for="biayaSewa" class="form-label">Biaya Sewa</label>
                        <input type="text" class="form-control form-control-sm" id="biayaSewa" value="700.000">
                    </div>
                </div>
                
                <div class="form-title">
                    Akun
                </div>
                
                <div class="form-section">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-sm" id="email" value="user1@gmail.com">
                </div>
                
                <div class="d-flex">
                    <div class="profile-image me-3">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-update-foto">Update Foto</button>
                    </div>
                </div>
            </form>
            <!-- Footer -->
            <div class="primary-footer">
                <button type="submit" class="btn btn-update">Update</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>