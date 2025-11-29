<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tagihan /</span> Input Tagihan</h4>
<?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('pesan'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Input Tagihan Satuan</h5>
    </div>
    <div class="card-body">
        <?= form_open('admin/prosesInputTagihan'); ?>
            <div class="mb-3">
                <label class="form-label">ID Pelanggan:</label>
                <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan_input" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan:</label>
                <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan_input" required readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Periode (contoh: Juli 2025):</label>
                <input type="text" class="form-control" name="periode" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah:</label>
                <input type="number" class="form-control" name="jumlah" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Tagihan</button>
        <?= form_close(); ?>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Input Tagihan Massal</h5>
    </div>
    <div class="card-body">
        <?= form_open('admin/prosesInputTagihanMassal'); ?>
            <div class="mb-3">
                <label class="form-label">Periode Massal (contoh: Juli 2025):</label>
                <input type="text" class="form-control" name="periode" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Massal:</label>
                <input type="number" class="form-control" name="jumlah" required>
            </div>
            <button type="submit" class="btn btn-info" onclick="return confirm('Apakah Anda yakin ingin membuat tagihan massal untuk semua user?');">Buat Tagihan Massal</button>
        <?= form_close(); ?>
    </div>
</div>

<script>
    document.getElementById('id_pelanggan_input').addEventListener('blur', function() {
        var idPelanggan = this.value;
        if (idPelanggan.trim() !== '') {
            fetch('<?= base_url('admin/getNamaPelanggan'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_pelanggan=' + idPelanggan
            })
            .then(response => response.json())
            .then(data => {
                if (data.nama) {
                    document.getElementById('nama_pelanggan_input').value = data.nama;
                } else {
                    document.getElementById('nama_pelanggan_input').value = 'ID Pelanggan tidak ditemukan';
                }
            })
            .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('nama_pelanggan_input').value = '';
        }
    });
</script>