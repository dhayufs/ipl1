<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Fitur /</span> Lapor Pengontrak</h4>
<?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('pesan'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<?php if (!$pengontrak_sudah_ada): ?>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Pengontrak Baru</h5>
        </div>
        <div class="card-body">
            <?= form_open('user/prosesLaporPengontrak'); ?>
                <div class="mb-3">
                    <label class="form-label" for="nama_pengontrak">Nama Pengontrak:</label>
                    <input type="text" class="form-control" id="nama_pengontrak" name="nama_pengontrak" required>
                </div>
                <button type="submit" class="btn btn-primary">Buat Laporan</button>
            <?= form_close(); ?>
        </div>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Pengontrak</h5>
    </div>
    <div class="card-body">
        <?php if ($kontrakan): ?>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Pengontrak</th>
                            <th>ID Pengontrak</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kontrakan as $row): ?>
                            <tr>
                                <td data-label="Nama Pengontrak:"><?= $row['nama_pengontrak']; ?></td>
                                <td data-label="ID Pengontrak:"><?= $row['id_pengontrak']; ?></td>
                                <td data-label="Status:"><span class="badge bg-label-success me-1"><?= $row['status']; ?></span></td>
                                <td data-label="Aksi:">
                                    <a href="<?= base_url('user/hapusPengontrak/' . $row['id_kontrakan']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-danger btn-sm"><i class="bx bx-trash me-1"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Anda belum melaporkan pengontrak rumah.</p>
        <?php endif; ?>
    </div>
</div>