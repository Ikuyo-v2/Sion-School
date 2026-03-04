<?php
require_once __DIR__ . '/../app/core/Router.php';
use App\Core\Router;

$router = new Router();
$router->add('GET', '/admin/admin', 'StudentController', 'show_siswa_tables');
$router->add('POST', '/admin/add', 'StudentController', 'add_student');
$router->run();
?>