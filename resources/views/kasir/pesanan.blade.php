
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - Kedai Kopi Senja</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #F7EDE5;
            color: #343B64;
        }

        .navbar {
            height: 75px;
            background: #FFFAF6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 45px;
            border-bottom: 1px solid #E8D6C8;
        }

        .brand {
            font-size: 21px;
            font-weight: 700;
        }

        .brand span {
            display: block;
            font-size: 10px;
            letter-spacing: 3px;
            color: #9A8290;
            font-weight: 500;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
        }

        .nav-menu a {
            text-decoration: none;
            color: #777486;
            font-size: 13px;
        }

        .nav-menu a.active {
            color: #343B64;
            font-weight: 700;
            border-bottom: 2px solid #343B64;
            padding-bottom: 7px;
        }

        .user {
            background: #E8D6C8;
            padding: 9px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .container {
            padding: 35px 45px;
        }

        .heading {
            margin-bottom: 25px;
        }

        .heading h1 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .heading p {
            color: #898394;
            font-size: 13px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: #FFFAF6;
            padding: 20px;
            border-radius: 15px;
            border: 1px solid #E8D6C8;
        }

        .stat-card p {
            font-size: 12px;
            color: #898394;
            margin-bottom: 8px;
        }

        .stat-card h2 {
            font-size: 25px;
        }

        .stat-card .symbol {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .content {
            background: #FFFAF6;
            border: 1px solid #E8D6C8;
            border-radius: 18px;
            padding: 25px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
        }

        .content-header h2 {
            font-size: 17px;
        }

        .search {
            width: 260px;
            padding: 11px 14px;
            border: 1px solid #E8D6C8;
            background: white;
            border-radius: 9px;
            outline: none;
            font-size: 12px;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .tab {
            border: 1px solid #E8D6C8;
            background: white;
            color: #777486;
            padding: 8px 17px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
        }

        .tab.active {
            background: #343B64;
            color: white;
            border-color: #343B64;
        }

        .order-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 17px;
        }

        .order-card {
            background: white;
            border: 1px solid #E8D6C8;
            border-radius: 13px;
            padding: 18px;
        }

        .order-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            gap: 8px;
        }

        .order-number {
            font-size: 13px;
            font-weight: 700;
        }

        .status {
            font-size: 10px;
            padding: 5px 9px;
            border-radius: 20px;
            font-weight: 600;
        }

        .status.baru {
            background: #F7EDE5;
            color: #98745D;
        }

        .status.diproses {
            background: #E7E9F3;
            color: #343B64;
        }

        .status.selesai {
            background: #E5EFE9;
            color: #557B65;
        }

        .order-info {
            font-size: 11px;
            color: #898394;
            line-height: 2;
            margin-bottom: 12px;
        }

        .order-items {
            border-top: 1px solid #F0E6DF;
            border-bottom: 1px solid #F0E6DF;
            padding: 12px 0;
            margin-bottom: 12px;
        }

        .order-items p {
            font-size: 11px;
            margin-bottom: 6px;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .actions button {
            flex: 1;
            border: none;
            border-radius: 8px;
            padding: 9px 5px;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        .process {
            background: #343B64;
            color: white;
        }

        .cancel {
            background: #F5E5E2;
            color: #A45E5E;
        }

        .receipt {
            background: #E8D6C8;
            color: #343B64;
        }

        .empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 45px 15px;
            color: #898394;
            font-size: 13px;
        }

        @media(max-width: 1000px) {
            .order-list {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 700px) {
            .navbar {
                height: auto;
                padding: 18px;
                flex-wrap: wrap;
                gap: 15px;
            }

            .nav-menu {
                order: 3;
                width: 100%;
                overflow-x: auto;
                gap: 18px;
            }

            .container {
                padding: 25px 15px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .order-list {
                grid-template-columns: 1fr;
            }

            .content-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .search {
                width: 100%;
            }
        }

        .btn-logout {
            background: #343B64;
            color: #FFFAF6;
            border: none;
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

<nav class="navbar">
    <div class="brand">
        Kedai Kopi Senja
        <span>COFFEE & STORIES</span>
    </div>

    <div class="nav-menu">
        <a href="{{ route('kasir.buat-pesanan') }}">Buat Pesanan</a>
        <a href="{{ route('kasir.pesanan') }}" class="active">Pesanan</a>
        <a href="{{ route('kasir.pelanggan.index') }}">Pelanggan</a>
    </div>
    
    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn-logout">
        Logout
    </button>
    </form>
</nav>

<main class="container">

    <div class="heading">
        <h1>Daftar Pesanan</h1>
        <p>Pantau dan kelola pesanan pelanggan Kedai Kopi Senja.</p>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="symbol">🧾</div>
            <p>Total Pesanan</p>
            <h2>{{ $pesanan->count() }}</h2>
        </div>

        <div class="stat-card">
            <div class="symbol">⏳</div>
            <p>Pesanan Diproses</p>
            <h2>{{ $pesanan->where('status_pesanan', 'Diproses')->count() }}</h2>
        </div>

        <div class="stat-card">
            <div class="symbol">✓</div>
            <p>Pesanan Selesai</p>
            <h2>{{ $pesanan->where('status_pesanan', 'Selesai')->count() }}</h2>
        </div>
    </div>

    <section class="content">

        <div class="content-header">
            <h2>Semua Pesanan</h2>
            <input type="text" class="search" id="searchOrder"
                placeholder="Cari nomor pesanan...">
        </div>

        <div class="tabs">
            <button class="tab active" data-status="Semua">Semua</button>
            <button class="tab" data-status="Baru">Baru</button>
            <button class="tab" data-status="Diproses">Diproses</button>
            <button class="tab" data-status="Selesai">Selesai</button>
        </div>

        <div class="order-list" id="orderList">

            @forelse($pesanan as $item)
                @php
                    $status = $item->status_pesanan;
                    $statusClass = strtolower($status);
                @endphp

                <div class="order-card"
                    data-status="{{ $status }}"
                    data-search="{{ strtolower($item->id_pesanan) }}">

                    <div class="order-top">
                        <span class="order-number">
                            Pesanan #{{ $item->id_pesanan }}
                        </span>

                        <span class="status {{ $statusClass }}">
                            {{ $status }}
                        </span>
                    </div>

                    <div class="order-info">
                        <div>📅 {{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d M Y, H:i') }}</div>
                        <div>👤 {{ $item->pelanggan->nama ?? 'Pelanggan umum' }}</div>
                    </div>

                    <div class="order-items">
                        @foreach($item->detailPesanan as $detail)
                            <p>
                                {{ $detail->menu->nama_menu ?? 'Menu' }}
                                × {{ $detail->jumlah }}
                            </p>
                        @endforeach
                    </div>

                    <div class="order-total">
                        <span>Total</span>
                        <span>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</span>
                    </div>

                    <div class="actions">
                        @if($status === 'Baru')
                            <form action="{{ route('pesanan.status', $item->id_pesanan) }}"
                                method="POST" style="flex:1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status_pesanan" value="Diproses">
                                <button type="submit" class="process" style="width:100%">
                                    Proses
                                </button>
                            </form>

                            <form action="{{ route('pesanan.batal', $item->id_pesanan) }}"
                                method="POST" style="flex:1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cancel" style="width:100%">
                                    Batalkan
                                </button>
                            </form>
                        @elseif($status === 'Diproses')
                            <form action="{{ route('pesanan.status', $item->id_pesanan) }}"
                                method="POST" style="flex:1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status_pesanan" value="Selesai">
                                <button type="submit" class="process" style="width:100%">
                                    Selesaikan
                                </button>
                            </form>
                        @else
                            <a href="{{ route('kasir.pesanan.struk', $item->id_pesanan) }}"
                            class="receipt"
                            style="width:100%; display:block; text-align:center; text-decoration:none; padding:12px; border-radius:8px;">
                                Lihat Struk
                            </a>
                        @endif
                    </div>

                </div>
            @empty
                <div class="empty">
                    Belum ada pesanan.
                </div>
            @endforelse

        </div>

    </section>
</main>

<script>
    let selectedStatus = 'Semua';

    function filterOrders() {
        const keyword = document.getElementById('searchOrder').value.toLowerCase();

        document.querySelectorAll('.order-card').forEach(card => {
            const status = card.dataset.status;
            const search = card.dataset.search;

            const cocokStatus = selectedStatus === 'Semua' || status === selectedStatus;
            const cocokSearch = search.includes(keyword);

            card.style.display = cocokStatus && cocokSearch ? 'block' : 'none';
        });
    }

    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.tab').forEach(item => {
                item.classList.remove('active');
            });

            this.classList.add('active');
            selectedStatus = this.dataset.status;

            filterOrders();
        });
    });

    document.getElementById('searchOrder').addEventListener('input', filterOrders);
</script>

</body>
</html>
