<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan /</span> Midtrans</h4>
<?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('pesan'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Konfigurasi Midtrans API</h5>
    </div>
    <div class="card-body">
        <?= form_open('admin/saveMidtransSettings'); ?>
            <div class="mb-3">
                <label class="form-label">Merchant ID:</label>
                <input type="text" class="form-control" name="merchant_id" value="<?= isset($settings['merchant_id']) ? $settings['merchant_id'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Midtrans Server Key:</label>
                <input type="text" class="form-control" name="server_key" value="<?= isset($settings['server_key']) ? $settings['server_key'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Midtrans Client Key:</label>
                <input type="text" class="form-control" name="client_key" value="<?= isset($settings['client_key']) ? $settings['client_key'] : ''; ?>" required>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="is_production" value="1" id="isProduction" <?= isset($settings['is_production']) && $settings['is_production'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="isProduction">Mode Produksi (Centang jika sudah live)</label>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        <?= form_close(); ?>
    </div>
</div>