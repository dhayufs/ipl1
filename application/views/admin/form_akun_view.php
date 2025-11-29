<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kelola Akun /</span> <?= isset($user) ? 'Edit Akun' : 'Tambah Akun'; ?></h4>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Form Akun</h5>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <?php $action = isset($user) ? 'admin/prosesEditAkun' : 'admin/prosesTambahAkun'; ?>
        <?= form_open($action); ?>
            <?php if (isset($user)): ?>
                <input type="hidden" name="id_user" value="<?= $user['id']; ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label class="form-label">Nama Pengguna:</label>
                <input type="text" class="form-control" name="username" value="<?= isset($user) ? $user['username'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password <?= isset($user) ? '(kosongkan jika tidak diganti)' : ''; ?>:</label>
                <input type="password" class="form-control" name="password" <?= isset($user) ? '' : 'required'; ?>>
            </div>
            <?php if (!isset($user)): ?>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password:</label>
                    <input type="password" class="form-control" name="konfirmasi_password" required>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label class="form-label">ID Pelanggan:</label>
                <input type="text" class="form-control" name="id_pelanggan" value="<?= isset($user) ? $user['id_pelanggan'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role:</label>
                <select class="form-select" name="role" required>
                    <option value="user" <?= isset($user) && $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                    <option value="admin" <?= isset($user) && $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="pengelola" <?= isset($user) && $user['role'] == 'pengelola' ? 'selected' : ''; ?>>Pengelola</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('admin/kelolaAkun'); ?>" class="btn btn-secondary">Batal</a>
        <?= form_close(); ?>
    </div>
</div>