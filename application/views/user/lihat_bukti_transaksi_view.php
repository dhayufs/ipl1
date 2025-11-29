<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Lihat Bukti</h4>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Transaksi</h5>
    </div>
    <div class="card-body">
        <p>ID Pelanggan: <strong><?= html_escape($transaksi['id_pelanggan']); ?></strong></p>
        <p>ID Pengontrak: <strong><?= !empty($transaksi['id_pengontrak']) ? html_escape($transaksi['id_pengontrak']) : '-'; ?></strong></p>
        <p>Total Bayar: <strong>Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.'); ?></strong></p>
        <p>Tanggal Bayar: <strong><?= date('d-m-Y H:i', strtotime($transaksi['tanggal_bayar'])); ?></strong></p>
        <hr>
        <h5>Gambar Bukti Transfer:</h5>
        <?php if (!empty($transaksi['bukti_transfer'])): ?>
            <img src="<?= base_url('uploads/bukti_transfer/' . html_escape($transaksi['bukti_transfer'])); ?>" alt="Bukti Transfer" class="img-fluid d-block mx-auto" style="max-width: 100%; height: auto;">
        <?php else: ?>
            <p class="text-danger">Tidak ada bukti transfer yang diunggah.</p>
        <?php endif; ?>
    </div>
    <div class="card-footer">
        <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>