<div class="sidebar-content">
    <div class="logo-details">
        <div class="sidebar-logo text-center mr-3">
            <img src="<?= base_url('assets/img/icon/kostku.png') ?>" alt="Logo" class="logo-img">
        </div>
        <div class="logo_name">KostKu</div>
    </div>
    <ul class="nav-list">
        <li>
            <a href="<?= base_url('admin/dashboard') ?>" class="<?= service('uri')->getSegment(2) == 'dashboard' ? ' active' : '' ?>">
                <i class="fa-solid fa-gauge"></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="<?= base_url('admin/kamar') ?>" class="<?= service('uri')->getSegment(2) == 'kamar' ? ' active' : '' ?>">
                <i class="fa-solid fa-bed"></i>
                <span class="links_name">Kamar</span>
            </a>
            <span class="tooltip">Kamar</span>
        </li>
        <li>
            <a href="<?= base_url('admin/penghuni') ?>" class="<?= service('uri')->getSegment(2) == 'penghuni' ? ' active' : '' ?>">
                <i class="fa-solid fa-user"></i>
                <span class="links_name">Penghuni</span>
            </a>
            <span class="tooltip">Penghuni</span>
        </li>
        <li>
            <a href="<?= base_url('admin/tagihan') ?>" class="<?= service('uri')->getSegment(2) == 'tagihan' ? ' active' : '' ?>">
                <i class="fa-solid fa-file-invoice"></i>
                <span class="links_name">Tagihan</span>
            </a>
            <span class="tooltip">Tagihan</span>
        </li>
        <li>
            <a href="<?= base_url('admin/pembayaran') ?>" class="<?= service('uri')->getSegment(2) == 'pembayaran' ? ' active' : '' ?>">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span class="links_name">Pembayaran</span>
            </a>
            <span class="tooltip">Pembayaran</span>
        </li>
        <li>
            <a href="<?= base_url('admin/barang') ?>" class="<?= service('uri')->getSegment(2) == 'barang' ? ' active' : '' ?>">
                <i class="fa-solid fa-box"></i>
                <span class="links_name">Barang</span>
            </a>
            <span class="tooltip">Barang</span>
        </li>
        <li style="margin-top: 32px;">
            <a href="<?= base_url('logout') ?>">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="links_name">Log out</span>
            </a>
            <span class="tooltip">Log out</span>
        </li>
    </ul>
</div>
