<?php
include("connectdb.php");
if( isset($_GET['id']) ){

    //ambil id dari query string
    $id = $_GET['id'];

    //buat query hapus
    $query = pg_query("DELETE FROM keranjang WHERE kode_produk=$id");

    //apakah query hapus berhasil?
    if( $query ){
        header('Location: keranjang.php');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}
?>