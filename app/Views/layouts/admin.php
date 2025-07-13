<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $this->renderSection('title') ?> | KostKu</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/icon/kostku.ico') ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/tabel.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pagination.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/button.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/modal.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/layout.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/alert.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/grafik.css') ?>">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-papm6Q+..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tambahan CSS dari halaman -->
    <?= $this->renderSection('styles') ?>

</head>
<body>
    <div class="layout-root">
        <!-- Sidebar -->
        <?= $this->include('partials/sidebar') ?>

        <!-- Header -->
        <?= $this->include('partials/header') ?>

        <div class="layout-main">
            <main>
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="<?= base_url('assets/js/modal.js') ?>"></script>
    <script src="<?= base_url('assets/js/grafik.js') ?>"></script>
    <script src="<?= base_url('assets/js/kamar.js') ?>"></script>
    <script src="<?= base_url('assets/js/penghuni.js') ?>"></script>
    <script src="<?= base_url('assets/js/tagihan.js') ?>"></script>
    <script src="<?= base_url('assets/js/pembayaran.js') ?>"></script>
    <script src="<?= base_url('assets/js/barang.js') ?>"></script>
    <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
    <!-- Tambahan Script dari halaman -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>