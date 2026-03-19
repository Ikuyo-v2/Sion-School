<?php
namespace App\Controllers;

class StudentController
{



    public function index()
    {

        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();
        $result = $conn->query("SELECT * FROM siswa");
        $students = [];
        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);
        }

        require_once __DIR__ . '/../views/students/index.php';
    }


    public function delete($id)
    {
        require_once __DIR__ . '/../config/database.php';
        $result = \App\Config\Database::delete('siswa', 'id', $id);

        if ($result) {
            header('Location: /students');
            exit;
        }
    }

    public function show()
    {
        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();
        $result = $conn->query("SELECT * FROM siswa");
        $students = [];
        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);
        }

        require_once __DIR__ . '/../views/students';
    }



    public function store()
    {
        require_once __DIR__ . '/../config/database.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama' =>   htmlspecialchars($_POST['nama']) ?? '',
                'email' => htmlspecialchars($_POST['email']) ?? '',
                'kelas' => htmlspecialchars($_POST['kelas']) ?? ''
            ];

            $result = \App\Config\Database::insert('siswa', $data);

            if ($result) {
                header('Location: /students');
                exit;
            }
        }
    }


    public static function deletes($table, $column, $value)
    {
        $conn = \App\Config\Database::getConnection();
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
?>