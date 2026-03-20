<?php
namespace App\models;

require_once __DIR__ . '/../config/Database.php';

use App\Config\Database;

class BeritaModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getLatest($limit = 3)
    {
        $stmt = $this->db->prepare("SELECT * FROM berita ORDER BY created_at DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>