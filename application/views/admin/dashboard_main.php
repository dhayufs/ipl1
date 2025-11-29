<h1 class="h3 mb-4 text-gray-800">Dashboard Utama Admin</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Selamat Datang</h6>
                    </div>
                    <div class="card-body">
                        <p>Selamat datang, admin! Silakan gunakan menu di samping untuk mengelola data tagihan dan pembayaran.</p>
                        <p>Anda bisa:</p>
                        <ul>
                            <li><a href="<?= base_url('admin/inputTagihan'); ?>">Input Tagihan Baru</a></li>
                            <li><a href="<?= base_url('admin/konfirmasiPembayaran'); ?>">Konfirmasi Pembayaran yang Masih Pending</a></li>
                            <li><a href="<?= base_url('admin/semuaTagihan'); ?>">Melihat Semua Daftar Tagihan</a></li>
                        </ul>
                    </div>
                </div>