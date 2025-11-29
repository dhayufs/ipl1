<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Pengguna</h4>
<?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('pesan'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tagihan Belum Lunas</h5>
    </div>
    <div class="card-body">
        <?= form_open('user/bayarPilihan'); ?>
        <?php if ($tagihan_aktif): ?>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Periode</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tagihan_aktif as $tagihan): ?>
                            <tr>
                                <td data-label="Pilih:">
                                    <?php if ($tagihan['status_bayar'] == 'Belum Bayar' || $tagihan['status_bayar'] == 'Pending Midtrans'): ?>
                                        <input type="checkbox" name="tagihan_ids[]" value="<?= $tagihan['id_tagihan']; ?>">
                                    <?php endif; ?>
                                </td>
                                <td data-label="Periode:"><?= $tagihan['periode']; ?></td>
                                <td data-label="Jumlah:">Rp <?= number_format($tagihan['jumlah'], 0, ',', '.'); ?></td>
                                <td data-label="Status:">
                                    <span class="badge bg-label-warning me-1"><?= $tagihan['status_bayar']; ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-success mt-3 d-block w-100 w-md-auto">Bayar Tagihan Terpilih</button>
        <?php else: ?>
            <p>Anda tidak memiliki tagihan yang belum lunas atau masih pending.</p>
        <?php endif; ?>
        <?= form_close(); ?>
    </div>
</div>
                
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Histori Pembayaran Lunas</h5>
    </div>
    <div class="card-body">
        <?php if ($histori_lunas): ?>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Jumlah</th>
                            <th>Tanggal Bayar</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($histori_lunas as $row): ?>
                            <tr>
                                <td data-label="Periode:"><?= $row['periode']; ?></td>
                                <td data-label="Jumlah:">Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                                <td data-label="Tanggal Bayar:"><?= date('d-m-Y H:i', strtotime($row['tanggal_bayar'])); ?></td>
                                <td data-label="Bukti:">
                                    <?php if ($row['bukti_transfer'] == 'Lunas Via Midtrans'): ?>
                                        <span class="badge bg-label-success">Lunas Via Midtrans</span>
                                    <?php elseif (!empty($row['bukti_transfer'])): ?>
                                        <div class="d-grid gap-2 d-md-block">
                                            <a href="<?= base_url('user/lihatBuktiTransaksi/' . $row['id_transaksi']); ?>" class="btn btn-info"><i class="bx bx-file me-1"></i> Lihat Bukti</a>
                                        </div>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Belum ada histori pembayaran lunas.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    document.getElementById('checkAll').addEventListener('change', function(e) {
        var checkboxes = document.getElementsByName('tagihan_ids[]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = e.target.checked;
        }
    });
</script>