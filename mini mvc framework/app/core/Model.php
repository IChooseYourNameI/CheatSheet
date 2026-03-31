<?php
class Model {
    protected $db;

    public function __construct() {
        // Každý model automaticky dostane připojení k DB
        $this->db = Database::getInstance()->getConnection();
    }
}