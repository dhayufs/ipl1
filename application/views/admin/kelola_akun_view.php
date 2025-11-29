<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kelola Akun /</span> Daftar Akun</h4>
<?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('pesan'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Akun Pengguna</h5>
    </div>
    <div class="card-body">
        <?php if ($users): ?>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pengguna</th>
                            <th>ID Pelanggan</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td data-label="ID:"><?= $user['id']; ?></td>
                                <td data-label="Nama Pengguna:"><?= $user['username']; ?></td>
                                <td data-label="ID Pelanggan:"><?= $user['id_pelanggan']; ?></td>
                                <td data-label="Role:"><span class="badge bg-label-secondary me-1"><?= $user['role']; ?></span></td>
                                <td data-label="Aksi:">
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="<?= base_url('admin/editAkun/' . $user['id']); ?>" class="btn btn-warning"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a href="<?= base_url('admin/hapusAkun/' . $user['id']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');" class="btn btn-danger"><i class="bx bx-trash me-1"></i> Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Tidak ada akun yang terdaftar.</p>
        <?php endif; ?>
    </div>
    <div class="card-footer">
        <a href="<?= base_url('admin/tambahAkun'); ?>" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah Akun
        </a>
    </div>
</div>