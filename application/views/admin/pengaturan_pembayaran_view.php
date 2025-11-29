<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan /</span> Pembayaran</h4>
<?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('pesan'); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Kelola Metode Pembayaran</h5>
    </div>
    <div class="card-body">
        <?= form_open('admin/prosesPengaturanPembayaran'); ?>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="metode_manual" id="metodeManual" value="1" <?= $pengaturan['metode_manual'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="metodeManual">Aktifkan Pembayaran Manual (Upload Bukti)</label>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="metode_midtrans" id="metodeMidtrans" value="1" <?= $pengaturan['metode_midtrans'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="metodeMidtrans">Aktifkan Pembayaran Otomatis (Midtrans)</label>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        <?= form_close(); ?>
    </div>
</div>