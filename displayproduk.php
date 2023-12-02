<?php
include("connectdb.php");
include("navbar.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deskripsi</title>
    <link rel="stylesheet" href="css/deskripsi.css">
    <link href="https://fonts.googleapis.com/css?family=Arial&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
</head>
<body>
	<form method="POST" action="tambahkeranjang.php" enctype="multipart/form-data">
		<?php
		$id = $_GET['data'];

		$query = pg_query($db, "SELECT * FROM barang where kode_produk = '$id'");
		$row = pg_fetch_array($query);
		?>
		<main>
        <section class="gambarbarang">
    		<div><img src="./image/<?php echo $row['gambar']; ?>" alt="Product Image" style="width: 100%; max-width: 700px;"></div>
		</section>
        <hr>
        <!-- menampilkan produk -->
        <section class="namabarang">
            <p>Nama Produk : <?php echo $row['nama_produk']; ?> <br></p>
            <p>Harga       : Rp.<?php echo $row['harga']; ?> <br></p>
            <p>Stok        : <?php echo $row['stok_barang']; ?> <br></p>
        </section>
        <hr>
        <section class="namabarang">
            <p>Deskripsi Barang</p>
            <p id="deskripsi">
                <?php echo $row['deskripsi']; ?>
            </p>
        </section>
    </main>
    <footer>
    	<input type="submit" value="add to cart" name="keranjang" style="display: flex; justify-content: center; align-items: center; color: #FFF; text-align: center; font-family: Arial; font-size: 2.38513rem; font-style: normal; font-weight: 400; line-height: normal; width: 15.05156rem; height: 3.44231rem; border-radius: 4.21344rem; background: #7852FF; transform: translateX(-5rem);" />
	</footer>



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
