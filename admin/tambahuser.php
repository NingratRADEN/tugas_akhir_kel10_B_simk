<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
        .card {
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        .card-header {
            background-color: white;
            border-bottom: 1px solid #e9e9e9;
            padding: 12px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-header h5 {
            margin: 0;
            font-weight: bold;
            font-size: 18px;
        }
        .form-header {
            padding: 12px 15px;
            border-bottom: 1px solid #e9e9e9;
            font-weight: bold;
        }
        .form-container {
            padding: 15px;
        }
        .form-label {
            margin-bottom: 5px;
        }
        .form-control, .form-select {
            padding: 8px 12px;
            border-color: #ddd;
            border-radius: 4px;
        }
        .btn-tambah {
            background-color: #5abeaa;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 15px;
        }
        .active-menu {
            background-color: #f5f5f5;
        }
        .input-with-icon {
            position: relative;
        }
        .input-with-icon .calendar-icon {
            position: absolute;
            right: 10px;
            top: 10px;
            color: #666;
        }
        .input-with-icon input {
            padding-right: 30px;
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
                <p class="fs-1 h1">Informasi Kos</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0">Admin</h5>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        
        <!-- Form Card -->
        <div class="card">
            <div class="form-header h3">
                Tambah User
            </div>
            <div class="form-container">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input type="text" class="form-control" id="tanggalLahir">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jenisKelamin">
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan">
                        </div>
                        <div class="col-md-6">
                            <label for="nomorHandphone" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" id="nomorHandphone">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                            <div class="input-with-icon">
                                <input type="text" class="form-control" id="tanggalMasuk" placeholder="dd/mm/yyyy">
                                <span class="calendar-icon"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="waktuSewa" class="form-label">Waktu Sewa</label>
                            <select class="form-select" id="waktuSewa">
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
                            <select class="form-select" id="noKamar">
                                <option selected>20 / Standar</option>
                                <option>21 / Standar</option>
                                <option>22 / Premium</option>
                                <option>23 / Premium</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="biayaSewa" class="form-label">Biaya Sewa</label>
                            <input type="text" class="form-control" id="biayaSewa" value="700.000">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Buat Akun</label>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                    </div>
                    
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-tambah">Tambah User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>