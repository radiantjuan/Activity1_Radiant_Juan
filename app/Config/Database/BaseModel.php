<?php
/**
 * Base Model
 *
 * @author Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan
 */
namespace App\Config\Database;

class BaseModel
{
    protected $pdo;

    public $table;

    public function __construct()
    {
        $config = require_once 'database_config.php';
        $dbConnection = new DatabaseConnection($config);
        $this->pdo = $dbConnection->connect();
    }

    /**
     * Find a record by its primary key
     *
     * @param int $id primary key ID
     *
     * @return mixed
     */
    public function find($id)
    {
        $table = $this->table;
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get all records from a table
     *
     * @param $table
     *
     * @return mixed
     */
    public function all($table)
    {
        $table = $this->table;
        $stmt = $this->pdo->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    /**
     * Insert a new record into a table
     *
     * @param string $table table name
     * @param array  $data  Value data to insert
     *
     * @return false|string
     */
    public function create($data)
    {
        $table = $this->table;
        $keys = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }

    /**
     * Update a record in a table
     *
     * @param string $table table name
     * @param int    $id    primary key ID
     * @param array  $data  array of values you need to update
     *
     * @return void
     */
    public function update($id, $data)
    {
        $table = $this->table;
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');
        $sql = "UPDATE $table SET $set WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
    }

    /**
     * Delete a table record
     *
     * @param string $table table name
     * @param int    $id    primary key ID
     *
     * @return void
     */
    public function delete($id)
    {
        $table = $this->table;
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    /**
     * Retrieve records from a table based on conditions
     *
     * @param string $table      table name
     * @param array  $conditions consists of column and query you want to search
     *
     * @return array|false
     */
    public function where($conditions)
    {
        $table = $this->table;
        $where = '';
        foreach ($conditions as $key => $value) {
            $where .= "$key = :$key AND ";
        }
        $where = rtrim($where, 'AND ');

        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $where");
        $stmt->execute($conditions);
        return $stmt->fetchAll();
    }

    /**
     * Execute a custom SQL query with parameter binding
     * Sample usage: $model->query("SELECT * FROM users WHERE role = :role", ['role' => 'admin']);
     *
     * @param string $sql    Custom SQL query
     * @param array  $params array of conditions you need to query
     *
     * @return array|false
     */
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
