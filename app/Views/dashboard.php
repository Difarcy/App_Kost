<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Dashboard</h2>

<div class="main-container">
    <!-- Widget top -->
    <div class="dashboard-widgets">
        <div class="widget widget-blue">
            <div class="widget-title">Kamar</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-bed"></i></div>
                <div class="widget-value">
                  <?php $n = $totalKamar ?? 0; echo $n . ' ' . ($n == 1 ? 'Kamar' : 'Kamar'); ?>
                </div>
            </div>
        </div>
        <div class="widget widget-pink">
            <div class="widget-title">Penghuni</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-user"></i></div>
                <div class="widget-value">
                  <?php $n = $totalPenghuni ?? 0; echo $n . ' ' . ($n == 1 ? 'Penghuni' : 'Penghuni'); ?>
                </div>
            </div>
        </div>
        <div class="widget widget-green">
            <div class="widget-title">Tagihan</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-file-invoice"></i></div>
                <div class="widget-value">
                  <?php $n = $totalTagihan ?? 0; echo $n . ' ' . ($n == 1 ? 'Tagihan' : 'Tagihan'); ?>
                </div>
            </div>
        </div>
        <div class="widget widget-yellow">
            <div class="widget-title">Pembayaran</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                <div class="widget-value">
                  <?php $n = $totalPembayaran ?? 0; echo $n . ' ' . ($n == 1 ? 'Pembayaran' : 'Pembayaran'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Grafik Pendapatan Perbulan -->
    <div class="main-card">
      <div class="main-content">
        <div class="grafik-title">Grafik Pendapatan Perbulan</div>
        <div class="grafik-bar-chart"></div>
        <script>
          window.grafikPendapatan = <?= json_encode($grafikPendapatan ?? []) ?>;
        </script>
      </div>
    </div>
    <!-- Sisakan bagian lain jika perlu -->
</div>
<?= $this->endSection() ?> 