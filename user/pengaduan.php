<!-- Content -->
<div class="content">
    <div class="container">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="fs-1 h1">Pengaduan</p>
                <div class="user-profile">
                    <div class="text-end me-2">
                        <h5 class="mb-0"><?php echo $_SESSION['user']['nama'] ?></h5>
                        <small>Kamar <?php echo $_SESSION['user']['idkamar'] ?></small>
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
                            <i class="fa-solid fa-list-check"></i>
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
                            <i class="fa-solid fa-bars-progress"></i>
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
                            <i class="fa-solid fa-check-double"></i>
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
            <button class="btn btn-add">
                <i class="bi bi-plus-circle"></i> Buat Pengaduan Baru
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
