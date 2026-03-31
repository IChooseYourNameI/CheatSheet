<?php

class Database {
    private static $instance = null;
    private $pdo;

    // Soukromý konstruktor zabrání vytvoření instance pomocí 'new Database' zvenčí
    private function __construct() {
        $config = require '../config.php';
        
        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset={$config['db_charset']}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], $options);
        } catch (PDOException $e) {
            die("Chyba připojení k DB: " . $e->getMessage());
        }
    }

    // Statická metoda pro získání jediné instance
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Metoda pro přístup k samotnému PDO objektu
    public function getConnection() {
        return $this->pdo;
    }

    // Zamezení klonování instance
    private function __clone() {}
}