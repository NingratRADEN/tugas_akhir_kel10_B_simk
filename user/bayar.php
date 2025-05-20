<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Pembayaran</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo $_SESSION['user']['nama'] ?></h5>
                        <small>Kamar <?php echo $_SESSION['user']['idkamar'] ?></small>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        <div class="card">
            <div class="card-body">
                <h5>Status Pembayaran</h5>
                <div class="status">
                    Lunas
                </div>
                    <p>Pembayaran terakhir: 03 Januari 2025 (Sewa bulan Januari 2025)</p>
                    <p>Pembayaran berikutnya: 01 Februari 2025</p>
                </div>
             </div>
                    <button type="button" class="btn btn-pay" data-bs-toggle="modal" data-bs-target="#tambahbayar">
                         Bayar Sewa Bulan Februari 2025
                    </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>Riwayat Pembayaran</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Metode</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01/01/2025</td>
                            <td>Sewa Kamar Januari 2025</td>
                            <td>Transfer Bank</td>
                            <td>Rp. 700.000</td>
                            <td>Lunas</td>
                        </tr>
                        <tr>
                            <td>01/02/2025</td>
                            <td>Sewa Kamar Februari 2025</td>
                            <td>Tunai</td>
                            <td>Rp. 700.000</td>
                            <td>Lunas</td>
                        </tr>
                        <tr>
                            <td>01/03/2025</td>
                            <td>Sewa Kamar Maret 2025</td>
                            <td>Transfer Bank</td>
                            <td>Rp. 700.000</td>
                            <td>Lunas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambahbayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Bayar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-body p-3">
                <h6 class="fw-bold mb-3">Informasi Tagihan</h6>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Sewa Kamar + Uang air + Wifi</span>
                        <span class="fw-bold">Rp. 700,000</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <div class="dropdown">
                        <button class="form-select form-control d-flex justify-content-between align-items-center dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            1 bulan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">1 bulan</a></li>
                            <li><a class="dropdown-item" href="#">3 bulan</a></li>
                            <li><a class="dropdown-item" href="#">6 bulan</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Metode</label>
                    <div class="dropdown">
                        <button class="form-select form-control d-flex justify-content-between align-items-center dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cash - bayar langsung pemilik kos
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Cash - bayar langsung pemilik kos</a></li>
                            <li><a class="dropdown-item" href="#">Transfer Bank - BCA 0123456789</a></li>
                            <li><a class="dropdown-item" href="#">Ewallet - Dana 0812345678</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Bayar</button>
      </div>
    </div>
  </div>
</div>
