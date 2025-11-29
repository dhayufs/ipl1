<h1 class="h3 mb-4 text-gray-800">Validasi Bukti Transfer</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bukti Pembayaran untuk Tagihan <?= $tagihan['periode']; ?></h6>
                    </div>
                    <div class="card-body">
                        <p>ID Pelanggan: **<?= html_escape($tagihan['id_pelanggan']); ?>**</p>
                        <p>Nama: **<?= html_escape($tagihan['nama_pelanggan']); ?>**</p>
                        <p>Jumlah: **Rp <?= number_format($tagihan['jumlah'], 0, ',', '.'); ?>**</p>
                        <p>Tanggal Bayar: **<?= $tagihan['tanggal_bayar'] ? date('d-m-Y H:i', strtotime($tagihan['tanggal_bayar'])) : '-'; ?>**</p>
                        <hr>
                        <h3>Gambar Bukti Transfer:</h3>
                        <?php if (!empty($tagihan['bukti_transfer'])): ?>
                            <img src="<?= base_url('uploads/bukti_transfer/' . html_escape($tagihan['bukti_transfer'])); ?>" alt="Bukti Transfer" class="img-fluid" style="max-width: 500px; height: auto;">
                        <?php else: ?>
                            <p class="text-danger">Tidak ada bukti transfer yang diunggah.</p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('admin/terimaBuktiTransfer/' . html_escape($tagihan['id_tagihan'])); ?>" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menerima bukti transfer ini?');">Terima Bukti Transfer</a>
                        <a href="<?= base_url('admin/tolakBuktiTransfer/' . html_escape($tagihan['id_tagihan'])); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menolak bukti transfer ini?');">Tolak Bukti Transfer</a>
                        <a href="<?= base_url('admin/konfirmasiPembayaran'); ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </div>