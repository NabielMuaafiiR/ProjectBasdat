<?php
    include("connectdb.php");
    session_start();
    
    
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
        $user = $_SESSION['username'];
        $nama = $_POST['nama'];
        $kode = $_POST['kode_produk'];
        $harga = $_POST['harga'];
        $gambar = $_POST['gambar'];
        $cek = pg_query($db, "SELECT * FROM keranjang WHERE username='$user' AND kode_produk='$kode';") or die();

        if(isset($_SESSION['admin'])){
            header("location: http://localhost/projectbasdat/store.php");
        }
		if(!isset($_SESSION['username'])){
			header("location: http://localhost/projectbasdat/login.php");
		}
        if(pg_num_rows($cek) > 0){
            header("location: keranjang.php");
        }
		else{
                // buat query
                $query = pg_query("INSERT INTO keranjang (username, kode_produk, nama_produk, harga, jumlah, gambar) VALUES ('$user','$kode','$nama','$harga', 1,'$gambar');") or die();
            
                // apakah query simpan berhasil?
                if( $query==TRUE ) {
                    header("location: keranjang.php");
                } else {
                    echo 'gagal menambahkan';
                }
            
		}
	}
?>