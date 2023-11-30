
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Arial&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black&display=swap" rel="stylesheet" />
    <link href="./css/login.css" rel="stylesheet" />
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="images/logo.png" alt="">
        </div>
        <div class="content">
            <div class="login-form">
                <h1 class="welcome-text">WELCOME</h1>
                <form action="prosesdaftar.php" method="post">
                    <fieldset>
                    <label for="email" class="label">Username</label>
                    <input type="text" name = "username" id="email" class="input-field">
                    <label for="password" class="label">Password</label>
                    <input type="password" name = "password" id="password" class="input-field">
                    <input type="submit" name="register" value="Register" class="masuk-button"><br>
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
                                } elseif($_GET['status'] == 'usernamesudahdipakai') {
                                    echo "Username sudah dipakai";
                                }
                            ?>
                        </p>
                    <?php endif; ?>
                    <p class="signup-text">already have account? <a href="register.php" class="signup-link">Login</a></p>
                    </fieldset> 
                </form>
            </div>
            <div class="additional-info">
                <span class="v22_38">Terima kasih sudah mendaftar, silahkan gunakan layanan kami.</span>
            </div>
        </div>
    </div>
</body>
</html>


