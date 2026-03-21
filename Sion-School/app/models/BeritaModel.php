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

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM berita ORDER BY created_at DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function search($keyword)
    {
        $keyword = '%' . $keyword . '%';
        $stmt = $this->db->prepare("SELECT * FROM berita WHERE judul LIKE ? ORDER BY created_at DESC");
        $stmt->bind_param("s", $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getRandom()
    {
        $stmt = $this->db->prepare("SELECT * FROM berita ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

}
?>