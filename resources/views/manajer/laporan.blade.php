
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Kedai Kopi Senja</title>

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

        body {
            background: var(--cream);
            color: var(--navy);
            font-family: Arial, sans-serif;
            font-size: 14px;
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
            flex-wrap: wrap;
        }

        .nav-link-custom {
            color: var(--muted);
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 10px;
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
        }

        .page-header {
            margin: 32px 0 24px;
        }

        .page-header h2 {
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .page-header p {
            color: var(--muted);
            margin: 0;
        }

        .report-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 17px;
            padding: 23px;
            margin-bottom: 22px;
        }

        .report-title {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .report-desc {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 20px;
            height: 100%;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 8px;
        }

        .stat-value {
            color: var(--navy);
            font-size: 23px;
            font-weight: 700;
        }

        .form-control {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 9px;
            font-size: 13px;
            padding: 10px 12px;
        }

        .form-control:focus {
            border-color: var(--mauve);
            box-shadow: 0 0 0 3px rgba(154,130,144,.12);
        }

        .btn-primary-custom {
            background: var(--navy);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 10px 18px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-primary-custom:hover {
            background: #252B4D;
            color: white;
        }

        .table {
            --bs-table-bg: transparent;
            color: var(--navy);
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table thead th {
            color: var(--muted);
            font-size: 11px;
            font-weight: 600;
            border-bottom: 1px solid var(--border);
            padding: 13px 10px;
            white-space: nowrap;
        }

        .table tbody td {
            border-bottom: 1px solid #F0E5DE;
            padding: 14px 10px;
            font-size: 12px;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .badge-soft {
            background: #F0E2E8;
            color: var(--navy);
            border-radius: 7px;
            padding: 6px 10px;
            font-size: 10px;
        }

        .empty-state {
            color: var(--muted);
            text-align: center;
            padding: 25px !important;
        }

        .section-number {
            display: inline-flex;
            width: 27px;
            height: 27px;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--cream);
            color: var(--navy);
            margin-right: 8px;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .profile {
                display: none;
            }

            .report-card {
                padding: 16px;
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
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <a href="{{ url('/dashboard') }}" class="brand">
            Kedai Kopi Senja
            <small>COFFEE & STORIES</small>
        </a>

        <div class="nav-menu">
            <a href="{{ route('manajer.dashboard') }}" class="nav-link-custom">Dashboard
            <a href="{{ route('stok-masuk.index') }}" class="nav-link-custom">Stok</a>
            <a href="{{ url('/import-data') }}" class="nav-link-custom">Import Data</a>
            <a href="{{ route('laporan.index') }}" class="nav-link-custom active">Laporan</a>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
</div>
    </div>
</nav>

<div class="container pb-5">

    <div class="page-header">
        <h2>Laporan Kedai Kopi Senja</h2>
        <p>Ringkasan penjualan, persediaan bahan, dan keuntungan menu.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- FILTER PERIODE --}}
    <div class="report-card">
        <div class="report-title">Filter Periode Penjualan</div>
        <div class="report-desc">
            Pilih rentang tanggal untuk melihat laporan penjualan.
        </div>

        <form action="{{ route('laporan.index') }}" method="GET">
            <div class="row align-items-end g-3">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai"
                        class="form-control"
                        value="{{ $tanggalMulai }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir"
                        class="form-control"
                        value="{{ $tanggalAkhir }}" required>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary-custom">
                        Tampilkan Laporan
                    </button>
                    <a href="{{ route('laporan.index') }}"
                        class="btn btn-outline-secondary btn-sm ms-1">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-label">Total Transaksi Selesai</div>
                <div class="stat-value">
                    {{ number_format($totalTransaksi, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-label">Total Penjualan Menu</div>
                <div class="stat-value">
                    Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>

    
    <div class="report-card">
        <div class="report-title">
            <span class="section-number">01</span>
            Penjualan per Menu
        </div>
        <div class="report-desc">
            Jumlah menu terjual dan total nilai penjualan pada periode terpilih.
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Jumlah Terjual</th>
                        <th>Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualanMenu as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $item['nama_menu'] }}</td>
                            <td>{{ number_format($item['jumlah_terjual'], 0, ',', '.') }}</td>
                            <td class="fw-semibold">
                                Rp {{ number_format($item['total_penjualan'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">
                                Belum ada penjualan selesai pada periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="report-card">
        <div class="report-title">
            <span class="section-number">02</span>
            Daftar Bahan Menipis
        </div>
        <div class="report-desc">
            Bahan yang stoknya kurang dari atau sama dengan batas minimum.
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Stok Saat Ini</th>
                        <th>Batas Minimum</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bahanMenipis as $index => $bahan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $bahan->nama_bahan }}</td>
                            <td>
                                {{ number_format((float)$bahan->stok, 2, ',', '.') }}
                                {{ $bahan->satuan_dasar }}
                            </td>
                            <td>
                                {{ number_format((float)$bahan->batas_min, 2, ',', '.') }}
                                {{ $bahan->satuan_dasar }}
                            </td>
                            <td><span class="badge-soft">Perlu Restok</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                Semua stok bahan berada di atas batas minimum.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="report-card">
        <div class="report-title">
            <span class="section-number">03</span>
            HPP dan Margin per Menu
        </div>
        <div class="report-desc">
            HPP dihitung dari total takaran bahan pada resep dikalikan harga bahan per satuan dasar.
            Margin merupakan harga jual dikurangi HPP.
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Jumlah Bahan</th>
                        <th>Harga Jual</th>
                        <th>HPP</th>
                        <th>Margin</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporanMargin as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $item['nama_menu'] }}</td>
                            <td>{{ $item['jumlah_bahan'] }} bahan</td>
                            <td>Rp {{ number_format($item['harga_jual'], 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item['hpp'], 0, ',', '.') }}</td>
                            <td class="fw-semibold">
                                Rp {{ number_format($item['margin'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                Belum ada data menu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center text-muted small mt-4">
        Kedai Kopi Senja · Laporan Manajer
    </div>

</div>

</body>
</html>
