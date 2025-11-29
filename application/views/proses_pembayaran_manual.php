<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Upload Bukti Pembayaran</title>
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
    <?php
        $is_logged_in = $this->session->userdata('logged_in');
        $kembali_url = $is_logged_in ? 'user' : 'auth/bayarTanpaLogin';
        $proses_url = $is_logged_in ? 'user/prosesUploadBukti' : 'auth/prosesUploadBuktiPublic';

        // Ambil data dari query string
        $total = $this->input->get('total');
        $periode = $this->input->get('periode');
        $tagihan_ids = $this->input->get('tagihan_ids');
        $id_pelanggan = $this->input->get('id_pelanggan');
        $id_pengontrak = $this->input->get('id_pengontrak');
    ?>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center mb-4">
                            <a href="<?= base_url(); ?>" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bolder">Upload Bukti Transfer</span>
                            </a>
                        </div>
                        <p class="mb-2">Periode yang dipilih: <?= html_escape($periode); ?></p>
                        <p class="mb-4">Total Tagihan: <strong>Rp <?= number_format($total, 0, ',', '.'); ?></strong></p>
                        <hr>
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        
                        <?= form_open_multipart($proses_url, ['class' => 'mb-3']); ?>
                            <input type="hidden" name="total_bayar" value="<?= html_escape($total); ?>">
                            <?php if (!$is_logged_in): ?>
                                <input type="hidden" name="id_pelanggan" value="<?= html_escape($id_pelanggan); ?>">
                                <input type="hidden" name="id_pengontrak" value="<?= html_escape($id_pengontrak); ?>">
                            <?php endif; ?>
                            <?php if (is_array($tagihan_ids)): ?>
                                <?php foreach ($tagihan_ids as $id): ?>
                                    <input type="hidden" name="tagihan_ids[]" value="<?= html_escape($id); ?>">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <input type="hidden" name="tagihan_ids[]" value="<?= html_escape($tagihan_ids); ?>">
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="bukti_transfer" class="form-label">Pilih File Bukti Transfer (JPG, PNG, GIF, maks 2MB):</label>
                                <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" required>
                            </div>
                            <button class="btn btn-primary d-grid w-100" type="submit">Upload dan Kirim</button>
                        <?= form_close(); ?>

                        <div class="text-center mt-3">
                            <a href="<?= base_url($kembali_url); ?>"><span>Kembali</span></a>
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
</body>
</html>