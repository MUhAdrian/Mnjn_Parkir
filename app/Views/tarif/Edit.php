<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Tarif Parkir</title>
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
                        <a class="nav-link" href="/">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/parkir/masuk">Masuk Kendaraan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/parkir/keluar">Keluar Kendaraan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/tarif">Atur Tarif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/laporan">Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card mx-auto tarif-edit-card">
            <div class="card-body">
                <h2 class="mb-4 text-center tarif-edit-title"><i class="fas fa-dollar-sign me-2"></i>Pengaturan Tarif Parkir</h2>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Validasi Gagal!</h4>
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="/tarif/update" method="post">
                    <?= csrf_field() ?>
                    <?php if (! empty($tarif)): ?>
                        <?php foreach ($tarif as $t): ?>
                            <div class="mb-3">
                                <label for="tarif_<?= esc($t['id']) ?>" class="form-label">Tarif <?= esc(ucfirst(str_replace('_', ' ', $t['jenis_kendaraan']))) ?>:</label>
                                <div class="input-group input-group-lg input-group-tarif">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="tarif_<?= esc($t['id']) ?>" name="tarif[<?= esc($t['id']) ?>]" value="<?= old('tarif.' . $t['id'], $t['tarif_per_jam']) ?>" min="0" required>
                                    <span class="input-group-text">/ jam</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning text-center" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>Tidak ada data tarif yang ditemukan. Harap tambahkan data tarif di database.
                        </div>
                    <?php endif; ?>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-lg btn-tarif-primary"><i class="fas fa-sync-alt me-2"></i>Simpan Perubahan</button>
                        <a href="/" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
