<?php
/**
 * Database connection establisher
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

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

    /**
     * Connection establishment
     *
     * @return PDO|void
     */
    public function connect()
    {
        $dbHost = $this->config['host'];
        $dbName = $this->config['name'];
        $dbUser = $this->config['user'];
        $dbPassword = $this->config['password'];

        try {
            $pdo = new PDO("mysql:host=$dbHost; dbname=$dbName", $dbUser, $dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
