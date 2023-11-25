<?php 
session_start();
include("connectdb.php"); 
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<form action="store.php" method="post">
		<input type="text" name="search" placeholder="search">
        <input type="submit" value="search" name="searchbutton"/>
	</form>
    <?php
	//SPECIAL UNTUK ADMIN
    if(isset($_SESSION['admin'])){
        echo"<br>";
        echo "<a href='tambah.php'>Edit</a>";
		echo "<br>";
    }
    ?>
<table border="1">
	<thead>
		<tr>
			
		</tr>
	</thead>
	<tbody>

		<?php
		//SEARCH FUNCTION
		if(isset($_POST["searchbutton"])){ 
			$search = $_POST['search'];
			$u_search = strtolower($search);
			$u_search = ucwords($u_search);
			$l_search = ucfirst($search);


			$search = preg_replace("#[^0-9a-z]#i","",$search);
			$query = pg_query("SELECT * FROM barang WHERE nama_produk LIKE '%$search%'
								 OR deskripsi LIKE '%$search%' OR nama_produk LIKE '%$u_search%'
								 OR nama_produk LIKE '%$l_search%';") 
								 
					or die("pencarian tidak ada");

			//KETIKA TIDAK SEARCH APA APA
			if(empty($search)){
				$query = pg_query($db, "SELECT * FROM barang");
				
				while($row = pg_fetch_array($query)){
					echo "<tr>";
					
					echo '<td><img src="./image/' . $row['gambar'] . '" alt="Product Image" style="width:70px;height:70px;"</td>';
					echo '<td> <a href="displayproduk.php?data='.$row['kode_produk'].'">'.$row['nama_produk'].' </a></td><br>';
					echo "<td>".$row['harga']."</td><br>";

					echo "</tr>";
				}
			}
			//KETIKA TIDAK ADA DI DATABASE
			else if(pg_num_rows($query)==0){
				echo "Pencarian Tidak Ada";

			//MUNCULKAN SEARCH
			}else{
				while($row = pg_fetch_assoc($query)){
					
					echo "<tr>";

					echo '<td><img src="./image/' . $row['gambar'] . '" alt="Product Image" style="width:70px;height:70px;"</td>';
					echo '<td> <a href="displayproduk.php?data='.$row['kode_produk'].'">'.$row['nama_produk'].' </a></td><br>';
					echo "<td>".$row['harga']."</td><br>";

					echo "</tr>";
				}
			}
		}

		//KETIKA BARU BUKA STORE
		else{
			$query = pg_query($db, "SELECT * FROM barang");
			while($row = pg_fetch_array($query)){
				echo "<tr>";

				echo '<td><img src="./image/' . $row['gambar'] . '" alt="Product Image" style="width:70px;height:70px;"</td>';
				echo '<td> <a href="displayproduk.php?data='.$row['kode_produk'].'">'.$row['nama_produk'].' </a></td><br>';
				echo "<td>".$row['harga']."</td><br>";

				echo "</tr>";
		}
		}
		
		


		?>

	</tbody>
	</table>
		
</body>
</html>