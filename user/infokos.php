<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Informasi Kos</p>
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
            <!-- Left Column -->
            <div class="col-md-7">
                <!-- Room Information Card -->
                <div class="info-card mb-4">
                    <div class="info-card-header">
                        <h4 class="mb-0">Informasi Kamar</h4>
                        <span class="status-active">Aktif</span>
                    </div>
                    <div class="info-card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Nomor Kamar</p>
                                <h5>20</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tipe Kamar</p>
                                <h5>Standar</h5>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tanggal Masuk</p>
                                <h5>1 Januari 2025</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tanggal Jatuh Tempo</p>
                                <h5>1 Februari 2025</h5>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Durasi Sewa</p>
                                <h5>1 bulan</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Harga Sewa</p>
                                <h5>Rp. 700.000</h5>
                            </div>
                        </div>
                        
                        <button class="btn btn-action">Perpanjang Sewa</button>
                    </div>
                </div>

                <!-- Payment History Card -->
                <div class="info-card">
                    <div class="info-card-header">
                        <h4 class="mb-0">Riwayat Pembayaran</h4>
                    </div>
                    <div class="info-card-body p-0">
                        <table class="table-custom">
                            <thead style="background-color: #f1f1f1;">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01/01/2025</td>
                                    <td>Sewa Kamar Januari 2025</td>
                                    <td>Rp. 700.000</td>
                                    <td class="lunas-status">Lunas</td>
                                </tr>
                                <tr>
                                    <td>01/02/2025</td>
                                    <td>Sewa Kamar Februari 2025</td>
                                    <td>Rp. 700.000</td>
                                    <td class="lunas-status">Lunas</td>
                                </tr>
                                <tr>
                                    <td>01/03/2025</td>
                                    <td>Sewa Kamar Maret 2025</td>
                                    <td>Rp. 700.000</td>
                                    <td class="lunas-status">Lunas</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-5">
                <!-- Payment Status Card -->
                <div class="info-card mb-4">
                    <div class="info-card-header">
                        <h4 class="mb-0">Status Pembayaran</h4>
                    </div>
                    <div class="info-card-body">
                        <p class="text-muted mb-1">Periode Bulan Ini</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="lunas-status mb-0">Lunas</h4>
                            <div class="payment-circle">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                        <p class="mb-4">Jatuh Tempo Pada : 1 Februari 2025</p>
                    </div>
                </div>

                <!-- Room Facilities Card -->
                <div class="info-card mb-4">
                    <div class="info-card-header">
                        <h4 class="mb-0">Fasilitas Kamar</h4>
                    </div>
                    <div class="info-card-body">
                        <div class="d-flex flex-wrap">
                            <div class="facility-card">
                                <i class="bi bi-bed"></i> Kasur Single
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-droplet"></i> Kamar Mandi Dalam
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-wind"></i> Kipas Dinding
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-layout-text-window"></i> Meja dan Kursi
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-wifi"></i> Wifi
                            </div>
                            <div class="facility-card">
                                <i class="bi bi-bed"></i> Kasur Single
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rules Card -->
                <div class="info-card mb-4">
                    <div class="info-card-header">
                        <h4 class="mb-0">Peraturan</h4>
                    </div>
                    <div class="info-card-body">
                        <ul class="list-unstyled">
                            <li class="rule-item">Dilarang membuat keributan</li>
                            <li class="rule-item">Menjaga kebersihan dan merawat fasilitas</li>
                            <li class="rule-item">Pembayaran sewa paling lambat tanggal 5</li>
                        </ul>
                    </div>
                </div>

                <!-- Owner Contact Card -->
                <div class="info-card">
                    <div class="info-card-header">
                        <h4 class="mb-0">Kontak Pemilik</h4>
                    </div>
                    <div class="info-card-body">
                        <div class="contact-owner">
                            <div class="owner-pic">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Puri</h5>
                                <p class="mb-0">0812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
