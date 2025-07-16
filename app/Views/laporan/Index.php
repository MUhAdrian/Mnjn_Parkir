<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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
                        <a class="nav-link" href="/">Dashboard</a>
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
                        <a class="nav-link active" aria-current="page" href="/laporan">Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4 text-center laporan-title"><i class="fas fa-file-invoice-dollar me-2"></i>Laporan Transaksi Parkir</h2>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-end mb-3">
                    <a href="/laporan/filter" class="btn btn-outline-primary btn-filter-laporan"><i class="fas fa-filter me-2"></i>Filter Laporan per Tanggal</a>
                </div>

                <div class="table-responsive">
                    <table id="laporanTable" class="table table-striped table-bordered table-laporan" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>Plat Nomor</th>
                                <th>Jenis Kendaraan</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Keluar</th>
                                <th>Durasi</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (! empty($transaksi)): ?>
                                <?php foreach ($transaksi as $t): ?>
                                    <tr>
                                        <td><?= esc($t['plat_nomor']) ?></td>
                                        <td><?= esc(ucfirst(str_replace('_', ' ', $t['jenis_kendaraan']))) ?></td>
                                        <td><?= esc($t['waktu_masuk']) ?></td>
                                        <td><?= esc($t['waktu_keluar'] ?: '-') ?></td>
                                        <td><?= esc($t['durasi'] ? round($t['durasi'] / 3600) . ' jam' : '-') ?></td>
                                        <td>Rp <?= number_format($t['biaya'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data transaksi yang selesai.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <a href="/" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#laporanTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
                },
                "order": [[3, "desc"]] // Order by Waktu Keluar (column index 3) descending
            });
        });
    </script>
</body>
</html>
