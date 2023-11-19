<?php
include("connectdb.php");

$id = $_GET['data'];

$query = pg_query($db, "SELECT * FROM barang where kode_produk = '$id'");
			while($row = pg_fetch_array($query)){

				echo '<img src="./image/' . $row['gambar'] . '" alt="Product Image"> <br>';
				echo "Kode Produk:".$row['kode_produk']."<br>";
				echo "Nama Produk:".$row['nama_produk']."<br>";
				echo "Stok:".$row['stok_barang']."<br>";
				echo "Deskripsi: <br>".$row['deskripsi'];
				
            }




?>