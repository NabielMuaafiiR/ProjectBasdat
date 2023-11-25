<?php include("connectdb.php"); 
session_start();?>

<!DOCTYPE html>
<html>

<head>
    <script>
        function toggleUpload() {
            var transferRadio = document.getElementById('transferRadio');
            var codRadio = document.getElementById('CODRadio');
            var uploadField = document.getElementById('uploadField');

            // Display the upload field if Transfer is selected, hide otherwise
            uploadField.style.display = transferRadio.checked ? 'block' : 'none';

            // Hide the upload field if COD is selected
            if (codRadio.checked) {
                uploadField.style.display = 'none';
            }
        }
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <h3>Checkout</h3>
    </header>

    <br>

    <table border="1">
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $username = $_SESSION['username'];
            $query = pg_query($db, "SELECT * FROM keranjang WHERE username = '$username' ORDER BY kode_produk ASC");
            $total = 0;

            // Fetch the first row to check if the result set is empty
            $firstRow = pg_fetch_array($query);

            if(empty($firstRow)){
                header("location: keranjang.php?status=kosong");
            } else {
                // Output the first row
                echo "<tr>";
                echo "<td>" . $firstRow['kode_produk'] . "</td>";
                echo "<td>" . $firstRow['nama_produk'] . "</td>";
                echo "<td>" . $firstRow['harga'] . "</td>";
                echo "<td>" . $firstRow['jumlah'] . "</td>";
                echo "<td>" . ($firstRow['harga'] * $firstRow['jumlah']) . "</td>";
                echo "</tr>";
                $subtotal = $firstRow['harga'] * $firstRow['jumlah'];
                $total += $subtotal;
                // Output the rest of the rows
                while ($produk = pg_fetch_array($query)) {
                    $subtotal = $produk['harga'] * $produk['jumlah'];
                    $total += $subtotal;
                    echo "<tr>";
                    echo "<td>" . $produk['kode_produk'] . "</td>";
                    echo "<td>" . $produk['nama_produk'] . "</td>";
                    echo "<td>" . $produk['harga'] . "</td>";
                    echo "<td>" . $produk['jumlah'] . "</td>";
                    echo "<td>$subtotal</td>";
                    //Menyimpan array
                    echo "<input type='hidden' name='kode_produk' value='" . $produk['kode_produk'] . "'>";
                    echo "<input type='hidden' name='nama_produk' value='" . $produk['nama_produk'] . "'>";
                    echo "<input type='hidden' name='harga' value='" . $produk['harga'] . "'>";
                    echo "<input type='hidden' name='jumlah' value='" . $produk['jumlah'] . "'>";
                    echo "</tr>";
                    echo "</tr>";
                }
            }
        ?>

        </tbody>
    </table>

    <p>TOTAL:Rp.<?php echo "$total"; ?></p>
    
    <form method='POST' action="fungsicheckout.php" enctype="multipart/form-data">
    <p>
        <label for="Alamat">Alamat Lengkap </label><br>
        <textarea name="alamat"></textarea>
    </p>
    <p>
        <label for="pembayaran">Metode Pembayaran </label><br>
        <label><input type="radio" name="pembayaran" id="CODRadio" value="COD" onclick="toggleUpload()"> COD</label>
        <label><input type="radio" name="pembayaran" id="transferRadio" value="transfer" onclick="toggleUpload()"> Transfer</label>
    </p>
    
    <!-- Add an upload image field with an initial style of 'display: none' -->
    <div id="uploadField" style="display: none;">
        <p>
            <label for="uploadImage">Upload Image </label><br>
            <input type="file" name="buktitf">
        </p>
    </div>
    
    <input type="submit" value="buat pesanan" name="buat_pesanan" />
    </form>
    
    <p>
    <?php if(isset($_GET['status'])): ?>
		<?php
            if($_GET['status'] == 'isikedua'){
                echo "Isi Alamat dan Pilih Metode Pembayaran";
            }
            else if($_GET['status'] == 'isialamat'){
                echo "Isi Alamat";
            }
            else if($_GET['status'] == 'pilihpembayaran'){
                echo "Pilih Pembayaran";
            }
			else if($_GET['status'] == 'isibuktitransfer'){
                echo "Isi Bukti Transfer";
            }
        ?>
	</p>
    <?php endif; ?>
</body>

</html>
