<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard admin</title>
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
        .notification-container {
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .notification-header {
            font-size: 24px;
            font-weight: bold;
        }
        .card {
            margin: 20px 0;
        }
        .status {
            font-weight: bold;
        }
        .btn-pay {
            background-color: #a1e7e1;
            color: #000;
        }
        .stat-card {
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px;
            margin-bottom: 20px;
            background-color: white;
            height: 100%;
        }
        .icon-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #000;
            margin-right: 15px;
        }
        .status-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
        }
        .document-circle {
            border: 2px solid #000;
        }
        .time-circle {
            border: 2px solid #000;
        }
        .check-circle {
            background-color: #4cd137;
            color: white;
        }
        .btn-add {
            background-color: #7bed9f;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: #000;
        }
        .filter-btn {
            padding: 10px 20px;
            border-radius: 5px;
            margin-left: 10px;
            background-color: white;
            border: 1px solid #dee2e6;
        }
        .active-filter {
            background-color: #7bed9f;
            border: none;
        }
        .complaint-card {
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            background-color: white;
        }
        .btn-status {
            background-color: #7bed9f;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            float: right;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .btn-tambah {
            background-color: #8ee4cf;
            color: #000;
            border: none;
            border-radius: 5px;
            padding: 8px 20px;
        }
        .btn-detail {
            background-color: #8ee4cf;
            color: #000;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
        }
        .room-stats {
            display: flex;
            gap: 30px;
            padding: 15px 20px;
        }
        .profile-card {
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 30px;
            background-color: white;
        }
        .info-card {
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 30px;
            background-color: white;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            background-color: #000;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 3rem;
        }
        .profile-name {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .profile-room {
            text-align: center;
            color: #6c757d;
            margin-bottom: 15px;
        }
        .edit-btn {
            display: block;
            width: 120px;
            padding: 8px;
            border: 1px solid #dee2e6;
            border-radius: 20px;
            text-align: center;
            margin: 0 auto 20px;
            text-decoration: none;
            color: #000;
        }
        .profile-contact {
            text-align: center;
            margin-bottom: 8px;
            color: #6c757d;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .info-row {
            display: flex;
            margin-bottom: 15px;
        }
        .info-label {
            width: 150px;
            color: #6c757d;
        }
        .info-value {
            flex-grow: 1;
        }
        .payment-status {
            color: #4cd137;
            font-weight: 500;
        }
        .card {
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            border: 1px solid #ddd;
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
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 5px;
        }
        .form-control {
            font-size: 14px;
            padding: 6px 12px;
            border-color: #ddd;
            border-radius: 4px;
            background-color: #fff;
        }
        .btn-edit {
            background-color: #5abeaa;
            color: white;
            border: none;
            padding: 5px 15px;
            font-size: 14px;
            border-radius: 15px;
        }
        .active-menu {
            background-color: #f5f5f5;
        }
        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .footer {
            text-align: right;
            padding: 10px 0;
        }
        .btn-danger {
            border: none;
            border-radius: 25px;
            padding: 6px 12px;
            color: black;
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
                <a class="nav-link" href="admin.php">
                    <i class="fa-solid fa-house"></i>
                    Beranda
                </a>
            </li>
            <li class="nav-item fs-1 h5">
                <a class="nav-link" href="?menu=1">
                    <i class="fa-solid fa-bell"></i>
                    Notifikasi
                </a>
            </li>
            <li class="nav-item fs-1 h5">
                <a class="nav-link" href="?menu=2">
                    <i class="fa-solid fa-wallet"></i>
                    Pembayaran
                </a>
            </li>
            <li class="nav-item fs-1 h5">
                <a class="nav-link" href="?menu=3">
                    <i class="fa-solid fa-person-circle-exclamation"></i>
                    Pengaduan
                </a>
            </li>
            <li class="nav-item fs-1 h5">
                <a class="nav-link" href="?menu=4">
                    <i class="fa-solid fa-circle-info"></i>
                    Informasi Kos
                </a>
            </li>
        </ul>
    </div>    
    <ul class="nav flex-column">
        <li class="nav-item fs-1 h5">
            <a class="nav-link" href="?menu=5">
                <i class="fa-solid fa-user"></i>
                Profile
            </a>
        </li>
    </ul>
</div>
