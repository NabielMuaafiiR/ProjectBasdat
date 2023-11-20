<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="prosespenambahan.php" method="post" enctype="multipart/form-data">
		<fieldset>
		<p>
			<label for="kode">Kode Barang: </label>
			<input type="text" name="kode" placeholder="kode barang 6 digit" />
		</p>
		<p>
			<label for="nama">Nama Barang: </label>
			<textarea name="nama"></textarea>
		</p>
		<p>
			<label for="stok">Stok Barang: </label>
			<textarea name="stok"></textarea>
		</p>
        <p>
			<label for="deskripsi">Deskripsi Barang: </label>
			<textarea name="deskripsi"></textarea>
		</p>
		<p>
			<input type="file" name="gambar" value="">
		</p>
		<p>
			<input type="submit" value="submit" name="submit" />
		</p>
		</fieldset>
	</form>
</body>
</html>