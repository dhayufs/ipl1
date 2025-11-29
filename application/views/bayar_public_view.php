<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bayar Tagihan Tanpa Login</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --bg-light: #f8f9fc;
            --text-dark: #5a5c69;
        }
        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--primary-color);
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 2rem;
        }
        .form-control-user {
            font-size: 0.8rem;
            border-radius: 10rem;
            padding: 1.5rem 1rem;
        }
        .btn-user {
            border-radius: 10rem;
            padding: 0.75rem 1rem;
        }
    </style>
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Bayar Tagihan Tanpa Login</h1>
                                <p class="mb-4">Masukkan ID Pelanggan dan ID Pengontrak Anda untuk melihat tagihan.</p>
                            </div>
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
                            <?php endif; ?>
                            <?= form_open('auth/cekTagihanPublic', ['class' => 'user']); ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="id_pelanggan" placeholder="ID Pelanggan (Pemilik Rumah)" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="id_pengontrak" placeholder="ID Pengontrak" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Cek Tagihan
                                </button>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/login'); ?>">Kembali ke Halaman Login</a>
                                </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
</body>
</html>