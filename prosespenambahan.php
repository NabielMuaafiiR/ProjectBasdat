<?php
include("connectdb.php");

if(isset($_POST['submit'])){
    $kode=$_POST['kode'];
    $nama=$_POST['nama'];
    $stok=$_POST['stok'];
    $deskripsi=$_POST['deskripsi'];
    
    // File upload handling
    $filename = $_FILES['uploadfile']['name'];
    $size = $_FILES['uploadfile']['size'];
    $error = $_FILES['uploadfile']['error'];
    $tempname = $_FILES['uploadfile']['tmp_name'];
    $folder = 'image' . $filename;

    // Insert data into the database
    $query = pg_query("INSERT INTO barang (kode_produk, nama_produk, stok_barang, deskripsi, gambar) VALUES ('$kode', '$nama', '$stok', '$deskripsi', '$filename')") or die(pg_error());
    
    // Move the uploaded file to the specified directory
    $movefile = move_uploaded_file($tempname, $folder);

    if($query == 1 && $movefile == 1){
        header("location: store.php?status=sukses");
    } else {
        header("location: store.php?status=gagal");
    }
}
?>
