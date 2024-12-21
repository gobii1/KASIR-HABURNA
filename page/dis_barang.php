
<?php
include 'authcheck.php';
$view = $dbconnect->query('SELECT disbarang.*, barang.nama as barang FROM disbarang inner join barang ON disbarang.barang_id=barang.id_barang');

?>
<div class="container">

<?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') {?>

	<div class="alert alert-success" role="alert">
		<?=$_SESSION['success']?>
	</div>

<?php
	}
	$_SESSION['success'] = '';
?>

<h1>List Diskon Barang</h1>
<a href="index.php?page=dis_barang_add" class="btn btn-primary">Tambah data</a>
<hr>

<table class="table table-bordered">
	<tr>
		<th>No</th> <!-- Ganti ID dengan No -->
		<th>Barang</th>
		<th>Qty</th>
		<th>Potongan</th>
		<th>Aksi</th>
	</tr>
	<?php
	// Inisialisasi nomor urut
	$no = 1;
	while ($row = $view->fetch_array()) { ?>

	<tr>
		<td> <?= $no++ ?> </td> <!-- Menampilkan nomor urut secara dinamis -->
		<td><?= $row['barang'] ?></td>
		<td><?= $row['qty'] ?></td>
		<td><?= $row['potongan'] ?></td>
		<td>
			<a href="index.php?page=dis_barang_edit&id=<?= $row['id'] ?>">Edit</a> |
			<a href="page/dis_barang_hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
		</td>
	</tr>

	<?php }
	?>

</table>
</div>
