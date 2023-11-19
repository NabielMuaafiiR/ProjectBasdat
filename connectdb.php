<?php
$db=pg_connect('host=localhost dbname=projectbasdat user=postgres password=nabiel123');
if( !$db ){
    die("Gagal terhubung dengan database: " . pg_connect_error());
}
?>
