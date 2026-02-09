<?php
include_once("database.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ŠUŠENKY</title>
    </head>

    <body>

    <?php if(isset($_SESSION["logged_user"])) { ?>
        <summary>
            Přihlášeno
            <details>
                Uživatel: <?= $_SESSION["logged_user"] ?>
                <a href="login.php?logout=true">Odhlásit</a>
            </details>
        </summary>

    <?php } ?>


        <h1>🍪 Sušenky a Sesssion </h1>

        <h2>Login form</h2>
        <form action="login.php" method="post">   
            <label>Username: </label>
            <input type="text"     name="username">
           
            <br>
            <label>Password: </label>
            <input type="password" name="password">
            
            <br>
            <input type="submit" value="LOGIN">
        </form>

        <h2>Register form</h2>

        <form action="register.php" method="post">
            <label>Username: </label>
            <input type="text"     name="username">

            <br>
            <label>Password: </label>
            <input type="password" name="password">
            
            <br>
            <input type="submit" value="REGISTER">
        </form>
    </body>

</html>
