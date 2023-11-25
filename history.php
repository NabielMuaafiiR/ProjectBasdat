<?php
    include("connectdb.php");
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <h3>History</h3>
    </header>

    <br>

    <table border="1">
        <thead>
            <tr>
                <th>Order_ID</th>
                <th>Tanggal Pembelian</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $username = $_SESSION['username'];
            $query = pg_query($db, "SELECT DISTINCT order_id, tanggal_pembelian FROM checkout WHERE username = '$username' ORDER BY tanggal_pembelian");
            $total = 0;

            while ($produk = pg_fetch_array($query)) {
                echo "<tr>";
                echo '<td> <a href="detailhistory.php?data=' . $produk['order_id'] . '">' . $produk['order_id'] . ' </a></td><br>';
                echo "<td>" . $produk['tanggal_pembelian'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
