<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok | Kedai Kopi Senja</title>

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

        /* NAVBAR - SAMA DENGAN DASHBOARD */
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

        .page-heading {
            margin-bottom: 28px;
        }

        .page-label {
            color: var(--mauve);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .page-heading h1 {
            color: var(--navy);
            font-size: 25px;
            font-weight: 700;
            margin: 10px 0 8px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 12px;
            margin: 0;
            line-height: 1.8;
        }

        /* CARD */
        .content-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 25px;
            height: 100%;
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 23px;
        }

        .heading-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--cream);
            color: var(--navy);
            border-radius: 12px;
            font-size: 19px;
        }

        .card-heading h5 {
            color: var(--navy);
            font-size: 14px;
            font-weight: 700;
            margin: 0;
        }

        .card-heading p {
            color: var(--muted);
            font-size: 10px;
            margin: 4px 0 0;
        }

        /* FORM */
        .form-label {
            color: var(--navy);
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            background: #FFFFFF;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 11px 13px;
            color: var(--navy);
            font-family: 'Poppins', sans-serif;
            font-size: 11px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--mauve);
            box-shadow: 0 0 0 3px rgba(154,130,144,.12);
        }

        .btn-save {
            width: 100%;
            border: none;
            border-radius: 10px;
            background: var(--navy);
            color: white;
            padding: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 11px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-save:hover {
            background: #4B5685;
            color: white;
        }

        .info-note {
            background: var(--cream);
            color: var(--muted);
            border-radius: 10px;
            padding: 13px;
            font-size: 10px;
            line-height: 1.8;
            margin-top: 20px;
        }

        .info-note strong {
            color: var(--navy);
        }

        /* TABLE */
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table thead th {
            background: var(--cream);
            color: var(--navy);
            border: none;
            padding: 13px 12px;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        .table thead th:first-child {
            border-radius: 9px 0 0 9px;
        }

        .table thead th:last-child {
            border-radius: 0 9px 9px 0;
        }

        .table tbody td {
            color: var(--navy);
            border-bottom: 1px solid var(--border);
            padding: 14px 12px;
            font-size: 11px;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .stock-badge {
            display: inline-block;
            background: #E9EEE9;
            color: #648675;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        .empty-state {
            text-align: center;
            padding: 40px 15px !important;
            color: var(--muted) !important;
        }

        .empty-icon {
            display: block;
            font-size: 27px;
            margin-bottom: 10px;
        }

        .alert {
            border: none;
            border-radius: 12px;
            font-size: 11px;
        }

        @media (max-width: 768px) {
            .navbar-custom {
                padding: 15px 0;
            }

            .navbar-custom .container {
                flex-wrap: wrap;
                gap: 14px;
            }

            .nav-menu {
                width: 100%;
                order: 3;
                flex-wrap: wrap;
            }

            .nav-link-custom {
                padding: 8px 12px;
                font-size: 11px;
            }

            .main-content {
                padding: 25px 15px 35px;
            }

            .content-card {
                padding: 19px;
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
                <a href="{{ route('manajer.dashboard') }}"
                   class="nav-link-custom">
                    Dashboard
                </a>

                <a href="{{ route('stok-masuk.index') }}"
                   class="nav-link-custom active">
                    Stok
                </a>

                <a href="{{ url('/import-data') }}" 
                    class="nav-link-custom">
                    Import Data
                </a>

                <a href="{{ route('laporan.index') }}"
                   class="nav-link-custom">
                    Laporan
                </a>
            </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>

        </div>
    </nav>

    
    <main class="main-content">

        <div class="page-heading">
            <h1>Stok Bahan</h1>
            <p>Catat pembelian bahan dan pantau riwayat penambahan stok Kedai Kopi Senja.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Data belum berhasil disimpan.</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">

            
            <div class="col-lg-4">
                <div class="content-card">

                    <div class="card-heading">
                        <div class="heading-icon">＋</div>
                        <div>
                            <h5>Catat Pembelian</h5>
                            <p>Masukkan bahan yang baru dibeli</p>
                        </div>
                    </div>

                    <form action="{{ route('stok-masuk.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pembelian</label>
                            <input
                                type="date"
                                name="tanggal_masuk"
                                class="form-control"
                                value="{{ old('tanggal_masuk', date('Y-m-d')) }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih Bahan</label>
                            <select name="id_bahan" class="form-select" required>
                                <option value="">-- Pilih bahan --</option>
                                @foreach($bahan as $item)
                                    <option
                                        value="{{ $item->id_bahan }}"
                                        {{ old('id_bahan') == $item->id_bahan ? 'selected' : '' }}
                                    >
                                        {{ $item->nama_bahan }} ({{ $item->satuan_dasar }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Jumlah Pembelian</label>
                            <input
                                type="number"
                                name="jumlah"
                                class="form-control"
                                step="0.01"
                                min="0.01"
                                placeholder="Masukkan jumlah bahan"
                                value="{{ old('jumlah') }}"
                                required
                            >
                            <small class="text-muted d-block mt-2" style="font-size:10px;">
                                Gunakan satuan dasar bahan yang dipilih.
                            </small>
                        </div>

                        <button type="submit" class="btn-save">
                            Simpan Pembelian
                        </button>
                    </form>

                    <div class="info-note">
                        <strong>Informasi</strong><br>
                        Setelah pembelian disimpan, jumlah stok bahan akan otomatis bertambah.
                    </div>

                </div>
            </div>

            
            <div class="col-lg-8">
                <div class="content-card">

                    <div class="card-heading">
                        <div class="heading-icon">▤</div>
                        <div>
                            <h5>Riwayat Pembelian Bahan</h5>
                            <p>Daftar transaksi stok masuk yang telah dicatat</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Bahan</th>
                                    <th>Jumlah Masuk</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $nomor = 1; @endphp

                                @forelse($stokMasuk as $transaksi)
                                    @foreach($transaksi->detailStokMasuk as $detail)
                                        <tr>
                                            <td>{{ $nomor++ }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <strong>{{ $detail->bahan->nama_bahan ?? 'Bahan tidak ditemukan' }}</strong>
                                            </td>
                                            <td>
                                                <span class="stock-badge">
                                                    +{{ number_format((float) $detail->jumlah, 2, ',', '.') }}
                                                    {{ $detail->bahan->satuan_dasar ?? '' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="4" class="empty-state">
                                            <span class="empty-icon">▤</span>
                                            Belum ada riwayat pembelian bahan.
                                        </td>
                                    </tr>
                                @endforelse

                                @if($stokMasuk->isNotEmpty() && $nomor === 1)
                                    <tr>
                                        <td colspan="4" class="empty-state">
                                            Belum ada detail pembelian bahan.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </main>

</body>
</html>
