<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendaraan Masuk</title>
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
                        <a class="nav-link active" aria-current="page" href="/parkir/masuk">Masuk Kendaraan</a>
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

    <div class="container mt-5">
        <div class="card mx-auto parkir-masuk-card">
            <div class="card-body">
                <h2 class="mb-4 text-center parkir-masuk-title"><i class="fas fa-plus-circle me-2"></i>Form Kendaraan Masuk</h2>

                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('message') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
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

                <form action="/parkir/simpan" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="plat_nomor" class="form-label">Plat Nomor:</label>
                        <input type="text" class="form-control form-control-lg" id="plat_nomor" name="plat_nomor" value="<?= old('plat_nomor') ?>" placeholder="Contoh: B 1234 ABC" required>
                    </div>

                    <div class="mb-4">
                        <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan:</label>
                        <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select form-select-lg" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="roda_2" <?= old('jenis_kendaraan') === 'roda_2' ? 'selected' : '' ?>>Roda 2 <i class="fas fa-motorcycle"></i></option>
                            <option value="roda_4" <?= old('jenis_kendaraan') === 'roda_4' ? 'selected' : '' ?>>Roda 4 <i class="fas fa-car"></i></option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save me-2"></i>Simpan</button>
                        <a href="/" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
