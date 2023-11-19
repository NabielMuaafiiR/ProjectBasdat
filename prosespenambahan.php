<?php
include("connectdb.php");

if(isset($_POST['submit'])){

    $kode=$_POST['kode'];
    $nama=$_POST['nama'];
    $stok=$_POST['stok'];
    $deskripsi=$_POST['deskripsi'];

    $query = pg_query("INSERT INTO barang (kode_produk, nama_produk, stok_barang, deskripsi) VALUES ('$kode', '$nama', '$stok', '$deskripsi')") or die(pg_error());

    if($query == 1){
        header("location: store.php?status=sukses");
    }
    else{
        header("location: store.php?status=gagal");
    }
}
?>