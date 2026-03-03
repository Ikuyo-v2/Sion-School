<?php
namespace App\Controllers;

class StudentController 
{
    
    public function index()
    {
        // load database connection and fetch all siswa records
        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();
        $result = $conn->query("SELECT * FROM siswa");
        $students = [];
        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);
        }

        // pass data to view
        require_once __DIR__ . '/../views/siswa/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/siswa/create.php';
    }

    public function show($id)
    {

        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM siswa WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $student = $stmt->get_result()->fetch_assoc();

        require_once __DIR__ . '/../views/siswa/show.php';
    }

    public function show_tables()
    {
        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();
        $result = $conn->query("SHOW TABLES");
        $tables = [];
        if ($result) {
            while ($row = $result->fetch_array(MYSQLI_NUM)) {
                $tables[] = $row[0];
            }
        }

        require_once __DIR__ . '/../views/siswa/show_tables.php';
    }




}
?>