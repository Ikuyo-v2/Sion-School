<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/BeritaModel.php';
require_once __DIR__ . '/../models/LombaModel.php'; 

use App\models\BeritaModel;
use App\models\LombaModel;

class HomeController
{
    public function index()
    {
        $beritaModel = new BeritaModel();
        $data['berita'] = $beritaModel->getLatest(3);

        $lombaModel = new LombaModel();
        $data['lomba'] = $lombaModel->getLatest(3);

        require_once __DIR__ . '/../views/Home/Index.php';
    }
}
?>