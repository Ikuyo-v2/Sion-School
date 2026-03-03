<?php
require_once __DIR__ . '/../app/core/Router.php';
use App\Core\Router;

$router = new Router();
$router->add('GET', '/siswa', 'StudentController', 'index');
$router->add('GET', '/siswa/create', 'StudentController', 'create');
$router->add('GET', '/siswa/{id}', 'StudentController', 'show');
$router->add('GET', '/siswa/show_tables', 'StudentController', 'show_tables');
$router->run();
?>