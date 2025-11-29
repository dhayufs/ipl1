<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Pilihan Pembayaran</title>
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
    <style>
        .payment-method-option {
            border: 1px solid #d9dee3;
            border-radius: .5rem;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .payment-method-option:hover {
            background-color: #f7f7f9;
        }
        .payment-method-option.selected {
            border-color: #696cff;
            background-color: #f0f1ff;
        }
    </style>
    <script type="text/javascript"
        src="<?= $this->config->item('midtrans_snap_js_url'); ?>"
        data-client-key="<?= $this->config->item('midtrans_client_key'); ?>">
    </script>
</head>
<body>
    <?php
        $is_logged_in = $this->session->userdata('logged_in');
        $kembali_url = $is_logged_in ? 'user' : 'auth/bayarTanpaLogin';
        $manual_url = $is_logged_in ? 'user/prosesPembayaranManual' : 'auth/prosesPembayaranManualPublic';
    ?>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center mb-4">
                            <a href="<?= base_url(); ?>" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bolder">Konfirmasi Pembayaran</span>
                            </a>
                        </div>
                        <p class="mb-2">Periode yang dipilih: <?= html_escape($periode); ?></p>
                        <p class="mb-4">Total Tagihan: <strong>Rp <?= number_format($total, 0, ',', '.'); ?></strong></p>
                        <hr>
                        <h5 class="mb-3">Pilih Metode Pembayaran</h5>
                        
                        <form id="pembayaran-form" method="POST" action="">
                            <input type="hidden" name="total_bayar" value="<?= html_escape($total); ?>">
                            <input type="hidden" name="periode" value="<?= html_escape($periode); ?>">
                            <?php if (!$is_logged_in): ?>
                                <input type="hidden" name="id_pelanggan" value="<?= html_escape($id_pelanggan); ?>">
                                <input type="hidden" name="id_pengontrak" value="<?= html_escape($id_pengontrak); ?>">
                            <?php endif; ?>
                            <?php foreach ($tagihan_ids as $id): ?>
                                <input type="hidden" name="tagihan_ids[]" value="<?= html_escape($id); ?>">
                            <?php endforeach; ?>

                            <?php if ($pengaturan['metode_midtrans']): ?>
                                <div class="mb-3">
                                    <label class="payment-method-option form-check" data-method="midtrans">
                                        <input type="radio" class="form-check-input" name="metode_pembayaran" value="midtrans" required>
                                        <div class="d-flex w-100">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">Bayar Otomatis (Midtrans)</h6>
                                                <small class="text-muted">Bayar dengan transfer bank, e-wallet, dll. yang diverifikasi otomatis.</small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <i class="bx bx-credit-card"></i>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($pengaturan['metode_manual']): ?>
                                <div class="mb-3">
                                    <label class="payment-method-option form-check" data-method="manual">
                                        <input type="radio" class="form-check-input" name="metode_pembayaran" value="manual" required>
                                        <div class="d-flex w-100">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">Bayar Manual (Upload Bukti TF)</h6>
                                                <small class="text-muted">Upload bukti transfer Anda untuk diverifikasi secara manual oleh admin.</small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <i class="bx bx-upload"></i>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            <?php endif; ?>
                            
                            <button type="submit" class="btn btn-primary d-grid w-100 mt-4" id="submit-button">Lanjutkan Pembayaran</button>
                        </form>

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
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    <script>
        $(document).ready(function() {
            // Handle radio button selection
            $('.payment-method-option').on('click', function() {
                $('.payment-method-option').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('input[type="radio"]').prop('checked', true);
            });

            // Handle form submission
            $('#pembayaran-form').submit(function(e) {
                var form = $(this);
                var metode = $('input[name="metode_pembayaran"]:checked').val();

                if (metode === 'manual') {
                    form.attr('action', '<?= base_url($manual_url); ?>');
                    return true;
                } else if (metode === 'midtrans') {
                    e.preventDefault();
                    form.attr('action', '<?= base_url($is_logged_in ? 'user/bayarViaMidtrans' : 'auth/bayarViaMidtransPublic'); ?>');
                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: form.serialize(),
                        dataType: 'json',
                        beforeSend: function() {
                            $('#submit-button').text('Memproses...').prop('disabled', true);
                        },
                        success: function(response) {
                            if (response.token) {
                                console.log('Midtrans token received:', response.token);
                                if (typeof snap !== 'undefined') {
                                    snap.pay(response.token, {
                                        onSuccess: function(result) {
                                            alert('Pembayaran Berhasil!');
                                            window.location.href = '<?= base_url($kembali_url); ?>';
                                        },
                                        onPending: function(result) {
                                            alert('Pembayaran pending, menunggu konfirmasi.');
                                            window.location.href = '<?= base_url($kembali_url); ?>';
                                        },
                                        onError: function(result) {
                                            alert('Pembayaran gagal, silakan coba lagi.');
                                            $('#submit-button').text('Lanjutkan Pembayaran').prop('disabled', false);
                                        },
                                        onClose: function() {
                                            alert('Anda menutup jendela pembayaran.');
                                            $('#submit-button').text('Lanjutkan Pembayaran').prop('disabled', false);
                                        }
                                    });
                                } else {
                                    alert('Midtrans Snap tidak tersedia. Coba refresh halaman.');
                                    $('#submit-button').text('Lanjutkan Pembayaran').prop('disabled', false);
                                }
                            } else {
                                console.error('Failed to get token:', response.error);
                                alert('Gagal mendapatkan token: ' + response.error);
                                $('#submit-button').text('Lanjutkan Pembayaran').prop('disabled', false);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            alert('Terjadi kesalahan pada server. Silakan coba lagi.');
                            $('#submit-button').text('Lanjutkan Pembayaran').prop('disabled', false);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>