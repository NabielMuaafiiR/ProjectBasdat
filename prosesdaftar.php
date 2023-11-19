<?php
include("connectdb.php");
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $checkusername = pg_query("SELECT username FROM pembeli WHERE username = '$username';") or die(pg_error());
    if(empty($username) && empty($password)){
        header("location: register.php?status=isiusernamepassword");
    }
    elseif(empty($password)){
        header("location: register.php?status=isipassword");
    }
    elseif(empty($username)){
        header("location: register.php?status=isiusername");
    }
    elseif(pg_num_rows($checkusername) == 1){
        header("location: register.php?status=usernamesudahdipakai");
    }
    else{
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO pembeli (username, password) VALUES ('$username', '$password');";
        pg_query($db,$sql);
        header("location: http://localhost/projectbasdat/login.php");
        }
}
?>