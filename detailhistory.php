<?php include("connectdb.php"); 
session_start();?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function toggleImage() {
            var image = document.getElementById('buktiImage');
            image.style.display = (image.style.display === 'none' || image.style.display === '') ? 'block' : 'none';
        }
    </script>
</head>

<body>
    <header>
        <h3>History</h3>
    </header> 
        <?php 
            $id = $_GET['data'];
            echo "Order ID: $id";
        ?>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Pembayaran</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $id = $_GET['data'];
            $query = pg_query($db, "SELECT * FROM checkout WHERE order_id = '$id'");
            $total = 0;
            while ($produk = pg_fetch_array($query)) {
                $subtotal = $produk['harga'] * $produk['jumlah'];
                $total += $subtotal;
                echo "<tr>";
                echo "<td>" . $produk['kode_produk'] . "</td>";
                echo "<td>" . $produk['nama_produk'] . "</td>";
                echo "<td>" . $produk['harga'] . "</td>";
                echo "<td>" . $produk['jumlah'] . "</td>";
                echo "<td>$subtotal</td>";
                echo "<td>" . $produk['pembayaran'] . "</td>";
                echo "<td>" . $produk['alamat'] . "</td>";
            }
        ?>
        </tbody>
    </table>
    <p>TOTAL:Rp.<?php echo "$total"; ?></p>

    <?php 
    // Fetch the bukti_transfer filename
    $buktitf = pg_query($db, "SELECT bukti_transfer FROM checkout WHERE order_id='$id'");
    $bukti = pg_fetch_assoc($buktitf);

    // Check if bukti_transfer exists before trying to display it
    if ($bukti && isset($bukti['bukti_transfer'])) {
        echo '<button onclick="toggleImage()">Bukti Transfer</button>';
        echo '<img id="buktiImage" src="./buktitransfer/' . $bukti['bukti_transfer'] . '" alt="Bukti Transfer" style="width:200px;height:400px;display:block;">';
    }
    ?>
</body>

</html>
