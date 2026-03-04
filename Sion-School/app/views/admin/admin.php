<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Siswa</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    <h1 class="title">Admin: Daftar Siswa</h1> 

    <?php if (!empty($students)): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th >ID</th>
                    <th >Nama</th>
                    <th >Email</th>
                    <th >Kelas</th>
                    <th >Created At</th>
                    <th >C</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $siswa): ?>
                    <tr>
                        <td ><?php echo htmlspecialchars($siswa['id']); ?></td>
                        <td ><?php echo htmlspecialchars($siswa['nama']); ?></td>
                        <td ><?php echo htmlspecialchars($siswa['email']); ?></td>
                        <td ><?php echo htmlspecialchars($siswa['kelas']); ?></td>
                        <td ><?php echo htmlspecialchars($siswa['created_at']); ?></td>
                        <td >
                            <a href="/siswa/show/<?php echo $siswa['id']; ?>">Lihat</a>
                            |
                            <a href="/siswa/edit/<?php echo $siswa['id']; ?>">Edit</a>
                            |
                            <a href="/siswa/delete/<?php echo $siswa['id']; ?>"onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada siswa untuk ditampilkan.</p>
    <?php endif; ?>

    <!-- Form untuk menambah siswa baru -->
    <h2>Tambah siswa</h2>
    <form action="/admin/add" method="post">
        <table class="min-w-full bg-white border">
            <tbody>
                <tr>
                    <td class="px-2 py-1 border"><input type="text" name="nama" placeholder="Nama" required></td>
                    <td class="px-2 py-1 border"><input type="email" name="email" placeholder="Email" required></td>
                    <td class="px-2 py-1 border"><input type="text" name="kelas" placeholder="Kelas" required></td>
                    <td class="px-2 py-1 border"><button type="submit">Tambah</button></td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>