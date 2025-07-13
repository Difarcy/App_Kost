<?= $this->extend('layouts/auth') ?>
<?= $this->section('title') ?>Login<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="login-wrapper">
    <a href="/" class="login-back-home" title="Kembali ke Beranda"><i class="fa-solid fa-arrow-right"></i></a>
    <!-- Gambar Kiri -->
    <div class="login-image">
        <img src="<?= base_url('assets/img/background/login.png') ?>" alt="Login KostKu" />
    </div>

    <!-- Form Login -->
    <div class="login-form-container">
        <form class="login-form" action="<?= base_url('login') ?>" method="post" autocomplete="off">
            <h2 class="login-title">LOGIN ADMIN</h2>
            <!-- Error Message -->
            <div class="alert-error<?= session()->getFlashdata('error') ? ' show' : '' ?>">
                <?= session()->getFlashdata('error') ?? '' ?>
            </div>

            <!-- Username -->
            <div class="form-group">
                <input type="text" id="username" name="username" required autofocus placeholder="Username">
            </div>

            <!-- Password -->
            <div class="password-wrapper">
                <input type="password" id="password" name="password" required placeholder="Password">
                <button type="button" id="togglePassword" tabindex="-1">
                    <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                </button>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">LOG IN</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
