<?php
include("connectdb.php");

if(isset($_POST["searchbutton"])){
    $search = $_POST["search"];
    $query = pg_query("SELECT * FROM barang WHERE nama_produk='$search';") or die(pg_error());
}
?>