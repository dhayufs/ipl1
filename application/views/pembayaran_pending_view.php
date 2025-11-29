<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Pembayaran Diproses</title>
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
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="app-brand justify-content-center mb-4">
                            <a href="<?= base_url(); ?>" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bolder">Pembayaran Diproses</span>
                            </a>
                        </div>
                        <h4 class="mb-2">Pembayaran Anda Sedang Diproses 👋</h4>
                        <div class="alert alert-info" role="alert">
                            <p>Bukti transfer Anda sudah kami terima dan saat ini sedang menunggu konfirmasi dari admin.</p>
                            <p>Mohon tunggu, kami akan segera memperbarui status tagihan Anda.</p>
                        </div>
                        <div class="mt-3">
                            <a href="<?= base_url('auth/bayarTanpaLogin'); ?>" class="btn btn-primary d-grid w-100">
                                Kembali ke Halaman Utama
                            </a>
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