<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Sion School</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/berita.css">
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
            <a href="/../home">Beranda</a>
            <a href="#">Kalender</a>
            <a href="#" class="active">Berita</a>
            <a href="#">Lomba</a>
        </div>

        <a href="#" class="btn-masuk">&#x2192; Masuk</a>
    </div>
    <!--HEADER-->

    <!--lampiran-->
    <div class="berita-header">
        <h1>Berita Sekolah</h1>
        <p>Informasi dan kabar terbaru dari Sion School</p>
    </div>
    <!--lampiran-->

    <!--search-->
    <div class="berita-search">
        <div class="search-box">
            <span style="opacity: 0.4; margin-top: 5px;">
                <img style="width: 24px; height: 24px;" src="/images/icons/search.png" alt="Search">
            </span>
            <input type="text" placeholder="Cari berita..." value="<?= htmlspecialchars($data['keyword']) ?>"
                oninput="searchBerita(this.value)">
        </div>
    </div>
    <!--search-->

    <!--promoted-->
    <?php if (!empty($data['featured'])): ?>
        <div class="berita-featured">
            <img src="<?= $data['featured']['gambar'] ?>" alt="<?= $data['featured']['judul'] ?>">
            <div class="featured-body">
                <span class="featured-badge">Berita Utama</span>
                <h2><?= $data['featured']['judul'] ?></h2>
                <p><?= implode(' ', array_slice(explode(' ', $data['featured']['isi']), 0, 30)) . '...' ?></p>
                <p class="berita-meta">
                    <img style="width: 20px; height: 20px;" src="/images/icons/calendar.png" alt="Cooked">
                    <?= date('d F Y', strtotime($data['featured']['created_at'])) ?> • Admin Sekolah
                </p>
                <button class="featured-btn" onclick="openBerita(
                    '<?= addslashes($data['featured']['judul']) ?>',
                    '<?= addslashes($data['featured']['isi']) ?>',
                    '<?= $data['featured']['gambar'] ?>',
                    '<?= date('d F Y', strtotime($data['featured']['created_at'])) ?>',
                    'Admin Sekolah'
                )">Baca Selengkapnya</button>
            </div>
        </div>
    <?php endif; ?>
    <!--promoted-->

    <!--beritas-->
    <div class="berita-list">
        <?php if (empty($data['berita'])): ?>
            <p class="berita-empty">Tidak ada berita ditemukan.</p>
        <?php else: ?>
            <?php foreach ($data['berita'] as $item): ?>
                <div class="berita-card">
                    <div class="berita-image">
                        <img src="<?= $item['gambar'] ?>" alt="<?= $item['judul'] ?>">
                    </div>
                    <div class="berita-body">
                        <p class="berita-meta">
                            📅 <?= date('d F Y', strtotime($item['created_at'])) ?> • Admin Sekolah
                        </p>
                        <h3 class="berita-judul"><?= $item['judul'] ?></h3>
                        <p class="berita-desc">
                            <?= implode(' ', array_slice(explode(' ', $item['isi']), 0, 20)) . (str_word_count($item['isi']) > 20 ? '...' : '') ?>
                        </p>
                        <button class="berita-link" onclick="openBerita(
                        '<?= addslashes(htmlspecialchars($item['judul'])) ?>',
                        '<?= addslashes(htmlspecialchars($item['isi'])) ?>',
                        '<?= $item['gambar'] ?>',
                        '<?= date('d F Y', strtotime($item['created_at'])) ?>',
                        'Admin Sekolah'
                        )">Baca Selengkapnya →
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!--beritas-->

    <!--popup-->
    <div class="popup-overlay" id="popupOverlay" onclick="closeBerita()">
        <div class="popup-box" onclick="event.stopPropagation()">
            <button class="popup-close" onclick="closeBerita()">✕</button>
            <img id="popupGambar" src="" alt="">
            <div class="popup-body">
                <p class="berita-meta">
                    📅 <span id="popupTanggal"></span> • <span id="popupPenulis"></span>
                </p>
                <h2 id="popupJudul"></h2>
                <p id="popupIsi"></p>
                <button class="featured-btn" onclick="closeBerita()">Tutup</button>
            </div>
        </div>
    </div>
    <!--popup-->

    <!--Footer-->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="school-card">
                    <img src="/images/icons/book.png" alt="Logo">
                    <div class="school-info">
                        <p class="school-name" style="color: white;">Sion School</p>
                        <p class="school-sub" style="color: #93a8d4;">Indonesia</p>
                    </div>
                </div>
                <p class="footer-desc">Sekolah terbaik yang mencetak generasi unggul dan berkarakter untuk masa depan
                    Indonesia.</p>
            </div>

            <div class="footer-col">
                <h4>Menu Cepat</h4>
                <a href="/beranda">Beranda</a>
                <a href="/kalender">Kalender</a>
                <a href="/berita">Berita</a>
                <a href="/lomba">Lomba</a>
            </div>

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

    <script>
        // Search
        let timeout;
        function searchBerita(value) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const url = new URL(window.location.href);
                url.searchParams.set('q', value);
                window.location.href = url.toString();
            }, 500);
        }

        // Popup
        function openBerita(judul, isi, gambar, tanggal, penulis) {
            document.getElementById('popupJudul').innerText = judul;
            document.getElementById('popupIsi').innerText = isi;
            document.getElementById('popupGambar').src = gambar;
            document.getElementById('popupTanggal').innerText = tanggal;
            document.getElementById('popupPenulis').innerText = penulis;
            document.getElementById('popupOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeBerita() {
            document.getElementById('popupOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close popup with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeBerita();
        });
    </script>
</body>

</html>