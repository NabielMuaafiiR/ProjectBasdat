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
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Home</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="keranjang.php">Cart</a></li>
      <li><a href="store.php">Store</a></li>
      <li>
        <?php
        if(isset($_SESSION['username'])){
            echo "<a href='proseslogout.php'>LOG OUT</a>";
        }
        elseif(isset($_SESSION['admin'])){
            echo "<a href='proseslogout.php'>LOG OUT</a>";
        }
        else{
            echo "<a href='login.php'>login</a> <br>";
        }
    ?>
      </li>
      <li>
      <?php
      if(isset($_SESSION['username'])){
            echo $_SESSION['username'];
        }
        elseif(isset($_SESSION['admin'])){
            echo $_SESSION['admin'];
        }
    ?>
      </li>
    </ul>
  </div>
</nav>


</body>
</html>