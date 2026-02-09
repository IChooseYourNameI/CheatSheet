
<?php
include_once("database.php");
session_start();

function loginUser($user) {
    $id = $user["id"];
    $username = $user["username"];
    
    $_SESSION["logged_user"] = $username;
    $_SESSION["logged_user_id"] = $id;
}

// Vyhledáváme uživatele podle jména a porovnáváme heslo
if (isset($_POST['username'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $DB->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["logged_user"]    = $user["username"];
        $_SESSION["logged_user_id"] = $user["id"];
        echo "<p style='color: green; font-weight:bold'>Přihlášen</p>";
        include_once("index.php");
    } else {
        echo "<p style='color: red; font-weight:bold'>Špatné údaje</p>";
    }
}



// Pokud je v GETU logout => zruš session
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    echo "<p style='color: red; font-weight:bold'> Uživatel odhlášen <p>";
    include_once("index.php");
}