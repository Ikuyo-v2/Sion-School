<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Sion School!</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <!--HEADER-->
    <div class="nav">
        <a href="#" style="text-decoration: none;">
            <div class="school-card">
                <img src="/images/icons/book.png" alt="Sion School Logo">
                <div class="school-info">
                    <p class="school-name">Sion School</p>
                    <p class="school-sub">Indonesia</p>
                </div>
            </div>
        </a>

        <div class="nav-links">
            <a href="#" class="active">Beranda</a>
            <a href="#">Kalender</a>
            <a href="#">Berita</a>
            <a href="#">Lomba</a>
        </div>

        <a href="#" class="btn-masuk">&#x2192; Masuk</a>
    </div>
    <!--HEADER-->

    <!--Banner-->
    <div class="banner">

        <img src="/images/home-pages/banner.png" alt="Banner Image" class="banner-image">
        <div class="banner-content">
            <span class="banner-badge">🎓 Tahun Ajaran 2025/2026</span>
            <h1 class="banner-title">
                Selamat Datang di <span class="highlight">Sekolah<br>Sion School</span>
            </h1>
            <p class="banner-desc">
                Portal resmi sekolah untuk informasi terkini, jadwal kegiatan, berita, dan pendaftaran
                lomba. Semua dalam satu tempat yang mudah diakses.
            </p>
            <div class="banner-buttons">
                <a href="#" class="btn-kalender">📅 Lihat Kalender</a>
                <a href="#" class="btn-lomba">🏆 Ikuti Lomba</a>
            </div>
        </div>
    </div>
    <!--Banner-->

    <!--info-->
    <div class="stats">
        <div class="stat-item">
            <div class="stat-icon green"><img src="/images/icons/user.png" alt="Cooked"></div>
            <div class="stat-info">
                <p class="stat-number">1.200+</p>
                <p class="stat-label">Siswa Aktif</p>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon blue"><img src="/images/icons/book-open.png" alt="Cooked"></div>
            <div class="stat-info">
                <p class="stat-number">80+</p>
                <p class="stat-label">Guru & Staf</p>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon orange"><img src="/images/icons/star.png" alt="Cooked"></div>
            <div class="stat-info">
                <p class="stat-number">150+</p>
                <p class="stat-label">Prestasi</p>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon purple"><img src="/images/icons/basketball.png" alt="Cooked"></div>
            <div class="stat-info">
                <p class="stat-number">30+</p>
                <p class="stat-label">Ekstrakurikuler</p>
            </div>
        </div>
    </div>
    <!--info-->
    <!--Content-->
    <div class="content">
        <!--Agenda-->
        <p>
            placeholder
        </p>
        <!--Agenda-->

        <!--Berita-->
        <h1 style=" margin: 0px">Berita Terbaru</h1>
        <p style="color: #4c617d; margin: 0px;">Informasi dan kabar terkini dari sekolah</p>
        <div class="berita-grid">
            <?php foreach ($data['berita'] as $index => $item): ?>
                <div class="berita-card">
                    <div class="berita-image">
                        <img src="<?= $item['gambar'] ?>" alt="<?= $item['judul'] ?>">
                        <?php if ($index === 0): ?>
                            <span class="badge-terbaru">Terbaru</span>
                        <?php endif; ?>
                    </div>
                    <div class="berita-body">
                        <p class="berita-meta">
                            📅 <?= date('d F Y', strtotime($item['created_at'])) ?> • Admin Sekolah
                        </p>
                        <h3 class="berita-judul"><?= $item['judul'] ?></h3>
                        <p class="berita-desc">
                            <?= implode(' ', array_slice(explode(' ', $item['isi']), 0, 20)) . (str_word_count($item['isi']) > 20 ? '...' : '') ?>
                        </p>
                        <a href="/berita/<?= $item['id'] ?>" class="berita-link">Baca Selengkapnya →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!--Berita-->

        <!--Lomba-->
        <h1 style="margin: 0px">Lomba Aktif</h1>
        <p style="color: #4c617d; margin: 0px;">Ikuti lomba dan raih prestasi terbaikmu</p>
        <div class="berita-grid">
            <?php foreach ($data['lomba'] as $index => $item): ?>
                <div class="berita-card">
                    <div class="berita-image">
                        <img src="<?= $item['gambar'] ?>" alt="<?= $item['judul'] ?>">
                        <?php if ($index === 0): ?>
                            <span class="badge-terbaru">Terbaru</span>
                        <?php endif; ?>
                    </div>
                    <div class="berita-body">
                        <p class="berita-meta">
                            📅 <?= date('d F Y', strtotime($item['tanggal'])) ?> • <?= $item['lokasi'] ?>
                        </p>
                        <h3 class="berita-judul"><?= $item['judul'] ?></h3>
                        <p class="berita-desc">
                            <?= implode(' ', array_slice(explode(' ', $item['deskripsi']), 0, 20)) . (str_word_count($item['deskripsi']) > 20 ? '...' : '') ?>
                        </p>
                        <p class="berita-meta">👥 Kuota: <?= $item['kuota'] ?> peserta</p>
                        <a href="/lomba/<?= $item['id'] ?>" class="berita-link">Lihat Detail →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!--Lomba-->



    </div>
    <!--Content-->

    <!--pop-up-->
    <div class="cta-section">
        <h2>Tetap Update dengan Kegiatan Sekolah</h2>
        <p>Pantau terus kalender, berita, dan lomba terbaru agar kamu tidak ketinggalan informasi penting.</p>
        <div class="cta-buttons">
            <a href="/kalender" class="cta-btn-white"><img style="width: 17px;" src="/images/icons/calendar.png"
                    alt="Cooked"> Cek Kalender</a>
            <a href="/lomba" class="cta-btn-outline"><img style="width: 17px;" src="/images/icons/trophy-white.png"
                    alt="Cooked"> Ikuti Lomba</a>
        </div>
    </div>
    <!--pop-up-->

    <br>
    <br>
    <br>

    <!--Footer-->
    <footer class="footer">
        <div class="footer-content">
            <!-- Brand -->
            <div class="footer-brand">
                <div class="school-card">
                    <img src="/images/icons/book.png" alt="Logo">
                    <div class="school-info">
                        <p class="school-name" style="color: white;">Sion School</p>
                        <p class="school-sub" style="color: #93a8d4;">Indonesia </p>
                    </div>
                </div>
                <p class="footer-desc">Sekolah terbaik yang mencetak generasi unggul dan berkarakter untuk masa depan
                    Indonesia.</p>
            </div>

            <!-- Menu Cepat -->
            <div class="footer-col">
                <h4>Menu Cepat</h4>
                <a href="/beranda">Beranda</a>
                <a href="/kalender">Kalender</a>
                <a href="/berita">Berita</a>
                <a href="/lomba">Lomba</a>
            </div>

            <!-- Kontak -->
            <div class="footer-col">
                <h4>Kontak</h4>
                <p>📍 Jl. Pendidikan No. 1, Jakarta</p>
                <p>📞 (021) 1234-5678</p>
                <p>✉️ info@sionschool.sch.id</p>
                <p>🕐 Senin–Jumat, 07.00–15.00 WIB</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 Sion School. Semua hak dilindungi.</p>
        </div>
    </footer>
    <!--Footer-->


</body>

</html>