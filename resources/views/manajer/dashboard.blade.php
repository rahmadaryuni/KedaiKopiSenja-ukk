
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajer | Kedai Kopi Senja</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #F7EDE5;
            --card: #FFFAF6;
            --border: #E8D6C8;
            --navy: #343B64;
            --muted: #898394;
            --mauve: #9A8290;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--navy);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar-custom {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 15px 0;
        }

        .brand {
            color: var(--navy);
            text-decoration: none;
            font-size: 19px;
            font-weight: 700;
            line-height: 1.3;
        }

        .brand small {
            display: block;
            color: var(--muted);
            font-size: 9px;
            font-weight: 500;
            letter-spacing: 2px;
            margin-top: 3px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-link-custom {
            color: var(--muted);
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 10px;
            transition: .2s;
            white-space: nowrap;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            color: var(--navy);
            background: var(--cream);
        }

        .profile {
            background: var(--cream);
            color: var(--navy);
            border-radius: 10px;
            padding: 9px 14px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* MAIN */
        .main-content {
            max-width: 1200px;
            margin: auto;
            padding: 35px 22px 45px;
        }

        /* WELCOME */
        .welcome-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .welcome-label {
            color: var(--mauve);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .welcome-card h1 {
            color: var(--navy);
            font-size: 25px;
            font-weight: 700;
            margin: 10px 0 8px;
        }

        .welcome-card p {
            color: var(--muted);
            font-size: 12px;
            margin: 0;
            line-height: 1.8;
        }

        /* SECTION */
        .section-title {
            color: var(--navy);
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 17px;
        }

        /* STAT CARD */
        .stat-card {
            height: 100%;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 17px;
            padding: 22px;
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(52, 59, 100, .06);
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--cream);
            border-radius: 13px;
            font-size: 19px;
            margin-bottom: 17px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 8px;
        }

        .stat-value {
            color: var(--navy);
            font-size: 22px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        /* SHORTCUT */
        .shortcut-card {
            display: flex;
            align-items: center;
            gap: 15px;
            height: 100%;
            min-height: 100px;
            padding: 19px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            text-decoration: none;
            color: var(--navy);
            transition: .2s;
        }

        .shortcut-card:hover {
            transform: translateY(-3px);
            border-color: var(--mauve);
            box-shadow: 0 8px 20px rgba(52, 59, 100, .06);
        }

        .shortcut-icon {
            flex-shrink: 0;
            width: 47px;
            height: 47px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--cream);
            border-radius: 14px;
            font-size: 21px;
        }

        .shortcut-info {
            flex: 1;
            min-width: 0;
        }

        .shortcut-info h3 {
            color: var(--navy);
            font-size: 13px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .shortcut-info p {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
            margin: 0;
        }

        .shortcut-arrow {
            color: var(--muted);
            font-size: 21px;
        }

        /* FOOTER */
        .footer {
            color: var(--muted);
            text-align: center;
            font-size: 10px;
            padding-top: 35px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar-custom .container {
                flex-wrap: wrap;
                gap: 12px;
            }

            .nav-menu {
                order: 3;
                width: 100%;
                overflow-x: auto;
                padding-top: 5px;
            }

            .main-content {
                padding: 25px 15px 35px;
            }

            .welcome-card {
                padding: 23px;
            }

            .welcome-card h1 {
                font-size: 21px;
            }

            .stat-card {
                padding: 17px;
            }

            .stat-value {
                font-size: 18px;
            }

            .shortcut-card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    
//navbar
<nav class="navbar-custom">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{ route('manajer.dashboard') }}" class="brand">
            Kedai Kopi Senja
            <small>COFFEE & STORIES</small>
        </a>

        <div class="nav-menu">
            <a href="{{ route('manajer.dashboard') }}"
               class="nav-link-custom active">
                Dashboard
            </a>

            <a href="{{ route('stok-masuk.index') }}"
               class="nav-link-custom">
                Stok
            </a>

            <a href="{{ route('import-data.index') }}"
               class="nav-link-custom">
                Import Data
            </a>

            <a href="{{ route('laporan.index') }}"
               class="nav-link-custom">
                Laporan
            </a>
        </div>

        <div class="profile">
            ✦ Manajer
        </div>

    </div>
</nav>



    
    <main class="main-content">

        
        <section class="welcome-card">
            <div class="welcome-label">
                Panel Manajemen
            </div>

            <h1>Selamat Datang, Manajer!</h1>

            <p>
                Pantau aktivitas dan kelola operasional
                Kedai Kopi Senja melalui dashboard ini.
            </p>
        </section>


        <section class="mb-5">

            <h2 class="section-title">
                Ringkasan Kedai Hari Ini
            </h2>

            <div class="row g-3">

                //penjualan
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">💰</div>

                        <div class="stat-label">
                            Penjualan Hari Ini
                        </div>

                        <div class="stat-value">
                            Rp {{ number_format($penjualan, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                //pesanan
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">🧾</div>

                        <div class="stat-label">
                            Pesanan Hari Ini
                        </div>

                        <div class="stat-value">
                            {{ number_format($jumlahPesanan, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                //menu
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">☕</div>

                        <div class="stat-label">
                            Total Menu
                        </div>

                        <div class="stat-value">
                            {{ number_format($jumlahMenu, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                //bahan
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">📦</div>

                        <div class="stat-label">
                            Total Bahan
                        </div>

                        <div class="stat-value">
                            {{ number_format($jumlahBahan, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

            </div>
        </section>


        
        <section>

            <h2 class="section-title">
                Pengelolaan Kedai
            </h2>

            <div class="row g-3">

                //kelola menu
                <div class="col-12 col-md-6">
                    <a href="{{ route('menu.index') }}"
                       class="shortcut-card">

                        <div class="shortcut-icon">☕</div>

                        <div class="shortcut-info">
                            <h3>Kelola Menu</h3>
                            <p>
                                Tambah, ubah, hapus, dan import data menu.
                            </p>
                        </div>

                        <span class="shortcut-arrow">›</span>
                    </a>
                </div>

                //kelola bahan
                <div class="col-12 col-md-6">
                    <a href="{{ route('bahan.index') }}"
                       class="shortcut-card">

                        <div class="shortcut-icon">📦</div>

                        <div class="shortcut-info">
                            <h3>Kelola Bahan</h3>
                            <p>
                                Atur data bahan, stok, dan harga bahan.
                            </p>
                        </div>

                        <span class="shortcut-arrow">›</span>
                    </a>
                </div>

                //kelola resep
                <div class="col-12 col-md-6">
                    <a href="{{ route('resep.index') }}"
                       class="shortcut-card">

                        <div class="shortcut-icon">📖</div>

                        <div class="shortcut-info">
                            <h3>Kelola Resep</h3>
                            <p>
                                Atur komposisi bahan untuk setiap menu.
                            </p>
                        </div>

                        <span class="shortcut-arrow">›</span>
                    </a>
                </div>
            </div>
        </section>


        
        <footer class="footer">
            © {{ date('Y') }} Kedai Kopi Senja · COFFEE & STORIES
        </footer>

    </main>

</body>
</html>
