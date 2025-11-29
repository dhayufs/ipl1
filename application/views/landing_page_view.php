<!DOCTYPE html>
<html lang="id" class="light-style customizer-hide">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Aplikasi Pembayaran IPL</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/sneat/img/favicon/favicon.ico'); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/fonts/boxicons.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/css/core.css'); ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/css/theme-default.css'); ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/css/demo.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/css/pages/page-auth.css'); ?>" />
    <script src="<?= base_url('assets/sneat/vendor/js/helpers.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/js/config.js'); ?>"></script>
</head>
<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="app-brand justify-content-center mb-4">
                            <a href="<?= base_url(); ?>" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bolder">Aplikasi IPL</span>
                            </a>
                        </div>
                        <h4 class="mb-2">Selamat Datang! 👋</h4>
                        <p class="mb-4">Solusi mudah untuk mengelola dan membayar iuran pemeliharaan lingkungan Anda.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="<?= base_url('auth/bayarTanpaLogin'); ?>" class="btn btn-primary d-grid">Bayar Tanpa Login</a>
                            <a href="<?= base_url('auth/login'); ?>" class="btn btn-secondary d-grid">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/sneat/vendor/libs/jquery/jquery.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/libs/popper/popper.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/js/bootstrap.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/js/menu.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/js/main.js'); ?>"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>