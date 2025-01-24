<?php

namespace Core;

use PDO;
use PDOException;

class Model {
    protected $db;
    protected $security;

    public function __construct() {
        $this->security = new Security();
        $config = require __DIR__ . "/../../Config/database.php";

        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']}";
            $this->db = new PDO($dsn, $config["username"], $config["password"]);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->db->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :dbname");
            $stmt->execute([":dbname" => $config["database"]]);
            $dbExists = $stmt->fetch();

            if(!$dbExists){
                $this->db->exec("CREATE DATABASE `{$config['database']}` CHARACTER SET {$config['charset']}");
                $this->db->exec("USE `{$config['database']}`").
                $this->initializeDatabase($config["script_path"]);

                $seeder = new DatabaseSeeder();
                $seeder->run();
            } else {
                $this->db->exec("USE `{$config['database']}`");
            }
        } catch (PDOException $e){
            error_log("Database connection error : " . $e->getMessage());
            die("An error occurred. Please try again later.");
        }
    }

    private function initializeDatabase ($scriptPath){
        try {
            $sql = file_get_contents($scriptPath);
            if($sql === false){
                throw new PDOException("Unable to read SQL script at : $scriptPath");
            }
            $this->db->exec($sql);
        } catch (PDOException $e) {
            error_log("Database initialization error : " . $e->getMessage());
            die("An error occurred during database setup. Please try again later.");
        }
    }

    public function read(string $table, array $conditions = [], array $columns = ['*']): array {
        $sql = "SELECT " . implode(", ", $columns) . " FROM {$table}";
        
        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $key => $value) {
                $where[] = "{$key} = :{$key}";
            }
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($conditions);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createSingle(string $table, array $data): int {
        $columns = implode(",", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT IGNORE INTO {$table} ({$columns}) VALUES ({$placeholders})";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);

        return $this->db->lastInsertId();
    }

    public function createBulk(string $table, array $data): void {
        if (empty($data)) {
            return;
        }
        $columns = implode(",", array_keys($data[0]));
        $placeholders = "(" . implode(",", array_fill(0, count($data[0]), "?")) . ")";
        $sql = "INSERT IGNORE INTO {$table} ({$columns}) VALUES " . implode(",", array_fill(0, count($data), $placeholders));

        $flatData = [];
        foreach ($data as $row) {
            $flatData = array_merge($flatData, array_values($row));
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($flatData);
    }

    public function update(string $table, array $data, array $conditions): int {
        $set = [];
        $where = [];
        foreach ($data as $key => $value) {
            $set[] = "{$key} = :set_{$key}";
        }
        foreach ($conditions as $key => $value) {
            $where[] = "{$key} = :where_{$key}";
        }

        $sql = "UPDATE {$table} SET " . implode(", ", $set) . " WHERE " . implode(" AND ", $where);
        $stmt = $this->db->prepare($sql);

        $params = [];
        foreach ($data as $key => $value) {
            $params["set_{$key}"] = $value;
        }
        foreach ($conditions as $key => $value) {
            $params["where_{$key}"] = $value;
        }

        $stmt->execute($params);
        return $stmt->rowCount();
    }

}