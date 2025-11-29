<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Konfirmasi /</span> Lihat Bukti</h4>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Pembayaran</h5>
    </div>
    <div class="card-body">
        <p>ID Pelanggan: <strong><?= html_escape($tagihan['id_pelanggan']); ?></strong></p>
        <p>Nama: <strong><?= html_escape($tagihan['nama_pelanggan']); ?></strong></p>
        <p>Periode: <strong><?= html_escape($tagihan['periode']); ?></strong></p>
        <p>Jumlah: <strong>Rp <?= number_format($tagihan['jumlah'], 0, ',', '.'); ?></strong></p>
        <p>Tanggal Bayar: <strong><?= $tagihan['tanggal_bayar'] ? date('d-m-Y H:i', strtotime($tagihan['tanggal_bayar'])) : '-'; ?></strong></p>
        <hr>
        <h5>Gambar Bukti Transfer:</h5>
        <?php if (!empty($tagihan['bukti_transfer'])): ?>
            <img src="<?= base_url('uploads/bukti_transfer/' . html_escape($tagihan['bukti_transfer'])); ?>" alt="Bukti Transfer" class="img-fluid d-block mx-auto" style="max-width: 100%; height: auto;">
        <?php else: ?>
            <p class="text-danger">Tidak ada bukti transfer yang diunggah.</p>
        <?php endif; ?>
    </div>
    <div class="card-footer">
        <a href="<?= base_url('admin/approvePembayaran/' . html_escape($tagihan['id_tagihan'])); ?>" class="btn btn-success">Approve Pembayaran</a>
        <a href="<?= base_url('admin/tolakPembayaran/' . html_escape($tagihan['id_tagihan'])); ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menolak pembayaran ini?');">Tolak Pembayaran</a>
        <a href="<?= base_url('admin/konfirmasiPembayaran'); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>