
<?php
include("connectdb.php");
session_start();

if(isset($_POST['tambah'])){
    $id = $_POST['kode_produk'];
    $jumlah = $_POST['jumlah'] + 1;
    $user = $_SESSION['username'];

    $query = pg_query($db, "UPDATE keranjang SET jumlah = $jumlah WHERE username='$user' AND kode_produk = $id") or die();

    if (pg_num_rows($query)>0) {
        header('Location: http://localhost/projectbasdat/keranjang.php');
        exit;
    } else {
        header('Location: http://localhost/projectbasdat/keranjang.php');
        exit;
    }
}
else if(isset($_POST['kurang'])){
    $id = $_POST['kode_produk'];
    $jumlah = $_POST['jumlah'] - 1;
    $user = $_SESSION['username'];

    if($jumlah == 0){
        $jumlah = 1;
    }
    $query = pg_query($db, "UPDATE keranjang SET jumlah = $jumlah WHERE username='$user' AND kode_produk = $id") or die();

    if (pg_num_rows($query)>0) {
        header('Location: http://localhost/projectbasdat/keranjang.php');
        exit;
    } else {
        header('Location: http://localhost/projectbasdat/keranjang.php');
        exit;
    }
}
?>
