<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Data z databáze MySQL přes PDO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 40px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Uživatelé z databáze</h1>

<?php
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->query("SELECT * FROM users");

    $users = $stmt->fetchAll();

    if (count($users) > 0) {
        // Výpis hlavičky tabulky
        echo '<table>';
        echo '<tr>';
        foreach ($users[0] as $key => $value) {
            echo '<th>' . htmlspecialchars($key) . '</th>';
        }
        echo '</tr>';

        // Výpis dat
        foreach ($users as $user) {
            echo '<tr>';
            foreach ($user as $value) {
                echo '<td>' . htmlspecialchars($value) . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class="error">Žádná data v tabulce.</p>';
    }

} catch (PDOException $e) {
    echo '<p class="error">Chyba připojení nebo dotazu: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>
</body>
</html>