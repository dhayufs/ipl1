<h1 class="h3 mb-4 text-gray-800">Unggah Bukti Transfer</h1>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Tagihan</h6>
                    </div>
                    <div class="card-body">
                        <p>Periode: **<?= html_escape($tagihan['periode']); ?>**</p>
                        <p>Jumlah: **Rp <?= number_format($tagihan['jumlah'], 0, ',', '.'); ?>**</p>
                        <hr>
                        <?= form_open_multipart('user/prosesUploadBuktiSingle'); ?>
                            <input type="hidden" name="id_tagihan" value="<?= html_escape($tagihan['id_tagihan']); ?>">
                            <div class="form-group">
                                <label for="bukti_transfer">Pilih File Bukti Transfer:</label>
                                <input type="file" class="form-control" name="bukti_transfer" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Unggah & Konfirmasi Pembayaran</button>
                        <?= form_close(); ?>
                    </div>
                </div>