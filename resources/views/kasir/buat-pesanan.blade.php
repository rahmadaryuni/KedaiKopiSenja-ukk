<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan - Kedai Kopi Senja</title>
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
            background: #fffaf6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 45px;
            border-bottom: 1px solid #E8D6C8;
        }
        .brand {
            font-size: 21px;
            font-weight: 700;
            color: #343B64;
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
            align-items: center;
        }
        .nav-menu a {
            text-decoration: none;
            color: #777486;
            font-size: 13px;
            font-weight: 500;
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
            font-size: 13px;
            color: #898394;
        }
        .content {
            display: grid;
            grid-template-columns: 1fr 370px;
            gap: 25px;
            align-items: start;
        }
        .menu-area {
            background: #fffaf6;
            border-radius: 18px;
            padding: 25px;
            border: 1px solid #E8D6C8;
        }
        .search {
            width: 100%;
            padding: 13px 17px;
            border: 1px solid #E8D6C8;
            background: #fff;
            border-radius: 10px;
            outline: none;
            font-size: 13px;
            margin-bottom: 20px;
        }
        .search:focus {
            border-color: #343B64;
        }
        .categories {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }
        .category {
            border: 1px solid #E8D6C8;
            background: #fff;
            color: #777486;
            padding: 8px 17px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
        }
        .category.active,
        .category:hover {
            background: #343B64;
            color: white;
            border-color: #343B64;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
        }
        .menu-card {
            background: #fff;
            border: 1px solid #E8D6C8;
            border-radius: 14px;
            padding: 19px;
            min-height: 125px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: .2s;
        }
        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 18px #343b6412;
        }
        .menu-card h3 {
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 6px;
        }
        .menu-card .category-name {
            font-size: 11px;
            color: #9A8290;
            margin-bottom: 14px;
        }
        .menu-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-top: auto;
        }
        .price {
            font-size: 12px;
            font-weight: 700;
        }
        .add-btn {
            background: #343B64;
            color: white;
            border: none;
            padding: 7px 11px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 11px;
        }
        .add-btn:hover {
            background: #515982;
        }
        .add-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        .empty-menu {
            color: #898394;
            font-size: 13px;
            padding: 20px 0;
        }
        .cart {
            background: #fffaf6;
            border: 1px solid #E8D6C8;
            border-radius: 18px;
            padding: 23px;
            position: sticky;
            top: 20px;
        }
        .cart-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }
        .cart-title h2 {
            font-size: 18px;
        }
        .cart-count {
            background: #E8D6C8;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 7px;
        }
        .field select {
            width: 100%;
            padding: 11px;
            border: 1px solid #E8D6C8;
            background: white;
            border-radius: 9px;
            outline: none;
            color: #343B64;
            font-size: 12px;
        }
        .cart-items {
            border-top: 1px solid #E8D6C8;
            border-bottom: 1px solid #E8D6C8;
            padding: 15px 0;
            margin: 17px 0;
            min-height: 100px;
        }
        .empty-cart {
            text-align: center;
            color: #aaa0a7;
            font-size: 12px;
            padding: 25px 0;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        .cart-item:last-child {
            margin-bottom: 0;
        }
        .item-info h4 {
            font-size: 11px;
            margin-bottom: 4px;
        }
        .item-info p {
            font-size: 10px;
            color: #918895;
        }
        .quantity {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .quantity button {
            width: 23px;
            height: 23px;
            border: none;
            border-radius: 6px;
            background: #E8D6C8;
            color: #343B64;
            cursor: pointer;
        }
        .quantity span {
            font-size: 11px;
            font-weight: 600;
        }
        .summary {
            margin-top: 15px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 11px;
            color: #777486;
        }
        .summary-row.total {
            border-top: 1px solid #E8D6C8;
            padding-top: 14px;
            margin-top: 13px;
            color: #343B64;
            font-size: 15px;
            font-weight: 700;
        }
        .submit-btn {
            width: 100%;
            border: none;
            background: #343B64;
            color: white;
            padding: 14px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }
        .submit-btn:hover {
            background: #515982;
        }
        .submit-btn:disabled {
            opacity: .5;
            cursor: not-allowed;
        }
        @media(max-width: 1000px) {
            .content {
                grid-template-columns: 1fr;
            }
            .cart {
                position: static;
            }
        }
        @media(max-width: 650px) {
            .navbar {
                padding: 15px 20px;
                height: auto;
                flex-wrap: wrap;
                gap: 15px;
            }
            .nav-menu {
                order: 3;
                width: 100%;
                gap: 15px;
                overflow-x: auto;
            }
            .container {
                padding: 25px 15px;
            }
            .menu-area {
                padding: 15px;
            }
            .menu-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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
        <a href="{{ route('kasir.buat-pesanan') }}" class="active">Buat Pesanan</a>
        <a href="{{ route('kasir.pesanan') }}">Pesanan</a>
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
        <h1>Buat Pesanan</h1>
        <p>Pilih menu dan buat pesanan pelanggan dengan mudah.</p>
    </div>
    <div class="content">
        <section class="menu-area">
            <input type="text" id="searchMenu" class="search"
                placeholder="Cari nama menu...">
            <div class="categories">
                <button class="category active" data-category="semua">Semua</button>
                @foreach($menu->pluck('kategori.nama_kategori')->filter()->unique() as $kategori)
                    <button class="category" data-category="{{ strtolower($kategori) }}">
                        {{ $kategori }}
                    </button>
                @endforeach
            </div>

            <div class="menu-grid" id="menuGrid">
                @forelse($menu as $item)
                    @php
                        $kategori = $item->kategori->nama_kategori ?? 'Lainnya';

                        $aktif = $item->status_menu === 'Tersedia';
                        $stokCukup = $item->status_stok === 'Tersedia';

                        $tersedia = $aktif && $stokCukup;

                        if (!$aktif) {
                            $labelStatus = 'Nonaktif';
                        } elseif (!$stokCukup) {
                            $labelStatus = 'Habis';
                        } else {
                            $labelStatus = '+ Tambah';
                        }
                    @endphp
                    <div class="menu-card"
                        data-name="{{ strtolower($item->nama_menu) }}"
                        data-category="{{ strtolower($kategori) }}">
                        <h3>{{ $item->nama_menu }}</h3>
                        <p class="category-name">{{ $kategori }}</p>
                        <div class="menu-bottom">
                            <span class="price">
                                Rp{{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                            <button class="add-btn"
                                type="button"
                                {{ !$tersedia ? 'disabled' : '' }}
                                onclick="addToCart(
                                    {{ $item->id_menu }},
                                    @js($item->nama_menu),
                                    {{ $item->harga }}
                                )">
                                {{ $tersedia ? '+ Tambah' : 'Habis' }}
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="empty-menu">Belum ada menu yang tersedia.</p>
                @endforelse
            </div>
        </section>

        <aside class="cart">
            <div class="cart-title">
                <h2>Pesanan Baru</h2>
                <span class="cart-count" id="cartCount">0 item</span>
            </div>
            <form action="{{ route('pesanan.store') }}" method="POST" id="orderForm">
                @csrf
                <div class="field">
                    <label>Nomor Meja</label>
                    <select name="nomor_meja" id="nomorMeja" required>
                        <option value="">Pilih meja</option>
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">Meja {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="field">
                    <label>Metode Pembayaran</label>
                    <select name="metode_pembayaran" required>
                        <option value="">Pilih pembayaran</option>
                        <option value="Tunai">Tunai</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>
                <div class="cart-items" id="cartItems">
                    <div class="empty-cart">
                        Belum ada menu dipilih.
                    </div>
                </div>
                <div id="hiddenDetails"></div>
                <div class="summary">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="subtotal">Rp0</span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya layanan (5%)</span>
                        <span id="service">Rp0</span>
                    </div>
                    <div class="summary-row">
                        <span>Pajak (10%)</span>
                        <span id="tax">Rp0</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="total">Rp0</span>
                    </div>
                </div>
                <button type="submit" class="submit-btn" id="submitBtn" disabled>
                    Buat Pesanan
                </button>
            </form>
        </aside>
    </div>
</main>

<script>
    let cart = [];

    function rupiah(number) {
        return 'Rp' + Number(number).toLocaleString('id-ID');
    }

    function addToCart(id, nama, harga) {
        let item = cart.find(product => product.id === id);

        if (item) {
            item.jumlah++;
        } else {
            cart.push({
                id: id,
                nama: nama,
                harga: Number(harga),
                jumlah: 1
            });
        }

        renderCart();
    }

    function changeQuantity(id, change) {
        let item = cart.find(product => product.id === id);

        if (!item) return;

        item.jumlah += change;

        if (item.jumlah <= 0) {
            cart = cart.filter(product => product.id !== id);
        }

        renderCart();
    }

    function renderCart() {
        const cartItems = document.getElementById('cartItems');
        const hiddenDetails = document.getElementById('hiddenDetails');

        cartItems.innerHTML = '';
        hiddenDetails.innerHTML = '';

        let subtotal = 0;
        let totalItem = 0;

        if (cart.length === 0) {
            cartItems.innerHTML = `
                <div class="empty-cart">Belum ada menu dipilih.</div>
            `;
        }

        cart.forEach((item, index) => {
            subtotal += item.harga * item.jumlah;
            totalItem += item.jumlah;

            cartItems.innerHTML += `
                <div class="cart-item">
                    <div class="item-info">
                        <h4>${item.nama}</h4>
                        <p>${rupiah(item.harga * item.jumlah)}</p>
                    </div>
                    <div class="quantity">
                        <button type="button" onclick="changeQuantity(${item.id}, -1)">−</button>
                        <span>${item.jumlah}</span>
                        <button type="button" onclick="changeQuantity(${item.id}, 1)">+</button>
                    </div>
                </div>
            `;

            hiddenDetails.innerHTML += `
                <input type="hidden" name="detail[${index}][id_menu]" value="${item.id}">
                <input type="hidden" name="detail[${index}][jumlah]" value="${item.jumlah}">
            `;
        });

        const service = subtotal * 0.05;
        const tax = (subtotal + service) * 0.10;
        const total = subtotal + service + tax;

        document.getElementById('cartCount').textContent = totalItem + ' item';
        document.getElementById('subtotal').textContent = rupiah(subtotal);
        document.getElementById('service').textContent = rupiah(service);
        document.getElementById('tax').textContent = rupiah(tax);
        document.getElementById('total').textContent = rupiah(total);

        document.getElementById('submitBtn').disabled = cart.length === 0;
    }

    document.querySelectorAll('.category').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.category').forEach(btn => {
                btn.classList.remove('active');
            });

            this.classList.add('active');

            const selected = this.dataset.category;

            document.querySelectorAll('.menu-card').forEach(card => {
                card.style.display =
                    selected === 'semua' || card.dataset.category === selected
                    ? 'flex' : 'none';
            });
        });
    });

    document.getElementById('searchMenu').addEventListener('input', function() {
        const keyword = this.value.toLowerCase();

        document.querySelectorAll('.menu-card').forEach(card => {
            const cocok = card.dataset.name.includes(keyword);
            card.style.display = cocok ? 'flex' : 'none';
        });
    });

    document.getElementById('orderForm').addEventListener('submit', function(e) {
        if (cart.length === 0) {
            e.preventDefault();
            alert('Pilih menu terlebih dahulu!');
        }

        if (!document.getElementById('nomorMeja').value) {
            e.preventDefault();
            alert('Pilih nomor meja terlebih dahulu!');
        }
    });
</script>
</body>
</html>