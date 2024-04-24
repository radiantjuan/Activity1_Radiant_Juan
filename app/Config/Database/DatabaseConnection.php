<?php

namespace App\Config\Database;

use PDO;
use PDOException;

class DatabaseConnection implements DatabaseConnectionInterface
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        $dbHost = $this->config['host'];
        $dbName = $this->config['name'];
        $dbUser = $this->config['user'];
        $dbPassword = $this->config['password'];

        try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
