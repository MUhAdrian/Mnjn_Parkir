<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendaraan Keluar</title>
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
                        <a class="nav-link active" aria-current="page" href="/parkir/keluar">Keluar Kendaraan</a>
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
        <div class="card mx-auto parkir-keluar-card">
            <div class="card-body">
                <h2 class="mb-4 text-center parkir-keluar-title"><i class="fas fa-sign-out-alt me-2"></i>Form Kendaraan Keluar</h2>

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

                <form action="/parkir/selesai" method="post" id="formKeluar">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="id" class="form-label">Pilih Kendaraan Keluar:</label>
                        <input type="hidden" name="id" id="selected_parkir_id">
                        <div class="list-group" id="parkirList">
                            <?php if (! empty($parkir)): ?>
                                <?php foreach ($parkir as $item): ?>
                                    <a href="#" class="list-group-item list-group-item-action list-group-item-parkir" data-id="<?= esc($item['id']); ?>">
                                        <div>
                                            <strong><?= esc($item['plat_nomor']); ?></strong>
                                            <span class="badge bg-info ms-2"><?= esc(ucfirst(str_replace('_', ' ', $item['jenis_kendaraan']))); ?></span>
                                        </div>
                                        <small class="text-muted">Masuk: <?= esc($item['waktu_masuk']); ?></small>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-info text-center" role="alert">
                                    <i class="fas fa-info-circle me-2"></i>Tidak ada kendaraan di parkiran saat ini.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-lg btn-keluar-primary" id="btnKeluarkan" disabled><i class="fas fa-check-circle me-2"></i>Keluarkan Kendaraan</button>
                        <a href="/" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const parkirList = document.getElementById('parkirList');
            const selectedParkirIdInput = document.getElementById('selected_parkir_id');
            const btnKeluarkan = document.getElementById('btnKeluarkan');

            parkirList.addEventListener('click', function(event) {
                const target = event.target.closest('.list-group-item-parkir');
                if (target) {
                    // Remove active class from all items
                    document.querySelectorAll('.list-group-item-parkir').forEach(item => {
                        item.classList.remove('active');
                    });

                    // Add active class to the clicked item
                    target.classList.add('active');

                    // Set the hidden input value
                    selectedParkirIdInput.value = target.dataset.id;

                    // Enable the button
                    btnKeluarkan.disabled = false;
                }
            });
        });
    </script>
</body>
</html>
