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
            <a href="#home" class="active">Home</a>
            <a href="#kamar">Kamar Kosong</a>
            <a href="#tagihan">Tagihan</a>
            <a href="#penghuni">Penghuni</a>
            <a href="#kontak">Kontak</a>
        </nav>
        <div class="nav-actions">
            <a href="/auth/register" class="btn btn-register">Akses Admin</a>
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
    </main>

    <!-- Section Kamar Kosong -->
    <section id="kamar" class="section-content">
        <div class="container">
            <h2>Kamar Kosong</h2>
            <p>Daftar kamar kosong dan harga sewanya akan tampil di sini.</p>
        </div>
    </section>
    <!-- Section Tagihan -->
    <section id="tagihan" class="section-content">
        <div class="container">
            <h2>Tagihan</h2>
            <p>Informasi tagihan kamar yang harus dibayar dan yang terlambat bayar.</p>
        </div>
    </section>
    <!-- Section Penghuni -->
    <section id="penghuni" class="section-content">
        <div class="container">
            <h2>Penghuni</h2>
            <p>Daftar penghuni kost dan detailnya akan tampil di sini.</p>
        </div>
    </section>
    <!-- Section Kontak -->
    <section id="kontak" class="section-content">
        <div class="container">
            <h2>Kontak</h2>
            <ul class="contact-list">
                <li><i class="fa-solid fa-envelope contact-icon"></i> Email: <a href="mailto:info@kostku.com">info@kostku.com</a></li>
                <li><i class="fa-solid fa-phone contact-icon"></i> Telepon: <a href="tel:+628123456789">+62 812-3456-789</a></li>
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
                    <li><a href="#home">Tentang Kami</a></li>
                    <li><a href="#kamar">Kamar Kosong</a></li>
                    <li><a href="#tagihan">Tagihan</a></li>
                    <li><a href="#penghuni">Penghuni</a></li>
                    <li><a href="#kontak">Kontak</a></li>
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
