<?php
include("connectdb.php");
session_start();

if(isset($_POST['update'])){
    $nama=$_POST['nama'];
    $stok=$_POST['stok'];
    $deskripsi=$_POST['deskripsi'];
    $harga=$_POST['harga'];

    // Update data in the database
    $query = pg_query($db, "UPDATE barang SET  
                                nama_produk = '$nama', 
                                stok_barang = '$stok', 
                                deskripsi = '$deskripsi', 
                                harga = '$harga' 
                                ") or die();

    if($query){
        header("location: store.php?status=sukses");
    } else {
        header("location: store.php?status=gagal");
    }
}
?>
