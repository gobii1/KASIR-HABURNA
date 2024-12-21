<?php
ob_start(); // Start output buffering
include 'authcheck.php';

$error_message = '';

if (isset($_POST['simpan'])) {
    $nama = trim($_POST['nama']);
    $kode_barang = trim($_POST['kode_barang']);
    $harga = trim($_POST['harga']);
    $jumlah = trim($_POST['jumlah']);

    // Validasi apakah semua kolom telah diisi
    if (empty($nama) || empty($kode_barang) || empty($harga) || empty($jumlah)) {
        $error_message = 'Silahkan Isi Kolom dengan Benar';
    } else {
        // Menyimpan ke database
        mysqli_query($dbconnect, "INSERT INTO barang VALUES (NULL, '$nama', '$harga', '$jumlah', '$kode_barang')");

        $_SESSION['success'] = 'Berhasil menambahkan data';

        // Mengalihkan halaman ke list barang
        header('location: index.php?page=barang');
        exit;
    }
}
?>
<div class="container">
    <h1>Tambah Barang</h1>

    <?php if ($error_message): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error_message; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama barang" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
        </div>
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control" placeholder="Kode barang" value="<?= isset($_POST['kode_barang']) ? htmlspecialchars($_POST['kode_barang']) : '' ?>">
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" placeholder="Harga Barang" value="<?= isset($_POST['harga']) ? htmlspecialchars($_POST['harga']) : '' ?>">
        </div>
        <div class="form-group">
            <label>Jumlah Stock</label>
            <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Stock" value="<?= isset($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : '' ?>">
        </div>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
        <a href="?page=barang" class="btn btn-warning">Kembali</a>
    </form>
</div>
<?php ob_end_flush(); // End output buffering ?>
