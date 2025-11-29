<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan /</span> Ubah Profil</h4>
<?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('pesan'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Form Ubah Profil</h5>
    </div>
    <div class="card-body">
        <?= form_open('user/prosesUbahProfil'); ?>
            <div class="mb-3">
                <label class="form-label" for="username_baru">Nama Pengguna Baru:</label>
                <input type="text" class="form-control" id="username_baru" name="username_baru" value="<?= $this->session->userdata('username'); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password_lama">Password Lama:</label>
                <input type="password" class="form-control" id="password_lama" name="password_lama" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password_baru">Password Baru (kosongkan jika tidak ingin ganti):</label>
                <input type="password" class="form-control" id="password_baru" name="password_baru">
            </div>
            <div class="mb-3">
                <label class="form-label" for="konfirmasi_password">Konfirmasi Password Baru:</label>
                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <?= form_close(); ?>
    </div>
</div>