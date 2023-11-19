<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <H2>Login Form</H2>
    <form action="proseslogin.php" method="post">
        <fieldset>
            Username: <br>
            <input type="text" name="username"><br>
            password:<br>
            <input type="password" name="password"><br>
            <input type="submit" name="login" value="Login"><br>
            <a href="register.php">Create account</a>
        </fieldset> 
    </form>
</body>
</html>

<?php if(isset($_GET['status'])): ?>
	<p>
		<?php
            if($_GET['status'] == 'isiusernamepassword'){
                echo "Isi Username dan Password";
            }
			elseif($_GET['status'] == 'isipassword'){
                echo "Isi password";
			} elseif($_GET['status'] == 'isiusername') {
				echo "Isi username";
			} elseif($_GET['status'] == 'logingagal') {
				echo "Login gagal";
			}
		?>
	</p>
<?php endif; ?>