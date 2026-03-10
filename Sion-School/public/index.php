<?php
require_once __DIR__ . '/../app/core/Router.php';
use App\Core\Router;

$router = new Router();
$router->add('GET', '/admin/admin', 'StudentController', 'show_table_siswa');
$router->add('GET', '/admin/delete/{id}', 'StudentController', 'delete_siswa');
$router->add('POST', '/admin/add', 'StudentController', 'add_siswa');

$router->run();
?>