<?php 
session_start();
include("connectdb.php"); 
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		.product-container {
			display: inline-block;
			margin: 10px;
			text-align: center;
		}
	</style>

	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="css/store.css">
    <link href="https://fonts.googleapis.com/css?family=Arial&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
</head>
<body>
	<form action="store.php" method="post">
		<div class="search">
			<input type="text" name="search" placeholder="search">
			<input type="submit" value="search" name="searchbutton"/>
		</div>
	</form>
    <?php
	//SPECIAL UNTUK ADMIN
    if(isset($_SESSION['admin'])){
        echo"<br>";
        echo "<a href='tambah.php'>Edit</a><br>";
		echo "<a href='checkorder.php'>Order</a>";
		echo "<br>";
    }
    ?>

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
					echo'<main>    
						<ul>
							<li>
								<p class="listname">'.$row['nama_produk'].'</p>
								<a href="displayproduk.php?data='.$row['kode_produk'].'"><img src="./image/' . $row['gambar'] . '" alt="Product Image"></a>
								<p class="listharga">'.$row['harga'].'</p>';
								if(isset($_SESSION['admin'])){
									echo"<br>";
									echo '<a href="editbarang.php?data='.$row['kode_produk'].'">Edit</a><br>';
								}
					echo'		</li>
						</ul>
					</main>';
				}
			}
			//KETIKA TIDAK ADA DI DATABASE
			else if(pg_num_rows($query)==0){
				echo "Pencarian Tidak Ada";

			//MUNCULKAN SEARCH
			}else{
				while($row = pg_fetch_array($query)){
					echo'<main>    
						<ul>
							<li>
								<p class="listname">'.$row['nama_produk'].'</p>
								<a href="displayproduk.php?data='.$row['kode_produk'].'"><img src="./image/' . $row['gambar'] . '" alt="Product Image"></a>
								<p class="listharga">'.$row['harga'].'</p>';
								if(isset($_SESSION['admin'])){
									echo"<br>";
									echo '<a href="editbarang.php?data='.$row['kode_produk'].'">Edit</a><br>';
								}
					echo'		</li>
						</ul>
					</main>';
				}
			}
		}

		//KETIKA BARU BUKA STORE
		else{
			echo'<p class="maintop">Table Flowers</p>';
			$query = pg_query($db, "SELECT * FROM barang");
			while($row = pg_fetch_array($query)){
			echo'<main>    
				<ul>
					<li>
						<p class="listname">'.$row['nama_produk'].'</p>
						<a href="displayproduk.php?data='.$row['kode_produk'].'"><img src="./image/' . $row['gambar'] . '" alt="Product Image"></a>
						<p class="listharga">'.$row['harga'].'</p>';
						if(isset($_SESSION['admin'])){
							echo"<br>";
							echo '<a href="editbarang.php?data='.$row['kode_produk'].'">Edit</a><br>';
						}
			echo'		</li>
				</ul>
			</main>';
		}
		}
		
		


		?>

	</tbody>
	</table>
		
</body>
</html>