<?php
require_once __DIR__ . '/../app/core/Router.php';
use App\Controllers\StudentController;
use App\Core\Router;

$router = new Router();
//lobotomypages
$router->add('GET','/students', 'StudentController', 'index');
$router->add('GET','/students/create', 'StudentController', 'create');
$router->add('GET','/students/{id}/edit', 'StudentController', 'edit');
$router->add('GET','/students/{id}', 'StudentController', 'show');
$router->add('GET','/students/delete/{id}', 'StudentController', 'delete');

$router->add('GET','/events', 'EventController', 'index');
$router->add('GET','/events/create', 'EventController', 'create');
$router->add('GET','/events/{id}/edit', 'EventController', 'edit');
$router->add('GET','/events/{id}', 'EventController', 'show');
$router->add('GET','/events/delete/{id}', 'EventController', 'delete');

$router->add('GET','/contests', 'ContestController', 'index');
$router->add('GET','/contests/create', 'ContestController', 'create');
$router->add('GET','/contests/{id}/edit', 'ContestController', 'edit');
$router->add('GET','/contests/{id}', 'ContestController', 'show');
$router->add('GET','/contests/delete/{id}', 'ContestController', 'delete');

//freakyfunction
$router->add('POST','/students', 'StudentController', 'store');
$router->add('POST','/events', 'EventController', 'store');
$router->add('POST','/contests', 'ContestController', 'store');


// Manage Siswa
// - Daftar Siswa => GET - /students - StudentController@index
// - Tambah Siswa => GET - /students/create - StudentController@create
// - Edit Siswa => GET - /students/{id}/edit - StudentController@edit
// - Detail Siswa => GET - /students/{id} - StudentController@show

// Logika Tambah Siswa => POST - /students - StudentController@store
// Logika Edit Siswa => PUT - /students/{id} - StudentController@update
// Logika Delete Siswa => DELETE - /students/{id} - StudentController@destroy


// Manage produk
// - Daftar Produk => GET - /products - ProductController@index
// - Tambah Produk => GET - /products/create - ProductController@create
// - Edit Produk => GET - /products/{id}/edit - ProductController@edit
// - Detail Produk => GET - /products/{id} - ProductController@show

// Logika Tambah Produk => POST - /products - ProductController@store
// Logika Edit Produk => PUT - /products/{id} - ProductController@update
// Logika Delete Produk => DELETE - /products/{id} - ProductController@destroy



$router->run();
?>