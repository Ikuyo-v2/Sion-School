<?php
namespace App\Controllers;

class StudentController 
{
    


    public function show_table_siswa()
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

    public function delete_siswa($id)
    {
        require_once __DIR__ . '/../config/database.php';
        $result = \App\Config\Database::delete('siswa', 'id', $id);
        
        if ($result) {
            header('Location: /admin/admin');
            exit;
        }
    }

    public function add_siswa()
    {
        require_once __DIR__ . '/../config/database.php';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama' => $_POST['nama'] ?? '',
                'email' => $_POST['email'] ?? '',
                'kelas' => $_POST['kelas'] ?? ''
            ];
            
            $result = \App\Config\Database::insert('siswa', $data);
            
            if ($result) {
                header('Location: /admin/admin');
                exit;
            }
        }
    }

    public static function delete($table, $column, $value) {
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