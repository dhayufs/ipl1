<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Konfirmasi /</span> Pembayaran</h4>
<?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('pesan'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tagihan Menunggu Konfirmasi (Pending)</h5>
    </div>
    <div class="card-body">
        <?php if ($tagihan_pending): ?>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Pelanggan</th>
                            <th>ID Pengontrak</th>
                            <th>Nama</th>
                            <th>Periode</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tagihan_pending as $row): ?>
                            <tr>
                                <td data-label="ID Pelanggan:"><?= $row['id_pelanggan']; ?></td>
                                <td data-label="ID Pengontrak:"><?= !empty($row['id_pengontrak']) ? $row['id_pengontrak'] : '-'; ?></td>
                                <td data-label="Nama:">
                                    <?php if (!empty($row['id_pengontrak'])): ?>
                                        <?= $row['nama_pengontrak'] . ' (Pengontrak)'; ?>
                                    <?php else: ?>
                                        <?= $row['username'] . ' (Pemilik)'; ?>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Periode:"><?= $row['periode']; ?></td>
                                <td data-label="Jumlah:">Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                                <td data-label="Aksi:">
                                    <a href="<?= base_url('admin/approvePembayaran/' . $row['id_tagihan']); ?>" class="btn btn-success btn-sm">Approve</a>
                                    <a href="<?= base_url('admin/tolakPembayaran/' . $row['id_tagihan']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menolak pembayaran ini?');">Tolak</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Tidak ada tagihan yang menunggu konfirmasi.</p>
        <?php endif; ?>
    </div>
</div>