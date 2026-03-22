<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/BeritaModel.php';

use App\models\BeritaModel;

class BeritaController
{
    public function index()
    {
        $beritaModel = new BeritaModel();

        $data['featured'] = $beritaModel->getRandom(); 

        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
        if ($keyword !== '') {
            $data['berita'] = $beritaModel->search($keyword);
        } else {
            $data['berita'] = $beritaModel->getAll();
        }

        $data['keyword'] = $keyword;

        require_once __DIR__ . '/../views/Berita/Index.php';
    }


}
?>