<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>This Is Homepage</h1>
    <?php 
        if(isset($_SESSION['username'])){
            echo $_SESSION['username']; 
            echo'<br>';
            echo "<a href='proseslogout.php'>LOG OUT</a>";
            echo"<br>";
            echo "<a href='store.php'>store</a>";
        }
        elseif(isset($_SESSION['admin'])){
            echo $_SESSION['admin']; 
            echo'<br>';
            echo "<a href='proseslogout.php'>LOG OUT</a>";
            echo"<br>";
            echo "<a href='store.php'>store</a>";
        }
        else{
            echo "<a href='login.php'>login</a> <br>";
            echo "<a href='register.php'>register</a> <br>";
            echo "<a href='store.php'>store</a>";
        }
    ?>
</body>
</html>