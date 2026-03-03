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
}
