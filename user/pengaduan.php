<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Pengaduan</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0">Angel</h5>
                        <small>Kamar 20</small>
                    </div>
                    <div class="profile-pic"><i class="fa-solid fa-circle-user"></i></div>
                </div>
            </div>
        </nav>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle document-circle">
                            <i class="bi bi-file-text"></i>
                        </div>
                        <div>
                            <h2 class="mb-0">1</h2>
                            <p class="mb-0">Total Pengaduan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle time-circle">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div>
                            <h2 class="mb-0">0</h2>
                            <p class="mb-0">Sedang Diproses</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="status-circle check-circle">
                            <i class="bi bi-check"></i>
                        </div>
                        <div>
                            <h2 class="mb-0">1</h2>
                            <p class="mb-0">Selesai Ditangani</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-4">
            <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#tambahpengaduan">
                <i class="bi bi-plus-circle"></i>Buat Pengaduan baru
            </button>
            <div>
                <button class="filter-btn active-filter">Semua</button>
                <button class="filter-btn">Diproses</button>
                <button class="filter-btn">Selesai</button>
            </div>
        </div>

        <div class="complaint-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h4>Lampu Kamar Mati</h4>
                    <p class="mb-1">Kategori : Fasilitas Rusak</p>
                    <p class="mb-1">Dilaporkan : 05/01/2025</p>
                    <p>Keterangan : Lampu Mati</p>
                </div>
                <button class="btn btn-status">Selesai</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahpengaduan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Pengaduan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card shadow-sm">
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Pengaduan</label>
                            <input type="text" class="form-control" id="judul" placeholder="Masukan Judul Pengaduan">
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="kategori" placeholder="tulis Kategori">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" rows="5" placeholder="Jelaskan detail pengaduan"></textarea>
                        </div>
                    </form>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Kirim</button>
      </div>
    </div>
  </div>
</div> 
