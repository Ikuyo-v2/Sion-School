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

        public function show_berita_tables()
    {

        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();
        $result = $conn->query("SELECT * FROM berita");
        $berita = [];
        if ($result) {
            $berita = $result->fetch_all(MYSQLI_ASSOC);
        }

        require_once __DIR__ . '/../views/admin/admin_berita.php';
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

    public function delete_student($id)
    {
        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();

        $id = (int)$id;
        $stmt = $conn->prepare("DELETE FROM siswa WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();

        header('Location: /admin/admin');
        exit;
    }

    public function edit_student($id)
    {
        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();

        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $id = (int)$id;
        $nama = isset($data['nama']) ? $conn->real_escape_string(trim($data['nama'])) : '';
        $email = isset($data['email']) ? $conn->real_escape_string(trim($data['email'])) : '';
        $kelas = isset($data['kelas']) ? $conn->real_escape_string(trim($data['kelas'])) : '';

        if ($nama && $email && $kelas) {
            $stmt = $conn->prepare("UPDATE siswa SET nama = ?, email = ?, kelas = ? WHERE id = ?");
            $stmt->bind_param('sssi', $nama, $email, $kelas, $id);
            $result = $stmt->execute();
            $stmt->close();

            echo json_encode(['success' => $result, 'message' => $result ? 'Data berhasil diupdate' : 'Gagal mengupdate data']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
        }
        exit;
    }


}
?>