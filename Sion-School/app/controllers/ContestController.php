<?php
namespace App\Controllers;

class ContestController
{
    public function index()
    {
        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();
        $result = $conn->query("SELECT * FROM lomba");
        $contests = [];
        if ($result) {
            $contests = $result->fetch_all(MYSQLI_ASSOC);
        }

        require_once __DIR__ . '/../views/contests/index.php';
    }

    public function delete($id)
    {
        require_once __DIR__ . '/../config/database.php';
        $result = \App\Config\Database::delete('lomba', 'id', $id);
        
        if ($result) {
            header('Location: /contests');
            exit;
        }
    }

public function store() {
    require_once __DIR__ . '/../config/database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'judul'      => $_POST['judul'] ?? '',
            'deskripsi'  => $_POST['deskripsi'] ?? '',
            'gambar'     => '',
            'tanggal'    => $_POST['tanggal'] ?? '',
            'lokasi'     => $_POST['lokasi'] ?? '',
            'kuota'      => $_POST['kuota'] ?? '',
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Handle file upload
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/images/contests/uploads/';

            // Create folder if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Sanitize filename - replace spaces with underscores
            $filename = str_replace(' ', '_', basename($_FILES['gambar']['name']));
            $uploadFile = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadFile)) {
                $data['gambar'] = '/images/contests/uploads/' . $filename;
            } else {
                echo "Error uploading file.";
                return;
            }
        }

        $result = \App\Config\Database::insert('lomba', $data);

        if ($result) {
            header('Location: /contests');
            exit;
        }
    }
}
}
?>