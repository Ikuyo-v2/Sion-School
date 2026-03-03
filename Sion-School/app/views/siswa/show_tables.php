<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tabel</title>
</head>
<body>
    <h1>Daftar Tabel di Database</h1>
    <?php if (!empty($tables)): ?>
        <ul>
            <?php foreach ($tables as $table): ?>
                <li><?php echo htmlspecialchars($table); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Tidak ada tabel ditemukan atau terjadi kesalahan.</p>
    <?php endif; ?>
</body>
</html>