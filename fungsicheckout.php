<?php
    include("connectdb.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user = $_SESSION['username'];
        $alamat = $_POST['alamat'];
        $pembayaran = $_POST['pembayaran'];

        // Check if a file is uploaded successfully
        if ($_FILES['buktitf']['error'] === UPLOAD_ERR_OK) {
            $buktitf = $_FILES['buktitf']['name'];

            // Move the uploaded file to the specified directory
            move_uploaded_file($_FILES['buktitf']['tmp_name'], 'buktitransfer/' . $buktitf);
        } else {
            // Handle the case when no file is uploaded
            $buktitf = null;
        }

        $ambiluser = pg_query("SELECT * FROM keranjang WHERE username = '$user'" );
        $cek = pg_query($db, "SELECT * FROM checkout;");

        $tanggal_pembelian = date("Y-m-d H:i:s");

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
                $query = pg_query($db,"INSERT INTO checkout (
                                        order_id, alamat, pembayaran, bukti_transfer, nama_produk,
                                        harga, jumlah, username, kode_produk, tanggal_pembelian 
                                    ) 
                                    VALUES('$id','$alamat', '$pembayaran','$buktitf',
                                        '$nama', '$harga', '$jumlah', '$user', '$kode', '$tanggal_pembelian' 
                                    );");
                $stok = pg_query($db, "UPDATE barang SET stok_barang = stok_barang - '$jumlah' WHERE kode_produk = $kode");
            }
            if(pg_affected_rows($query) > 0){
                $delete = pg_query($db, "DELETE FROM keranjang WHERE username='$user';");
                header("location: store.php");
            }
        }
    }
?>
