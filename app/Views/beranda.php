<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KostKu - Beranda</title>
    <link rel="icon" type="image/x-icon" href="/assets/img/icon/kostku.ico">
    <link rel="stylesheet" href="/assets/css/beranda.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <img src="/assets/img/icon/kostku.png" alt="KostKu Logo" class="logo-img">
            <span class="logo-text">KostKu</span>
        </div>
        <nav class="nav-menu">
            <a href="#home">Home</a>
            <a href="#kamar">Kamar Kosong</a>
            <a href="#tagihan">Tagihan</a>
            <a href="#kontak">Kontak</a>
        </nav>
        <div class="nav-actions">
            <a href="/login" class="btn btn-register">Akses Admin</a>
        </div>
    </header>

    <main class="hero-section" id="home">
        <section class="hero-content">
            <h1>Hunian <span class="highlight">Kost</span> Terbaik, Informasi Terlengkap</h1>
            <p class="subtitle">Lihat kamar kosong, cek harga sewa, dan pantau status pembayaran kost Anda dengan mudah melalui KostKu.</p>
            <div class="hero-actions">
                <a href="#kamar" class="btn btn-explore">Cari Kost</a>
            </div>
        </section>
        <div class="hero-image-right">
            <img src="/assets/img/background/kost.png" alt="Kost Modern" class="kost-image-right">
        </div>
    </main>

    <!-- Section Kamar Kosong -->
    <section id="kamar" class="section-content section-scroll">
        <div class="container">
            <h2>Kamar Kosong</h2>
            <div class="kost-slider-wrapper">
                <button class="kost-slider-btn kost-slider-btn-left" aria-label="Sebelumnya"><span>&lt;</span></button>
                <div class="kost-slider-viewport">
                    <div class="kost-grid kost-slider">
                        <!-- Blok 1: Kost 1-4 -->
                        <div class="kost-card">
                            <img src="/assets/img/background/kost1.png" alt="Kamar 1" class="kost-card-img">
                            <div class="kost-card-title">Kamar 1</div>
                            <div class="kost-card-info">Ukuran 3x4m, Kamar mandi dalam, AC, WiFi, Listrik token</div>
                            <div class="kost-card-price">Rp1.200.000/bulan</div>
                        </div>
                        <div class="kost-card">
                            <img src="/assets/img/background/kost1.png" alt="Kamar 2" class="kost-card-img">
                            <div class="kost-card-title">Kamar 2</div>
                            <div class="kost-card-info">Ukuran 3x3m, Kamar mandi luar, Kipas angin, WiFi</div>
                            <div class="kost-card-price">Rp1.350.000/bulan</div>
                        </div>
                        <div class="kost-card">
                            <img src="/assets/img/background/kost1.png" alt="Kamar 3" class="kost-card-img">
                            <div class="kost-card-title">Kamar 3</div>
                            <div class="kost-card-info">Ukuran 2.8x3m, Kamar mandi dalam, AC, WiFi, Listrik token</div>
                            <div class="kost-card-price">Rp1.500.000/bulan</div>
                        </div>
                        <div class="kost-card">
                            <img src="/assets/img/background/kost1.png" alt="Kamar 4" class="kost-card-img">
                            <div class="kost-card-title">Kamar 4</div>
                            <div class="kost-card-info">Ukuran 3x4m, Kamar mandi luar, Kipas angin, WiFi</div>
                            <div class="kost-card-price">Rp1.700.000/bulan</div>
                        </div>
                        <!-- Blok 2: Kost 5-8 -->
                        <div class="kost-card">
                            <img src="/assets/img/background/kost1.png" alt="Kamar 5" class="kost-card-img">
                            <div class="kost-card-title">Kamar 5</div>
                            <div class="kost-card-info">Ukuran 3x3m, Kamar mandi dalam, AC, WiFi</div>
                            <div class="kost-card-price">Rp1.250.000/bulan</div>
                        </div>
                        <div class="kost-card">
                            <img src="/assets/img/background/kost1.png" alt="Kamar 6" class="kost-card-img">
                            <div class="kost-card-title">Kamar 6</div>
                            <div class="kost-card-info">Ukuran 2.5x3m, Kamar mandi luar, Kipas angin, WiFi</div>
                            <div class="kost-card-price">Rp1.100.000/bulan</div>
                        </div>
                        <div class="kost-card">
                            <img src="/assets/img/background/kost1.png" alt="Kamar 7" class="kost-card-img">
                            <div class="kost-card-title">Kamar 7</div>
                            <div class="kost-card-info">Ukuran 3x4m, Kamar mandi dalam, AC, WiFi, Listrik token</div>
                            <div class="kost-card-price">Rp1.800.000/bulan</div>
                        </div>
                        <div class="kost-card">
                            <img src="/assets/img/background/kost1.png" alt="Kamar 8" class="kost-card-img">
                            <div class="kost-card-title">Kamar 8</div>
                            <div class="kost-card-info">Ukuran 3x3m, Kamar mandi luar, Kipas angin, WiFi</div>
                            <div class="kost-card-price">Rp1.300.000/bulan</div>
                </div>
                </div>
                </div>
                <button class="kost-slider-btn kost-slider-btn-right" aria-label="Berikutnya"><span>&gt;</span></button>
            </div>
        </div>
    </section>
    <!-- Section Tagihan -->
    <section id="tagihan" class="section-content section-scroll">
        <div class="container">
            <h2>Tagihan</h2>
            <div class="tagihan-info">
              <h3>Kamar Hampir Jatuh Tempo Bayar</h3>
              <?php if (!empty($hampirJatuhTempo)): ?>
                <ul class="tagihan-list">
                  <?php foreach ($hampirJatuhTempo as $row): ?>
                    <li>
                      Kamar <b><?= esc($row['nomor_kamar']) ?></b> (<?= esc($row['nama_penghuni']) ?>) - Tanggal Masuk: <?= date('d M Y', strtotime($row['tgl_masuk'])) ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <div class="tagihan-empty">Tidak ada kamar yang hampir jatuh tempo bayar.</div>
              <?php endif; ?>
              <h3>Kamar Terlambat Bayar</h3>
              <?php if (!empty($terlambatBayar)): ?>
                <ul class="tagihan-list">
                  <?php foreach ($terlambatBayar as $row): ?>
                    <li>
                      Kamar <b><?= esc($row['nomor_kamar']) ?></b> (<?= esc($row['nama_penghuni']) ?>) - Tagihan Bulan: <?= date('M Y', strtotime($row['bulan'])) ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <div class="tagihan-empty">Tidak ada kamar yang terlambat bayar.</div>
              <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Section Kontak -->
    <section id="kontak" class="section-content section-scroll">
        <div class="container">
            <h2>Kontak</h2>
            <ul class="contact-list">
                <li><i class="fa-solid fa-envelope contact-icon"></i> Email: info@kostku.com</li>
                <li><i class="fa-brands fa-whatsapp contact-icon"></i> Whatsapp: +62 812-3456-789</li>
                <li><i class="fa-solid fa-location-dot contact-icon"></i> Alamat: Jl. Kost Modern No. 1, Pasar Minggu, Jakarta Selatan</li>
            </ul>
                </div>
    </section>

    <footer class="footer-pro2025 footer-black">
        <div class="footer-main">
            <div class="footer-col brand-col">
                <div class="footer-brand-row">
                    <img src="/assets/img/icon/kostku.png" alt="KostKu Logo" class="footer-logo">
                    <span class="footer-title">KostKu</span>
                </div>
                <p class="footer-desc">KostKu menyediakan informasi kost terbaik dengan lingkungan yang nyaman, aman, dan terpercaya, untuk mendukung hunian ideal sesuai gaya hidup Anda.</p>
                </div>
            <div class="footer-col menu-col">
                <h4>KOSTKU</h4>
                <ul>
                    <li><a href="#home" class="footer-link">Tentang Kami</a></li>
                    <li><a href="#kamar" class="footer-link">Kamar Kosong</a></li>
                    <li><a href="#tagihan" class="footer-link">Tagihan</a></li>
                    <li><a href="#kontak" class="footer-link">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-col kontak-col">
                <h4>HUBUNGI KAMI</h4>
                <ul>
                    <li><span class="footer-icon"><i class="fa-solid fa-envelope"></i></span> <a href="mailto:info@kostku.com">info@kostku.com</a></li>
                    <li><span class="footer-icon"><i class="fa-brands fa-whatsapp"></i></span> <a href="https://wa.me/628123456789" target="_blank">+62 812-3456-789</a></li>
                    <li><span class="footer-icon"><i class="fa-solid fa-location-dot"></i></span> Jl. Kost Modern No. 1, Pasar Minggu, Jakarta Selatan</li>
                    <li class="footer-social">
                        <a href="#" title="Instagram" class="footer-soc"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" title="Twitter" class="footer-soc"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" title="Facebook" class="footer-soc"><i class="fa-brands fa-facebook"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <div class="footer-copyright">&copy; 2025 KostKu.com. All rights reserved</div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="/assets/js/beranda.js"></script>
</body>
</html>
