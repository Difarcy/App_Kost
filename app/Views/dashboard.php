<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Dashboard</h2>

<div class="main-container">
    <!-- Widget top -->
    <div class="dashboard-widgets">
        <div class="widget widget-blue">
            <div class="widget-title">Total Kamar</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-bed"></i></div>
                <div class="widget-value"><?= esc($totalKamar ?? 0) ?></div>
            </div>
        </div>
        <div class="widget widget-pink">
            <div class="widget-title">Total Penghuni</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-user"></i></div>
                <div class="widget-value"><?= esc($totalPenghuni ?? 0) ?></div>
            </div>
        </div>
        <div class="widget widget-green">
            <div class="widget-title">Total Tagihan</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-file-invoice"></i></div>
                <div class="widget-value"><?= esc($totalTagihan ?? 0) ?></div>
            </div>
        </div>
        <div class="widget widget-yellow">
            <div class="widget-title">Total Pembayaran</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                <div class="widget-value"><?= esc($totalPembayaran ?? 0) ?></div>
            </div>
        </div>
        <div class="widget widget-purple">
            <div class="widget-title">Total Barang</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-box"></i></div>
                <div class="widget-value"><?= esc($totalBarang ?? 0) ?></div>
            </div>
        </div>
    </div>
    <!-- Sisakan bagian lain jika perlu -->
</div>
<?= $this->endSection() ?> 