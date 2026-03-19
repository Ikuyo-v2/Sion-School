<?php
require_once __DIR__ . '/../../config/database.php';

$conn = \App\Config\Database::getConnection();
$result = $conn->query("SELECT * FROM lomba");
$contest = [];
if ($result) {
    $contest = $result->fetch_all(MYSQLI_ASSOC);
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
    <div class="content-lomba">
        <div class="nav">
            <h1>Data Berita</h1>
            <div>
                <a class="button" href="../students">View Siswa</a>
                <a class="button" href="../events">View Berita</a>
            </div>
        </div>
        <!-- Tabel Rek -->
        <table class="table" border="1">
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php foreach ($contests as $contest): ?>
                <tr>
                    <td><?= $contest['id'] ?></td>
                    <td>
                        <a href="/contests/show/<?= $contest['id'] ?>" class="nama">
                            <?= $contest['judul'] ?>
                        </a>
                    </td>
                    <td style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                        <?= $contest['deskripsi'] ?>
                    </td>
                    <td>
                        <img src="<?= $contest['gambar'] ?>" alt="Contest Image"
                            style="width: 200px; height: 140px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td><?= $contest['tanggal'] ?></td>
                    <td><?= $contest['lokasi'] ?></td>
                    <td><?= $contest['kuota'] ?></td>
                    <td><?= $contest['created_at'] ?></td>
                    <td>
                        <a href="/contests/delete/<?= $contest['id'] ?>" onclick="return confirm('Delete this contest?');"
                            style="color: red;">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <form method="POST" action="/contests" enctype="multipart/form-data">
                    <td>ID</td>
                    <td><input type="text" name="judul" placeholder="Judul" class="input"></td>
                    <td><input type="text" name="deskripsi" placeholder="Deskripsi" class="input"></td>
                    <td><input type="file" name="gambar" accept="image/*" class="input"></td>
                    <td><input type="date" name="tanggal" class="input"></td>
                    <td><input type="text" name="lokasi" placeholder="Lokasi" class="input"></td>
                    <td><input type="number" name="kuota" placeholder="Kuota" class="input"></td>
                    <td></td>
                    <td><button type="submit" class="button">Add</button></td>
                </form>
            </tr>
        </table>
        <!-- /Tabel Rek -->
    </div>
</body>

</html