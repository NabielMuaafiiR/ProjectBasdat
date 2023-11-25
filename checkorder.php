<?php
    include("connectdb.php");
    session_start();

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Update the cookie with the selected values
        setcookie('selectedValues', json_encode($_POST['check']), time() + 3600); // Cookie expires in 1 hour
    }

    // Check if the cookie exists and decode it
    $selectedValues = isset($_COOKIE['selectedValues']) ? json_decode($_COOKIE['selectedValues'], true) : [];
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

    <form method="POST" action="">
        <table border="1">
            <thead>
                <tr>
                    <th>Order_ID</th>
                    <th>Pembeli</th>
                    <th>Tanggal Pembelian</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = pg_query($db, "SELECT DISTINCT username, order_id, tanggal_pembelian FROM checkout ORDER BY tanggal_pembelian");
                $total = 0;

                while ($produk = pg_fetch_array($query)) {
                    // Check if a value is already stored in the cookie for this order_id
                    $selectedValue = isset($selectedValues[$produk['order_id']]) ? $selectedValues[$produk['order_id']] : '';

                    echo "<tr>";
                    echo '<td> <a href="detailhistory.php?data=' . $produk['order_id'] . '">' . $produk['order_id'] . ' </a></td><br>';
                    echo "<td>" . $produk['username'] . "</td>";
                    echo "<td>" . $produk['tanggal_pembelian'] . "</td>";

                    echo '<td>
                        <label><input type="radio" name="check[' . $produk['order_id'] . ']" value="sudah" onclick="toggleUpload()" ' . ($selectedValue == 'sudah' ? 'checked' : '') . '> Sudah</label>
                        <label><input type="radio" name="check[' . $produk['order_id'] . ']" value="belum" onclick="toggleUpload()" ' . ($selectedValue == 'belum' ? 'checked' : '') . '> Belum</label>
                        </td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <input type="submit" value="Submit">
    </form>

    <script>
        function toggleUpload() {
            // Your JavaScript logic here
        }
    </script>
</body>

</html>
