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

}
