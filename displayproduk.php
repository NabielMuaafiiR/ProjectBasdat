<?php
include("connectdb.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form method="POST" action="tambahkeranjang.php" enctype="multipart/form-data">
		<?php
		$id = $_GET['data'];

		$query = pg_query($db, "SELECT * FROM barang where kode_produk = '$id'");
		$row = pg_fetch_array($query);
		?>
		<p>
		<img src="./image/<?php echo $row['gambar']; ?>" alt="Product Image"> <br>
			Nama Produk : <?php echo $row['nama_produk']; ?> <br>
			Stok 		: <?php echo $row['stok_barang']; ?> <br>
			Harga 		: <?php echo $row['harga']; ?> <br>
			Deskkripsi	: <br> <?php echo $row['deskripsi']; ?>
		</p>
		<input type="submit" value="add to cart" name="keranjang"/>


		<!-- untuk array -->
		<input type="hidden" name="gambar" value= "<?php echo $row['gambar']; ?>" /> 
		<input type="hidden" name="nama" value="<?php echo $row['nama_produk']; ?>" /><br>
		<input type="hidden" name="kode_produk" value="<?php echo $row['kode_produk']; ?>" /><br>
		<input type="hidden" name="stok" value="<?php echo $row['stok_barang']; ?>" /><br>
		<input type="hidden" name="harga" value="<?php echo $row['harga']; ?>" /><br>
		<input type="hidden" name="deskripsi" value="<?php echo $row['deskripsi']; ?>" /><br>

	</form>
</body>
</html>
