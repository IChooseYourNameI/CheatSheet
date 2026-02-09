<?php
include_once("database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = $_POST["password"] ?? '';

    if (empty($username) || empty($password)) {
        echo "<p style='color: red; font-weight:bold'>Vyplňte všechna pole</p>";
    } else {
        // Kontrola existence uživatele
        $stmt = $DB->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->fetch()) {
            echo "<p style='color: red; font-weight:bold'>Uživatel již existuje</p>";
        } else {
            // Hash hesla – velmi důležité!
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Uložení nového uživatele
            $stmt = $DB->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashedPassword]);

            // Automatické přihlášení
            $userId = $DB->lastInsertId();
            
            $_SESSION["logged_user"]    = $username;
            $_SESSION["logged_user_id"] = $userId;

            echo "<p style='color: green; font-weight:bold'>Registrace úspěšná → přihlášen</p>";
            include_once("index.php");
            exit;
        }
    }
}
?>
