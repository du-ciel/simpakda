<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fitur - Simpakda</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #475569;
            --card-bg: rgba(255, 255, 255, 0.7);
            --card-border: rgba(255, 255, 255, 0.4);
            --card-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-color: #020617;
                --text-main: #f8fafc;
                --text-muted: #94a3b8;
                --primary-light: #0c4a6e;
                --card-bg: rgba(30, 41, 59, 0.7);
                --card-border: rgba(255, 255, 255, 0.1);
                --card-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }

        /* BACKGROUND ANIMATION */
        .bg-shapes {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: float 20s infinite alternate;
        }
        .shape-1 {
            background-color: rgba(14, 165, 233, 0.4);
            width: 400px; height: 400px;
            top: -100px; left: -100px;
        }
        .shape-2 {
            background-color: rgba(6, 182, 212, 0.3);
            width: 500px; height: 500px;
            bottom: -150px; right: -100px;
            animation-delay: -5s;
        }
        .shape-3 {
            background-color: rgba(99, 102, 241, 0.2);
            width: 300px; height: 300px;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -10s;
        }
        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 50px) scale(1.1); }
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-main);
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }
        .logo-icon {
            width: 32px; height: 32px;
            color: var(--primary);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 14px 0 rgba(2, 132, 199, 0.39);
        }
        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.23);
        }
        .btn-outline {
            background-color: transparent;
            color: var(--text-main);
            border: 2px solid rgba(148, 163, 184, 0.3);
            box-shadow: none;
        }
        .btn-outline:hover {
            background-color: rgba(148, 163, 184, 0.1);
            color: var(--primary);
            box-shadow: none;
        }

        /* PAGE CONTENT */
        .page-content {
            flex: 1;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
            padding: 4rem 5% 6rem;
            display: flex;
            flex-direction: column;
            gap: 5rem;
        }

        /* HEADER SECTION */
        .page-header {
            text-align: center;
            max-width: 680px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            align-items: center;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background-color: var(--primary-light);
            color: var(--primary);
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .page-title {
            font-size: clamp(2.2rem, 4vw, 3.5rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
            color: var(--text-main);
        }
        .title-highlight {
            background: linear-gradient(135deg, #0284c7, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .page-description {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 560px;
        }

        /* FEATURE GRID */
        .features-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        @media (min-width: 768px) {
            .features-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 1024px) {
            .features-grid { grid-template-columns: repeat(4, 1fr); }
        }

        /* FEATURE CARD */
        .feature-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-6px);
        }
        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        .feature-icon.blue   { background: #dbeafe; color: #2563eb; }
        .feature-icon.green  { background: #dcfce7; color: #16a34a; }
        .feature-icon.purple { background: #ede9fe; color: #7c3aed; }
        .feature-icon.amber  { background: #fef3c7; color: #d97706; }
        .feature-icon.rose   { background: #ffe4e6; color: #e11d48; }
        .feature-icon.cyan   { background: #cffafe; color: #0891b2; }

        .feature-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.3;
        }
        .feature-card-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.65;
        }

        /* DETAIL SECTIONS */
        .detail-sections {
            display: flex;
            flex-direction: column;
            gap: 4rem;
        }
        .detail-section {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            align-items: center;
        }
        @media (min-width: 900px) {
            .detail-section {
                flex-direction: row;
                gap: 4rem;
                align-items: flex-start;
            }
            .detail-section.reverse { flex-direction: row-reverse; }
        }

        .detail-visual {
            flex: 1;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            backdrop-filter: blur(20px);
            min-height: 240px;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            align-items: center;
            justify-content: center;
        }
        .mock-header {
            display: flex;
            gap: 6px;
            width: 100%;
        }
        .mock-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
        }
        .mock-body {
            background: var(--bg-color);
            border-radius: 12px;
            height: 180px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .mock-body img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .mock-skeleton {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
            padding: 12px;
        }
        .skel {
            border-radius: 8px;
            background: rgba(0,0,0,0.06);
            animation: shimmer 1.5s infinite alternate;
        }
        @keyframes shimmer {
            0% { opacity: 0.4; }
            100% { opacity: 0.8; }
        }
        @media (prefers-color-scheme: dark) {
            .skel { background: rgba(255,255,255,0.08); }
        }

        .detail-text {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }
        .detail-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--primary);
        }
        .detail-title {
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.5px;
            color: var(--text-main);
        }
        .detail-desc {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.75;
        }
        .detail-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .detail-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.5;
        }
        .check-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #dcfce7;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
            font-size: 0.65rem;
            font-weight: 800;
        }

        /* CTA SECTION */
        .cta-section {
            text-align: center;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 28px;
            padding: 3.5rem 2rem;
            backdrop-filter: blur(20px);
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            align-items: center;
        }
        .cta-title {
            font-size: clamp(1.5rem, 2.5vw, 2.2rem);
            font-weight: 800;
            color: var(--text-main);
        }
        .cta-desc {
            font-size: 1rem;
            color: var(--text-muted);
            max-width: 480px;
            line-height: 1.7;
        }
        .cta-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>
<body>

    <!-- Latar Belakang Abstrak -->
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo-container">
            <img src="{{ asset('images/logo.svg') }}" alt="Simpakda Logo" class="logo-icon" />
            Simpakda
        </a>
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn">Masuk Sistem</a>
                @endauth
            </div>
        @endif
    </nav>

    <!-- PAGE CONTENT -->
    <main class="page-content">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div class="badge">Fitur Aplikasi</div>
            <h1 class="page-title">
                Semua yang Anda Butuhkan,<br>
                <span class="title-highlight">Dalam Satu Sistem</span>
            </h1>
            <p class="page-description">
                Simpakda dirancang untuk memudahkan pengelolaan armada kendaraan bermotor secara menyeluruh — dari data kendaraan, pemantauan pajak, hingga pelaporan anggaran.
            </p>
        </div>

        <!-- FEATURE CARDS GRID -->
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon blue">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                </div>
                <div class="feature-card-title">Dashboard</div>
                <div class="feature-card-desc">Pusat kendali utama yang menampilkan statistik armada secara real-time — total kendaraan, kendaraan aktif, pajak belum bayar, dan STNK belum diperpanjang.</div>
            </div>

            <div class="feature-card">
                <div class="feature-icon green">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                </div>
                <div class="feature-card-title">Monitoring</div>
                <div class="feature-card-desc">Pantau kondisi seluruh armada dalam satu tampilan. Identifikasi kendaraan yang memerlukan perawatan atau perpanjangan dokumen secara cepat.</div>
            </div>

            <div class="feature-card">
                <div class="feature-icon purple">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                </div>
                <div class="feature-card-title">Kendaraan</div>
                <div class="feature-card-desc">Kelola data kendaraan lengkap dengan fitur CRUD — tambah, lihat, edit, dan hapus. Setiap perubahan tercatat dalam histori untuk keperluan audit.</div>
            </div>

            <div class="feature-card">
                <div class="feature-icon amber">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                </div>
                <div class="feature-card-title">Anggaran</div>
                <div class="feature-card-desc">Lihat rincian anggaran biaya dan pajak kendaraan per-unit berdasarkan sumber pendanaan (APBD dan APBN). Semua dalam satu tampilan terstruktur.</div>
            </div>
        </div>

        <!-- DETAIL SECTIONS -->
        <div class="detail-sections">

            <!-- Dashboard -->
            <div class="detail-section">
                <div class="detail-visual">
                    <div class="mock-header">
                        <div class="mock-dot" style="background-color:#ef4444;"></div>
                        <div class="mock-dot" style="background-color:#f59e0b;"></div>
                        <div class="mock-dot" style="background-color:#10b981;"></div>
                    </div>
                    <div class="mock-body">
                        <img src="{{ asset('images/hero-dashboard.png') }}" alt="Dashboard Preview" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                    </div>
                </div>
                <div class="detail-text">
                    <div class="detail-label">Fitur Utama</div>
                    <div class="detail-title">Dashboard<br>Informasi Armada</div>
                    <div class="detail-desc">
                        Dashboard menjadi gerbang utama sistem. Pengguna langsung melihat kondisi armada terkini tanpa perlu membuka menu lainnya.
                    </div>
                    <ul class="detail-list">
                        <li>
                            <span class="check-icon">✓</span>
                            Statistik total, aktif, dan non-aktif kendaraan
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Jumlah pajak dan STNK yang belum dibayarkan
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Progress bar komposisi kendaraan aktif
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Akses cepat ke menu utama aplikasi
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Kendaraan -->
            <div class="detail-section reverse">
                <div class="detail-visual">
                    <div class="mock-header">
                        <div class="mock-dot" style="background-color:#ef4444;"></div>
                        <div class="mock-dot" style="background-color:#f59e0b;"></div>
                        <div class="mock-dot" style="background-color:#10b981;"></div>
                    </div>
                    <div class="mock-body">
                        <img src="{{ asset('images/kendaraan.png') }}" alt="Kendaraan Preview" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                    </div>
                </div>
                <div class="detail-text">
                    <div class="detail-label">Manajemen Data</div>
                    <div class="detail-title">Kelola Data<br>Kendaraan</div>
                    <div class="detail-desc">
                        Menu Kendaraan memungkinkan pencatatan data kendaraan secara menyeluruh, mulai dari spesifikasi teknis hingga informasi biaya dan pajak.
                    </div>
                    <ul class="detail-list">
                        <li>
                            <span class="check-icon">✓</span>
                            Tambah kendaraan baru dengan data lengkap
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Edit dan perbarui informasi kendaraan
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Lacak masa berlaku pajak dan STNK
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Histori perubahan setiap data kendaraan
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Ekspor data ke format PDF
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Monitoring -->
            <div class="detail-section">
                <div class="detail-visual">
                    <div class="mock-header">
                        <div class="mock-dot" style="background-color:#ef4444;"></div>
                        <div class="mock-dot" style="background-color:#f59e0b;"></div>
                        <div class="mock-dot" style="background-color:#10b981;"></div>
                    </div>
                    <div class="mock-body">
                        <img src="{{ asset('images/monitoring.png') }}" alt="Monitoring Preview" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                    </div>
                </div>
                <div class="detail-text">
                    <div class="detail-label">Pemantauan</div>
                    <div class="detail-title">Monitoring<br>Armada</div>
                    <div class="detail-desc">
                        Menu Monitoring menyajikan daftar seluruh kendaraan dengan status terkini, membantu pengguna mengidentifikasi kendaraan yang perlu mendapat perhatian khusus.
                    </div>
                    <ul class="detail-list">
                        <li>
                            <span class="check-icon">✓</span>
                            Daftar kendaraan dengan status visual (aktif, non-aktif, perbaikan)
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Indikator pajak dan STNK jatuh tempo
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Filter berdasarkan kategori dan sumber kendaraan
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Informasi pemakai dan jabatan operasional
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Anggaran -->
            <div class="detail-section reverse">
                <div class="detail-visual">
                    <div class="mock-header">
                        <div class="mock-dot" style="background-color:#ef4444;"></div>
                        <div class="mock-dot" style="background-color:#f59e0b;"></div>
                        <div class="mock-dot" style="background-color:#10b981;"></div>
                    </div>
                    <div class="mock-body">
                        <img src="{{ asset('images/anggaran.png') }}" alt="Anggaran Preview" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                    </div>
                </div>
                <div class="detail-text">
                    <div class="detail-label">Keuangan</div>
                    <div class="detail-title">Anggaran<br>dan Biaya Pajak</div>
                    <div class="detail-desc">
                        Menu Anggaran memberikan pandangan menyeluruh atas seluruh biaya kendaraan — mulai dari anggaran per-unit hingga total keseluruhan berdasarkan sumber dana.
                    </div>
                    <ul class="detail-list">
                        <li>
                            <span class="check-icon">✓</span>
                            Rincian anggaran biaya per kendaraan
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Biaya plat/STNK per kendaraan
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Total anggaran berdasarkan sumber kendaraan (APBD / APBN)
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Status pajak kendaraan (berlaku, expiring, expired)
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Tombol edit langsung ke form kendaraan
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- CTA -->
        <div class="cta-section">
            <div class="cta-title">Siap Mengelola Armada Anda?</div>
            <div class="cta-desc">
                Masuk ke sistem dan mulai mengelola data kendaraan, memantau pajak, serta mengontrol anggaranarmada secara terpusat.
            </div>
            <div class="cta-buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn">Buka Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn">Masuk Sistem</a>
                    <a href="{{ route('home') }}" class="btn btn-outline">Kembali ke Beranda</a>
                @endauth
            </div>
            <div class="cta-desc" style="font-size:0.85rem;color:var(--text-muted);margin-top:0.5rem;">
                <em>Catatan: Akses sistem hanya tersedia untuk pengguna terdaftar.</em>
                <em> By Duciel</em>
        </div>

    </main>

</body>
</html>
