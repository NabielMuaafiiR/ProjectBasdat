<?php
session_start();

include("connectdb.php");


if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $checkusername = pg_query("SELECT * FROM pembeli WHERE username = '$username' AND password = '$password';") or die(pg_error());
    $admin = pg_query("SELECT * FROM admin WHERE username = '$username' AND password = '$password';") or die(pg_error());
    if(empty($username) && empty($password)){
        header("location: login.php?status=isiusernamepassword");
    }
    elseif(empty($password)){
        header("location: login.php?status=isipassword");
    }
    elseif(empty($username)){
        header("location: login.php?status=isiusername");
    }
    elseif(pg_num_rows($checkusername) == 1){
        header("location: index.php?status=loginsukses");
        $_SESSION['username'] = $username;
    }
    elseif(pg_num_rows($admin) == 1){
        header("location: index.php?status=loginsukses");
        $_SESSION['admin'] = $username;
    }
    else{
        header("location: login.php?status=logingagal");
    }
}
?>