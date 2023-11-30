<?php
  include("connectdb.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="./css/navbar.css" rel="stylesheet" />
</head>
<body>
<header>
<div class="headtop">
            <?php
                if(isset($_SESSION['username'])){
                      echo "<a>" . $_SESSION['username'] . "</a>";
                    }
                    elseif(isset($_SESSION['admin'])){
                        echo $_SESSION['admin'];
                    }
            ?>
            <?php
                if(isset($_SESSION['username'])){
                    echo '<a href="proseslogout.php"><img src="images/keluar.png"></a>';
                }
                elseif(isset($_SESSION['admin'])){
                    echo '<a href="proseslogout.php"><img src="images/keluar.png"></a>';
                }
                else{
                    echo "<a href='login.php'>login</a> <br>";
                }
            ?>
        </div>    
        <div class="headunder">
            <div class="logo"><img src="images/logo.png"></div>
            <ul class="headlist">
                <li><a href="index.php">Home</a></li>
                <li><a href="store.php">Store</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
            </ul>
        </div>
</header>

</body>
</html>