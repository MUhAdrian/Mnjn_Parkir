<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Parkir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="/">Sistem Manajemen Parkir</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/parkir/masuk">Masuk Kendaraan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/parkir/keluar">Keluar Kendaraan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/tarif">Atur Tarif</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/laporan">Laporan</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5 dashboard-container">
    <h2 class="text-center mb-5 display-4 fw-bold text-primary">Selamat Datang di Dashboard Parkir</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <!-- Panel Masuk Kendaraan -->
      <div class="col">
        <a href="/parkir/masuk" class="dashboard-card-link">
          <div class="card h-100 shadow">
            <div class="card-body dashboard-card-body d-flex flex-column justify-content-center align-items-center">
              <i class="fas fa-car-side dashboard-card-icon"></i>
              <h5 class="dashboard-card-title">Masuk Kendaraan</h5>
              <p class="dashboard-card-text">Catat kendaraan yang baru masuk area parkir dengan mudah.</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Panel Keluar Kendaraan -->
      <div class="col">
        <a href="/parkir/keluar" class="dashboard-card-link">
          <div class="card h-100 shadow">
            <div class="card-body dashboard-card-body d-flex flex-column justify-content-center align-items-center">
              <i class="fas fa-car-alt dashboard-card-icon"></i>
              <h5 class="dashboard-card-title">Keluar Kendaraan</h5>
              <p class="dashboard-card-text">Proses kendaraan keluar dan hitung biaya parkir secara otomatis.</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Panel Atur Tarif Parkir -->
      <div class="col">
        <a href="/tarif/edit" class="dashboard-card-link">
          <div class="card h-100 shadow">
            <div class="card-body dashboard-card-body d-flex flex-column justify-content-center align-items-center">
              <i class="fas fa-tags dashboard-card-icon"></i>
              <h5 class="dashboard-card-title">Atur Tarif Parkir</h5>
              <p class="dashboard-card-text">Kelola tarif parkir per jam untuk setiap jenis kendaraan.</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Panel Lihat Laporan Harian -->
      <div class="col">
        <a href="/laporan" class="dashboard-card-link">
          <div class="card h-100 shadow">
            <div class="card-body dashboard-card-body d-flex flex-column justify-content-center align-items-center">
              <i class="fas fa-chart-bar dashboard-card-icon"></i>
              <h5 class="dashboard-card-title">Laporan Transaksi</h5>
              <p class="dashboard-card-text">Lihat semua riwayat transaksi parkir yang sudah selesai.</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Panel Laporan Per Tanggal -->
      <div class="col">
        <a href="/laporan/filter" class="dashboard-card-link">
          <div class="card h-100 shadow">
            <div class="card-body dashboard-card-body d-flex flex-column justify-content-center align-items-center">
              <i class="fas fa-calendar-alt dashboard-card-icon"></i>
              <h5 class="dashboard-card-title">Filter Laporan Tanggal</h5>
              <p class="dashboard-card-text">Cari laporan transaksi parkir berdasarkan rentang tanggal tertentu.</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p>&copy; <?= date('Y') ?> Sistem Manajemen Parkir. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
