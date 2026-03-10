<?php
namespace App\Config;

class Database {
    public static function getConnection() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db   = 'sion_school';

        $conn = new \mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
        return $conn;
    }

    public static function delete($table, $column, $value) {
        $conn = self::getConnection();
        $query = "DELETE FROM $table WHERE $column = ?";
        
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param("s", $value);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }

    public static function insert($table, $data) {
        $conn = self::getConnection();
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            return false;
        }
        
        $types = str_repeat('s', count($data));
        $stmt->bind_param($types, ...array_values($data));
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }

}
