<!DOCTYPE html>
<html>
<head>
    <title>Upload Bukti Transfer</title>
</head>
<body>
    <h2>Upload Bukti Transfer untuk Tagihan <?= $tagihan['periode']; ?></h2>
    <p>Nama: <strong><?= $tagihan['nama_pelanggan']; ?></strong></p>
    <p>Jumlah: <strong>Rp <?= number_format($tagihan['jumlah'], 0, ',', '.'); ?></strong></p>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color:red;"><?= $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <?= form_open_multipart('user/prosesUploadBukti'); ?>
        <input type="hidden" name="id_tagihan" value="<?= $tagihan['id_tagihan']; ?>">
        <label for="bukti_transfer">Pilih File Bukti Transfer (JPG, PNG, GIF, maks 2MB):</label><br>
        <input type="file" name="bukti_transfer" required><br><br>
        <button type="submit">Upload dan Kirim</button>
    <?= form_close(); ?>
    <br>
    <a href="<?= base_url('user'); ?>">Kembali</a>
</body>
</html>