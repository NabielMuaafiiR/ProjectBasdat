<?php 
session_start();
include("connectdb.php"); 
include("navbar.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/keranjang.css">
</head>

<body>
    <br>
    <a href="history.php">history</a>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $username = $_SESSION['username'];
            $query = pg_query("SELECT * FROM keranjang WHERE username = '$username' ORDER BY kode_produk ASC");
            $total = 0; // Inisialisasi total
            if(!isset($_SESSION['username'])){
                header("location: http://localhost/projectbasdat/login.php");
            }
            if(isset($_SESSION['admin'])){
                header("location: http://localhost/projectbasdat/index.php");
            }
            else{
            while($produk = pg_fetch_array($query)){
                
                echo "<tr>";  

                echo "<form method='POST' action='updatejumlah.php'>";
                echo "<td>".$produk['kode_produk']."</td>";
                echo '<td><img src="./image/' . $produk['gambar'] . '" alt="Product Image"" class = "gambar"></td>';
                echo "<td data-jumlah='".$produk['nama_produk']."'>".$produk['nama_produk']."</td>";
                echo "<td data-harga='".$produk['harga']."'>".$produk['harga']."</td>";
                echo "<td data-jumlah='".$produk['jumlah']."'>".$produk['jumlah']."</td>";
                echo "<input type='hidden' id='jumlah' name='jumlah' min='1' value='" . $produk['jumlah'] . "'>";
                echo "<input type='hidden' name='nama' value='" . $produk['nama_produk'] . "'>";
                echo "<input type='hidden' name='id' value='" . $produk['username'] . "'>";
                echo "<input type='hidden' name='kode_produk' value='" . $produk['kode_produk'] . "'>";
                
                // Hitung subtotal dan tambahkan ke total
                $subtotal = $produk['harga'] * $produk['jumlah'];
                $total += $subtotal;
                
                echo "<td>" .$subtotal."</td>";
                
                echo "<td>";
                echo '<input type="submit" value="+" name="tambah"/>';
                echo '<input type="submit" value="-" name="kurang"/>';
                echo "<a href='hapus.php?id=".$produk['kode_produk']."'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
                echo "</form>";
            }
            }
            ?>
            
        </tbody>
    </table>
    <p>TOTAL: Rp.<?php echo "$total"; ?></p>

    <form method='POST' action="checkout.php">
        <input type="submit" value="checkout" name="checkout"/>
    </form>
    <?php if(isset($_GET['status'])): ?>
        <p>
		<?php
            if($_GET['status'] == 'kosong'){
                echo "Anda belum memesan";
            }
        ?>
        </p>
    <?php endif; ?>
</body>
</html>
