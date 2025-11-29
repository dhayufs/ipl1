<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Daftar Tagihan /</span> Semua Tagihan</h4>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Semua Tagihan</h5>
    </div>
    <div class="card-body">
        <?php if ($tagihan_lainnya): ?>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Pelanggan</th>
                            <th>ID Pengontrak</th>
                            <th>Nama</th>
                            <th>Periode</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Pembayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tagihan_lainnya as $row): ?>
                            <tr>
                                <td data-label="ID Pelanggan:"><?= $row['id_pelanggan']; ?></td>
                                <td data-label="ID Pengontrak:"><?= !empty($row['id_pengontrak']) ? $row['id_pengontrak'] : '-'; ?></td>
                                <td data-label="Nama:"><?= $row['username']; ?></td>
                                <td data-label="Periode:"><?= $row['periode']; ?></td>
                                <td data-label="Jumlah:">Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                                <td data-label="Status:"><span class="badge bg-label-secondary me-1"><?= $row['status_bayar']; ?></span></td>
                                <td data-label="Pembayar:">
                                    <?php if (!empty($row['id_pengontrak'])): ?>
                                        <?= $row['nama_pengontrak'] . ' (Pengontrak)'; ?>
                                    <?php else: ?>
                                        <?= $row['username'] . ' (Pemilik)'; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Tidak ada tagihan lainnya.</p>
        <?php endif; ?>
    </div>
</div>