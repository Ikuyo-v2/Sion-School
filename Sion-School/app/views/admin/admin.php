<?php
    require_once __DIR__ . '/../../config/database.php';
    
    $conn = \App\Config\Database::getConnection();
    $result = $conn->query("SELECT * FROM siswa");
    $students = [];
    if ($result) {
        $students = $result->fetch_all(MYSQLI_ASSOC);
    }
    else {
        echo "Error: " . $conn->error;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    <h1>Data Siswa</h1>
    <!-- Tabel Rek -->
    <table class="table" border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kelas</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= $student['nama'] ?></td>
            <td><?= $student['email'] ?></td>
            <td><?= $student['kelas'] ?></td>
            <td><?= $student['created_at'] ?></td>
            <td>
                <a href="/admin/delete/<?= $student['id'] ?>" onclick="return confirm('Delete this student?');" style="color: red;">
                    Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <form method="POST" action="/admin/add">
                <td >ID</td>
                <td ><input type="text" name="nama" placeholder="Nama"class="input"></td>
                <td > <input type="text" name="email" placeholder="Email"class="input"></td>
                <td ><input type="text" name="kelas" placeholder="Kelas"class="input"></td>
                <td ></td>
                <td ><button type="submit" class="button">Add</button></td>
            </form>
        </tr>
    </table>
    <!-- /Tabel Rek -->
</body>
</html