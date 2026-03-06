<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Berita</title>
    <link rel="stylesheet" href="/css/admin.css">
    <style>
        .edit-mode { display: none; }
        .edit-mode.active { display: contents; }
        .view-mode.hidden { display: none; }
        .edit-input { padding: 5px; width: 100%; box-sizing: border-box; }
    </style>
</head>
<body>
    <h1 class="title">Admin: Daftar Berita</h1> 

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
                    <tr class="data-row" id="row-<?php echo $siswa['id']; ?>">
                        <td><?php echo htmlspecialchars($siswa['id']); ?></td>
                        
                        <!-- Nama -->
                        <td class="view-mode" id="nama-view-<?php echo $siswa['id']; ?>">
                            <?php echo htmlspecialchars($siswa['nama']); ?>
                        </td>
                        <td class="edit-mode" id="nama-edit-<?php echo $siswa['id']; ?>">
                            <input type="text" class="edit-input" value="<?php echo htmlspecialchars($siswa['nama']); ?>">
                        </td>
                        
                        <!-- Email -->
                        <td class="view-mode" id="email-view-<?php echo $siswa['id']; ?>">
                            <?php echo htmlspecialchars($siswa['email']); ?>
                        </td>
                        <td class="edit-mode" id="email-edit-<?php echo $siswa['id']; ?>">
                            <input type="email" class="edit-input" value="<?php echo htmlspecialchars($siswa['email']); ?>">
                        </td>
                        
                        <!-- Kelas -->
                        <td class="view-mode" id="kelas-view-<?php echo $siswa['id']; ?>">
                            <?php echo htmlspecialchars($siswa['kelas']); ?>
                        </td>
                        <td class="edit-mode" id="kelas-edit-<?php echo $siswa['id']; ?>">
                            <input type="text" class="edit-input" value="<?php echo htmlspecialchars($siswa['kelas']); ?>">
                        </td>
                        
                        <td><?php echo htmlspecialchars($siswa['created_at']); ?></td>
                        
                        <!-- lihat,edit,del -->
                        <td class="view-mode" id="actions-view-<?php echo $siswa['id']; ?>">
                            <a href="/siswa/show/<?php echo $siswa['id']; ?>">Lihat</a>
                            |
                            <button type="button" onclick="editRow(<?php echo $siswa['id']; ?>, event)" style="background:none; border:none; color:blue; cursor:pointer; text-decoration:underline; padding:0;">Edit</button>
                            |
                            <form action="/admin/delete/<?php echo $siswa['id']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                <button type="submit" style="background:none; border:none; color:blue; cursor:pointer; text-decoration:underline; padding:0;">Hapus</button>
                            </form>
                        </td>
                        <td class="edit-mode" id="actions-edit-<?php echo $siswa['id']; ?>">
                            <button type="button" onclick="saveEdit(<?php echo $siswa['id']; ?>, event)" style="background:none; border:none; color:green; cursor:pointer; text-decoration:underline; padding:0;">Simpan</button>
                            |
                            <button type="button" onclick="cancelEdit(<?php echo $siswa['id']; ?>, event)" style="background:none; border:none; color:red; cursor:pointer; text-decoration:underline; padding:0;">Batal</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada berita untuk ditampilkan.</p>
    <?php endif; ?>

    <h2>Tambah berita</h2>
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
    <script>
        function editRow(id, event) {
            event.preventDefault();
            // Hide view, show edit
            document.getElementById('nama-view-' + id).classList.add('hidden');
            document.getElementById('nama-edit-' + id).classList.add('active');
            document.getElementById('email-view-' + id).classList.add('hidden');
            document.getElementById('email-edit-' + id).classList.add('active');
            document.getElementById('kelas-view-' + id).classList.add('hidden');
            document.getElementById('kelas-edit-' + id).classList.add('active');
            document.getElementById('actions-view-' + id).classList.add('hidden');
            document.getElementById('actions-edit-' + id).classList.add('active');
        }

        function cancelEdit(id, event) {
            event.preventDefault();
            // Show view, hide edit
            document.getElementById('nama-view-' + id).classList.remove('hidden');
            document.getElementById('nama-edit-' + id).classList.remove('active');
            document.getElementById('email-view-' + id).classList.remove('hidden');
            document.getElementById('email-edit-' + id).classList.remove('active');
            document.getElementById('kelas-view-' + id).classList.remove('hidden');
            document.getElementById('kelas-edit-' + id).classList.remove('active');
            document.getElementById('actions-view-' + id).classList.remove('hidden');
            document.getElementById('actions-edit-' + id).classList.remove('active');
        }

        function saveEdit(id, event) {
            event.preventDefault();
            const nama = document.querySelector('#nama-edit-' + id + ' .edit-input').value;
            const email = document.querySelector('#email-edit-' + id + ' .edit-input').value;
            const kelas = document.querySelector('#kelas-edit-' + id + ' .edit-input').value;

            fetch('/admin/edit/' + id, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nama, email, kelas })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('nama-view-' + id).textContent = nama;
                    document.getElementById('email-view-' + id).textContent = email;
                    document.getElementById('kelas-view-' + id).textContent = kelas;
                    cancelEdit(id, event);
                } else {
                    alert(data.message || 'Gagal mengupdate data');
                }
            })
            .catch(err => alert('Error: ' + err));
        }
    </script>
</body>
