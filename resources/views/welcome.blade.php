<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simpakda - Sistem Informasi Pajak Kendaraan Bermotor</title>
    
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    <!-- Gunakan Google Fonts agar tipografi langsung cantik -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS KUSTOM MURNI (Dijamin bebas error/bentrok) -->
    <style>
        :root {
            --primary: #0284c7;      /* sky-600 */
            --primary-dark: #0369a1; /* sky-700 */
            --primary-light: #e0f2fe;/* sky-100 */
            --bg-color: #f8fafc;     /* slate-50 */
            --text-main: #0f172a;    /* slate-900 */
            --text-muted: #475569;   /* slate-600 */
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-color: #020617;     /* slate-950 */
                --text-main: #f8fafc;    /* slate-50 */
                --text-muted: #94a3b8;   /* slate-400 */
                --primary-light: #0c4a6e;/* sky-900 */
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

        /* --- BACKGROUND ANIMATION --- */
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
            background-color: rgba(14, 165, 233, 0.4); /* sky-500 */
            width: 400px; height: 400px;
            top: -100px; left: -100px;
        }
        .shape-2 {
            background-color: rgba(6, 182, 212, 0.3); /* cyan-500 */
            width: 500px; height: 500px;
            bottom: -150px; right: -100px;
            animation-delay: -5s;
        }
        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 50px) scale(1.1); }
        }

        /* --- NAVBAR --- */
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

        /* --- HERO SECTION --- */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 5%;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
            gap: 4rem;
        }

        @media (min-width: 992px) {
            .hero {
                flex-direction: row;
                text-align: left;
                justify-content: space-between;
                padding: 2rem 5%;
            }
        }

        .hero-text {
            flex: 1;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            text-align: center;
        }

        @media (min-width: 992px) {
            .hero-text {
                text-align: left;
                align-items: flex-start;
            }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background-color: var(--primary-light);
            color: var(--primary);
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 auto;
            width: fit-content;
        }

        @media (min-width: 992px) {
            .badge { margin: 0; }
        }

        .badge-dot {
            width: 8px; height: 8px;
            background-color: var(--primary);
            border-radius: 50%;
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
        @keyframes ping {
            75%, 100% { transform: scale(2); opacity: 0; }
        }

        .title {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .title-highlight {
            background: linear-gradient(135deg, #0284c7, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .description {
            font-size: 1.15rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
        }

        @media (min-width: 992px) {
            .action-buttons { justify-content: flex-start; }
        }

        /* --- MOCKUP IMAGE (Kanan) --- */
        .hero-visual {
            flex: 1;
            width: 100%;
            display: flex;
            justify-content: center;
            position: relative;
        }

        @media (min-width: 992px) {
            .hero-visual {
                justify-content: flex-end;
            }
        }

        .mockup-container {
            width: 100%;
            max-width: 550px;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            padding: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(20px);
            position: relative;
            transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
            transition: transform 0.5s ease;
        }

        .mockup-container:hover {
            transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
        }

        @media (prefers-color-scheme: dark) {
            .mockup-container {
                background: rgba(30, 41, 59, 0.7);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }
        }

        .mockup-header {
            display: flex;
            gap: 6px;
            padding: 0 8px 12px 8px;
        }

        .dot {
            width: 12px; height: 12px;
            border-radius: 50%;
        }

        .mockup-body {
            background-color: var(--bg-color);
            border-radius: 12px;
            height: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(0,0,0,0.05);
            color: var(--text-muted);
            overflow: hidden;
        }
        
        .mockup-body img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <!-- Latar Belakang Abstrak -->
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar">
        <!-- 1. TEMPAT LOGO -->
        <a href="{{ route('home') }}" class="logo-container">
            <!-- Ganti <svg> ini dengan <img> logo Anda -->
             <img src="{{ asset('images/logo.svg') }}" alt="Simpakda Logo" class="logo-icon" />
            Simpakda
        </a>

        <!-- 2. TOMBOL MASUK -->
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

    <!-- HERO SECTION -->
    <main class="hero">
        
        <!-- Sisi Kiri (Teks) -->
        <div class="hero-text">
            <div class="badge">
                <div class="badge-dot"></div>
                Sistem Armada v1.0
            </div>
            
            <h1 class="title">
                Kelola Pajak <br>
                <span class="title-highlight">Kendaraan Anda</span>
            </h1>
            
            <p class="description">
                Solusi cerdas untuk memantau data armada, memonitor operasional, serta mendapatkan peringatan jatuh tempo pajak dan STNK secara otomatis dalam satu sistem terpadu.
            </p>
            
            <div class="action-buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn">Buka Dashboard &rarr;</a>
                @else
                    <a href="{{ route('login') }}" class="btn">Mulai Gunakan</a>
                    <a href="{{ route('fitur') }}" class="btn btn-outline">Pelajari Fitur</a>
                @endauth
            </div>
        </div>

        <!-- Sisi Kanan (Mockup / Hero Image) -->
        <div class="hero-visual">
            <div class="mockup-container">
                <div class="mockup-header">
                    <div class="dot" style="background-color: #ef4444;"></div>
                    <div class="dot" style="background-color: #f59e0b;"></div>
                    <div class="dot" style="background-color: #10b981;"></div>
                </div>
                
                <!-- 3. TEMPAT HERO IMAGE -->
                <div class="mockup-body">
                    <!-- 
                        HAPUS SVG di bawah ini, lalu aktifkan tag <img src="..."> 
                        sesuai dengan path gambar dashboard Anda 
                    -->
                    
                    <img src="{{ asset('images/hero-dashboard.png') }}" alt="Dashboard Preview">
                </div>
            </div>
        </div>

    </main>

</body>
</html>