<?php

include 'authcheck.php';

$view = $dbconnect->query('SELECT * FROM barang');

if (isset($_POST['simpan'])) {
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];
    $potongan = $_POST['potongan'];

    // Validasi input
    if (empty($barang_id) || empty($qty) || empty($potongan)) {
        $_SESSION['error'] = 'Silahkan Isi Kolom dengan Benar';
    } elseif (!is_numeric($qty) || !is_numeric($potongan)) {
        $_SESSION['error'] = 'Qty dan Potongan harus berupa angka!';
    } else {
        // Pastikan qty adalah integer dan potongan adalah float
        $qty = intval($qty);  // qty harus angka integer
        $potongan = floatval($potongan);  // potongan harus angka desimal

        // Menyimpan ke database
        $query = "INSERT INTO disbarang (barang_id, qty, potongan) VALUES ('$barang_id', '$qty', '$potongan')";
        if (mysqli_query($dbconnect, $query)) {
            $_SESSION['success'] = 'Berhasil menambahkan data';
            // Mengalihkan halaman ke list diskon barang
            header('location: index.php?page=dis_barang');
            exit;
        } else {
            $_SESSION['error'] = 'Terjadi kesalahan saat menambahkan data.';
        }
    }
}

?>

<script>
    // Fungsi untuk memvalidasi apakah input hanya angka
    function validateNumber(event) {
        var keyCode = event.keyCode || event.which;
        var key = String.fromCharCode(keyCode);
        var regex = /^[0-9]+$/;

        if (!regex.test(key)) {
            event.preventDefault(); // Cegah input yang bukan angka
        }
    }

    // Fungsi untuk validasi form sebelum submit
    function validateForm() {
        var qty = document.getElementsByName('qty')[0].value;
        var potongan = document.getElementsByName('potongan')[0].value;

        // Cek jika kolom qty atau potongan kosong
        if (qty == '' || potongan == '') {
            alert('Silahkan Isi Kolom dengan Benar');
            return false;
        }

        // Cek jika qty dan potongan bukan angka
        if (isNaN(qty) || isNaN(potongan)) {
            alert('Qty dan Potongan harus berupa angka!');
            return false;
        }

        return true;
    }
</script>

<div class="container">
    <h1>Tambah Diskon Barang</h1>
    <form method="post" onsubmit="return validateForm()">
        <div class="form-group">
            <label>Barang Yang Di Diskon</label>
            <select name="barang_id" class="form-control">
                <?php while ($row = $view->fetch_array()): ?>
                    <option value="<?=$row['id_barang']?>"><?=$row['nama']?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Qty (Jumlah)</label>
            <input type="text" name="qty" class="form-control" placeholder="Batas Nominal" onkeypress="validateNumber(event)">
        </div>
        <div class="form-group">
            <label>Potongan</label>
            <input type="text" name="potongan" class="form-control" placeholder="Jumlah Potongan" onkeypress="validateNumber(event)">
        </div>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
        <a href="?page=dis_barang" class="btn btn-warning">Kembali</a>
    </form>
</div>
