<?php
    include("connectdb.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user = $_SESSION['username'];
        $buktitf = $_POST['buktitf'];
        $alamat = $_POST['alamat'];
        $pembayaran = $_POST['pembayaran'];
        
        $ambiluser = pg_query("SELECT * FROM keranjang WHERE username = '$user'" );
        $cek = pg_query($db, "SELECT * FROM checkout;");

        $id = mt_rand(9999, 99999999);
        while ($orderid = pg_fetch_array($cek)) {
            if ($id == $orderid['order_id']) {
                $id = mt_rand(9999, 99999999);
            }
        }
        if (empty($alamat) && empty($pembayaran)) {
            header("location: checkout.php?status=isikedua");
        } elseif (empty($alamat)) {
            header("location: checkout.php?status=isialamat");
        } elseif (empty($pembayaran)) {
            header("location: checkout.php?status=pilihpembayaran");
        } elseif ($pembayaran === 'transfer' && empty($buktitf)) {
            header("location: checkout.php?status=isibuktitransfer");
        } else {
            while($row = pg_fetch_assoc($ambiluser)){
                $kode = $row['kode_produk'];
                $nama = $row['nama_produk'];
                $harga = $row['harga'];
                $jumlah = $row['jumlah'];
                $buktitf = $_POST['buktitf'];
                $alamat = $_POST['alamat'];
                $pembayaran = $_POST['pembayaran'];
                $query = pg_query($db,"INSERT INTO checkout (
                                        order_id, alamat, pembayaran, bukti_transfer, nama_produk,
                                        harga, jumlah, username, kode_produk
                                    ) 
                                    VALUES('$id','$alamat', '$pembayaran','$buktitf',
                                        '$nama', '$harga', '$jumlah', '$user', '$kode' 
                                    );");
            }
            if(pg_affected_rows($query) > 0){
                $delete = pg_query($db, "DELETE FROM keranjang WHERE username='$user';");
                header("location: store.php");
            }
        }

   
    }
        
?>
