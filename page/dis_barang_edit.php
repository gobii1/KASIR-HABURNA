<?php
include 'authcheck.php';

$error_message = '';

$view = $dbconnect->query("SELECT * FROM barang");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menampilkan data berdasarkan ID
    $data = mysqli_query($dbconnect, "SELECT * FROM disbarang WHERE id='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];

    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];
    $potongan = $_POST['potongan'];

    // Validasi input
    if (empty($barang_id) || empty($qty) || empty($potongan)) {
        $error_message = 'Silahkan Isi Kolom dengan Benar';
    } elseif (!is_numeric($qty) || !is_numeric($potongan)) {
        $error_message = 'Qty dan Potongan harus berupa angka!';
    } else {
        // Pastikan qty adalah integer dan potongan adalah float
        $qty = intval($qty);  // qty harus angka integer
        $potongan = floatval($potongan);  // potongan harus angka desimal

        // Menyimpan ke database
        $query = "UPDATE disbarang SET barang_id='$barang_id', qty='$qty', potongan='$potongan' WHERE id='$id'";
        if ($dbconnect->query($query)) {
            $_SESSION['success'] = 'Berhasil memperbarui data';
            // Mengalihkan halaman ke list diskon barang
            header('location: index.php?page=dis_barang');
            exit;
        } else {
            $error_message = 'Terjadi kesalahan saat memperbarui data.';
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

<form method="post" onsubmit="return validateForm()">
    <div class="form-group">
        <label>Barang Yang Di Diskon</label>
        <select name="barang_id" class="form-control">
            <?php while ($row = $view->fetch_array()): ?>
                <option value="<?= $row['id_barang'] ?>" <?= $data['barang_id'] == $row['id_barang'] ? 'selected' : '' ?>>
                    <?= $row['nama'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Qty (Jumlah)</label>
        <input type="text" name="qty" class="form-control" placeholder="Batas Nominal" value="<?= $data['qty'] ?>" onkeypress="validateNumber(event)">
    </div>
    <div class="form-group">
        <label>Potongan</label>
        <input type="text" name="potongan" class="form-control" placeholder="Jumlah Potongan" value="<?= $data['potongan'] ?>" onkeypress="validateNumber(event)">
    </div>
    <input type="submit" name="update" value="Update" class="btn btn-primary">
    <a href="?page=dis_barang" class="btn btn-warning">Kembali</a>
</form>
