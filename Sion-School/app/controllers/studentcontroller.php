<?php
namespace App\Controllers;

class StudentController 
{
    


    public function show_siswa_tables()
    {

        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();
        $result = $conn->query("SELECT * FROM siswa");
        $students = [];
        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);
        }

        require_once __DIR__ . '/../views/admin/admin.php';
    }

    public function add_student()
    {
        // pastikan request method POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/admin');
            exit;
        }

        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();

        $nama = isset($_POST['nama']) ? $conn->real_escape_string(trim($_POST['nama'])) : '';
        $email = isset($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : '';
        $kelas = isset($_POST['kelas']) ? $conn->real_escape_string(trim($_POST['kelas'])) : '';

        if ($nama && $email && $kelas) {
            $stmt = $conn->prepare("INSERT INTO siswa (nama, email, kelas, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param('sss', $nama, $email, $kelas);
            $stmt->execute();
            $stmt->close();
        }

        header('Location: /admin/admin');
        exit;
    }



}
?>