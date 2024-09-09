<?php

namespace models;
use PDO;
use PDOException;

class Model
{
    
    protected $pdo;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $host = 'localhost';
        $dbName = 'ccbj_estoque';
        $username = 'root';
        $password = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Falha na conexão: " . $e->getMessage());
        }
    }
    
}

?>
