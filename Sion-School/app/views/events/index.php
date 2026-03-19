<?php
require_once __DIR__ . '/../../config/database.php';

$conn = \App\Config\Database::getConnection();
$result = $conn->query("SELECT * FROM berita");
$events = [];
if ($result) {
    $events = $result->fetch_all(MYSQLI_ASSOC);
} else {
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
    <div class="content">
        <div class="nav">
            <h1>Data Berita</h1>
            <div>
                <a class="button" href="../students">View Siswa</a>
                <a class="button" href="../contests">View Lomba</a>
            </div>
        </div>
        <!-- Tabel Rek -->
        <table class="table" border="1">
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Detail</th>
                <th>gambar</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php foreach ($events as $events): ?>
                <tr>
                    <td><?= $events['id'] ?></td>
                    <td>
                        <a href="/events/show/<?= $events['id'] ?>" class="nama">
                            <?= $events['judul'] ?>
                        </a>
                    </td>
                    <td style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                        <?= $events['isi'] ?>
                    </td>
                    <td>
                        <img src="<?= $events['gambar'] ?>" alt="Event Image"
                            style="width: 200px; height: 140px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td><?= $events['created_at'] ?></td>
                    <td>
                        <a href="/events/delete/<?= $events['id'] ?>" onclick="return confirm('Delete this event?');"
                            style="color: red;">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <form method="POST" action="/events" enctype="multipart/form-data">
                    <td>ID</td>
                    <td><input type="text" name="judul" placeholder="Judul" class="input"></td>
                    <td><input type="text" name="isi" placeholder="Detail" class="input"></td>
                    <td><input type="file" name="gambar" accept="image/*" class="input"></td>
                    <td></td>
                    <td><button type="submit" class="button">Add</button></td>
                </form>
            </tr>
        </table>
        <!-- /Tabel Rek -->
    </div>
</body>

</html