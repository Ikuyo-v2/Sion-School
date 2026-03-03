<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa</title>
</head>
<body>
    <h1>Detail Siswa</h1>
    <?php if (!empty($student)): ?>
        <ul>
            <?php foreach ($student as $key => $value): ?>
                <li><strong><?php echo htmlspecialchars($key); ?>:</strong> <?php echo htmlspecialchars($value); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Data siswa tidak ditemukan.</p>
    <?php endif; ?>
</body>
</html>