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
    <table class="table" border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= $student['nama'] ?></td>
            <td><?= $student['kelas'] ?></td>
            <td><?= $student['created_at'] ?></td>
            <td>
                <a href="/admin/delete/<?= $student['id'] ?>" onclick="return confirm('Delete this student?');" style="color: red;">
                    Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>