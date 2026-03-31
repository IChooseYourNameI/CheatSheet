<?php
class Controller {
    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }
}

// Příklad v Controlleru
$db = Database::getInstance()->getConnection();
$stmt = $db->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>