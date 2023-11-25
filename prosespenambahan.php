<?php
include("connectdb.php");

if(isset($_POST['submit'])){
    $kode=$_POST['kode'];
    $nama=$_POST['nama'];
    $stok=$_POST['stok'];
    $deskripsi=$_POST['deskripsi'];
    $harga=$_POST['harga'];
    // File upload handling
    $tempname = $_FILES['gambar']['tmp_name'];
    $filename = $_FILES['gambar']['name'];
   

    // Move the uploaded file to the specified directory
    move_uploaded_file($tempname, 'image/' . $filename);
    // Insert data into the database
    $query = pg_query("INSERT INTO barang (kode_produk, nama_produk, stok_barang, deskripsi, gambar, harga) VALUES ('$kode', '$nama', '$stok', '$deskripsi', '$filename', '$harga')") or die(pg_error());
    

    if($query == 1 && $movefile == 1){
        header("location: store.php?status=sukses");
    } else {
        header("location: store.php?status=gagal");
    }
}
?>

