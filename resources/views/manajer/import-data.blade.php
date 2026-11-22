
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data - Kedai Kopi Senja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            background: var(--cream);
            color: var(--navy);
            font-family: Arial, sans-serif;
            min-height: 100vh;
        }

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

        .page-content {
            padding: 35px 0 55px;
        }

        .page-title {
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 28px;
        }

        .import-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 17px;
            padding: 25px;
            height: 100%;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            background: var(--cream);
            color: var(--navy);
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            margin-bottom: 18px;
        }

        .import-card h5 {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .import-card p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
            min-height: 42px;
        }

        .form-label {
            color: var(--navy);
            font-size: 12px;
            font-weight: 600;
        }

        .form-control {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 9px;
            font-size: 12px;
            padding: 11px;
        }

        .form-control:focus {
            border-color: var(--mauve);
            box-shadow: 0 0 0 3px rgba(154, 130, 144, .12);
        }

        .btn-import {
            background: var(--navy);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 11px 17px;
            font-size: 12px;
            font-weight: 600;
            width: 100%;
            margin-top: 15px;
        }

        .btn-import:hover {
            background: #252B50;
            color: white;
        }

        .info-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 22px;
            margin-top: 25px;
        }

        .info-card h6 {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .info-card li {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .alert {
            border-radius: 12px;
            font-size: 12px;
        }

        .result-number {
            font-size: 22px;
            font-weight: 700;
            color: var(--navy);
        }

        .result-label {
            font-size: 11px;
            color: var(--muted);
        }

        .back-link {
            display: inline-block;
            color: var(--muted);
            text-decoration: none;
            font-size: 12px;
            margin-bottom: 18px;
        }

        .back-link:hover {
            color: var(--navy);
        }

        @media (max-width: 768px) {
            .navbar-custom .container {
                flex-wrap: wrap;
                gap: 14px;
            }

            .nav-menu {
                order: 3;
                width: 100%;
                overflow-x: auto;
            }

            .profile {
                margin-left: auto;
            }
        }

        .btn-logout {
            background: #343B64;
            color: #FFFAF6;
            border: 1px solid #343B64;
            border-radius: 10px;
            padding: 9px 17px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-logout:hover {
            background: #252B4D;
            color: #FFFFFF;
        }
    </style>
</head>

<body>

<nav class="navbar-custom">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ route('manajer.dashboard') }}" class="brand">
            Kedai Kopi Senja
            <small>COFFEE & STORIES</small>
        </a>

        <div class="nav-menu">
            <a href="{{ route('manajer.dashboard') }}" class="nav-link-custom">
                Dashboard
            </a>

            <a href="{{ route('stok-masuk.index') }}" class="nav-link-custom">
                Stok
            </a>

            <a href="{{ route('import-data.index') }}" class="nav-link-custom active">
                Import Data
            </a>

            <a href="{{ route('laporan.index') }}" class="nav-link-custom">
                Laporan
            </a>
        </div>


        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
            </form>
</div>
</nav>

<div class="container page-content">


    <h2 class="page-title">Import Data</h2>
    <p class="page-subtitle">
        Tambahkan atau perbarui data menu, bahan, dan resep melalui file CSV.
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if(session('hasil_import'))
        @php($hasil = session('hasil_import'))

        <div class="alert alert-info">
            <strong>Hasil Import {{ $hasil['jenis'] }}</strong>

            <div class="row mt-3">
                <div class="col-6">
                    <div class="result-number">{{ $hasil['berhasil'] }}</div>
                    <div class="result-label">Berhasil diproses</div>
                </div>

                <div class="col-6">
                    <div class="result-number">{{ $hasil['dilewati'] }}</div>
                    <div class="result-label">Dilewati / gagal</div>
                </div>
            </div>

            @if(count($hasil['errors']) > 0)
                <hr>
                <strong>Catatan baris:</strong>
                <ul class="mt-2 mb-0">
                    @foreach($hasil['errors'] as $catatan)
                        <li>{{ $catatan }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-4 col-md-6">
            <div class="import-card">
                <div class="icon-box">☕</div>

                <h5>Import Menu</h5>
                <p>
                    Import data menu beserta kode, nama, kategori, dan harga jual.
                </p>

                <form action="{{ route('import-data.import') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="jenis" value="menu">

                    <label class="form-label">Pilih file CSV</label>
                    <input type="file"
                           name="file"
                           class="form-control"
                           accept=".csv,text/csv"
                           required>

                    <button type="submit" class="btn btn-import">
                        Import Menu
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="import-card">
                <div class="icon-box">📦</div>

                <h5>Import Bahan</h5>
                <p>
                    Import bahan, stok awal, satuan, serta harga per satuan.
                </p>

                <form action="{{ route('import-data.import') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="jenis" value="bahan">

                    <label class="form-label">Pilih file CSV</label>
                    <input type="file"
                           name="file"
                           class="form-control"
                           accept=".csv,text/csv"
                           required>

                    <button type="submit" class="btn btn-import">
                        Import Bahan
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="import-card">
                <div class="icon-box">📖</div>

                <h5>Import Resep</h5>
                <p>
                    Import komposisi bahan dan takaran berdasarkan kode menu.
                </p>

                <form action="{{ route('import-data.import') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="jenis" value="resep">

                    <label class="form-label">Pilih file CSV</label>
                    <input type="file"
                           name="file"
                           class="form-control"
                           accept=".csv,text/csv"
                           required>

                    <button type="submit" class="btn btn-import">
                        Import Resep
                    </button>
                </form>
            </div>
        </div>

    </div>

    <div class="info-card">
        <h6>Petunjuk Import Data</h6>
        <ul class="mb-0">
            <li>Gunakan file CSV sesuai format data awal Kedai Kopi Senja.</li>
            <li>Import Menu dan Bahan terlebih dahulu sebelum Import Resep.</li>
            <li>Kategori menu harus sudah tersedia di database.</li>
            <li>Satuan kg dan liter akan dikonversi menjadi gram dan mililiter.</li>
            <li>Data yang tidak valid atau bahan yang tidak terdaftar akan dilewati dan dilaporkan.</li>
            <li>Import tidak menghapus riwayat pesanan, pelanggan, atau data stok masuk.</li>
        </ul>
    </div>

</div>

</body>
</html>
