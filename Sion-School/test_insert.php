<?php
require_once __DIR__ . '/../config/database.php';

$data = [
    'nama' => 'Test Student',
    'email' => 'test@example.com',
    'kelas' => '10A',
    'created_at' => date('Y-m-d H:i:s')
];

$result = \App\Config\Database::insert('siswa', $data);

if ($result) {
    echo "Student added successfully.";
} else {
    echo "Failed to add student.";
}
?>