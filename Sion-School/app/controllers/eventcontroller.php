<?php
namespace App\Controllers;

class EventController
{
    public function index()
    {
        require_once __DIR__ . '/../config/database.php';
        $conn = \App\Config\Database::getConnection();
        $result = $conn->query("SELECT * FROM berita");
        $events = [];
        if ($result) {
            $events = $result->fetch_all(MYSQLI_ASSOC);
        }

        require_once __DIR__ . '/../views/events/index.php';
    }

    public function delete($id)
    {
        require_once __DIR__ . '/../config/database.php';
        $result = \App\Config\Database::delete('berita', 'id', $id);

        if ($result) {
            header('Location: /events');
            exit;
        }
    }

    public function store()
    {
        require_once __DIR__ . '/../config/database.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'judul' => $_POST['judul'] ?? '',
                'isi' => $_POST['isi'] ?? '',
                'gambar' => ''
            ];

            // Handle file upload
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/images/berita/uploads/';

                // Create folder if it doesn't exist prop no use
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // No more pesky spaces in filenames yayyyy
                $filename = str_replace(' ', '_', basename($_FILES['gambar']['name']));
                $uploadFile = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadFile)) {
                    $data['gambar'] = '/images/berita/uploads/' . $filename;
                } else {
                    echo "Error uploading file.";
                    return;
                }
            }

            $result = \App\Config\Database::insert('berita', $data);

            if ($result) {
                header('Location: /events');
                exit;
            }
        }
    }

}
?>