
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pelanggan - Kedai Kopi Senja</title>

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
            min-height: 75px;
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
            padding: 40px 45px;
            max-width: 1250px;
            margin: auto;
        }

        .heading {
            margin-bottom: 28px;
        }

        .heading h1 {
            font-size: 25px;
            margin-bottom: 6px;
        }

        .heading p {
            font-size: 13px;
            color: #898394;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            align-items: start;
        }

        .panel {
            background: #FFFAF6;
            border: 1px solid #E8D6C8;
            border-radius: 17px;
            padding: 25px;
            min-height: 340px;
        }

        .panel h2 {
            font-size: 17px;
            margin-bottom: 7px;
        }

        .description {
            font-size: 11px;
            color: #898394;
            margin-bottom: 22px;
        }

        .field label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .search-box {
            display: flex;
            gap: 9px;
        }

        .search-box input {
            flex: 1;
            min-width: 0;
            padding: 12px 14px;
            border: 1px solid #E8D6C8;
            background: white;
            border-radius: 9px;
            outline: none;
            font-size: 12px;
        }

        .search-box input:focus {
            border-color: #343B64;
        }

        .search-btn {
            padding: 11px 17px;
            background: #343B64;
            color: white;
            border: none;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
        }

        .search-btn:hover {
            background: #515982;
        }

        .result-title {
            font-size: 12px;
            font-weight: 600;
            margin: 25px 0 12px;
        }

        .customer-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .customer-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 14px;
            background: white;
            border: 1px solid #E8D6C8;
            border-radius: 11px;
        }

        .customer-item.selected {
            border: 1.5px solid #343B64;
            background: #F7EDE5;
        }

        .customer-info h3 {
            font-size: 12px;
            margin-bottom: 4px;
        }

        .customer-info p {
            font-size: 11px;
            color: #898394;
        }

        .select-btn {
            border: none;
            background: #343B64;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 10px;
            cursor: pointer;
        }

        .select-btn:hover {
            background: #515982;
        }

        .select-btn:disabled {
            opacity: 0.6;
            cursor: wait;
        }

        .empty {
            text-align: center;
            padding: 30px 10px;
            font-size: 12px;
            color: #898394;
        }

        .password-panel {
            display: flex;
            flex-direction: column;
        }

        .selected-customer {
            background: #F7EDE5;
            border: 1px solid #E8D6C8;
            border-radius: 11px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .selected-customer small {
            display: block;
            color: #898394;
            font-size: 10px;
            margin-bottom: 5px;
        }

        .selected-customer h3 {
            font-size: 14px;
            margin-bottom: 4px;
        }

        .selected-customer p {
            color: #898394;
            font-size: 11px;
        }

        .password-label {
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .password-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 14px;
            border: 1px solid #E8D6C8;
            background: white;
            border-radius: 10px;
        }

        .password-value {
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 1px;
            overflow-wrap: anywhere;
        }

        .copy-btn {
            background: #E8D6C8;
            color: #343B64;
            border: none;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            flex-shrink: 0;
        }

        .copy-btn:hover {
            background: #DCC5B5;
        }

        .notice {
            margin-top: 13px;
            background: #F7EDE5;
            border-left: 3px solid #9A8290;
            padding: 12px;
            border-radius: 7px;
            font-size: 11px;
            color: #777486;
            line-height: 1.7;
        }

        .placeholder {
            text-align: center;
            padding: 55px 15px;
            color: #A49AA4;
        }

        .placeholder .icon {
            font-size: 38px;
            margin-bottom: 12px;
        }

        .placeholder p {
            font-size: 12px;
        }

        .toast {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background: #343B64;
            color: white;
            padding: 13px 20px;
            border-radius: 10px;
            font-size: 12px;
            display: none;
            z-index: 1000;
        }

        @media(max-width: 850px) {
            .navbar {
                padding: 18px 20px;
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
                padding: 25px 18px;
            }

            .content {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 480px) {
            .search-box {
                flex-direction: column;
            }

            .search-btn {
                padding: 12px;
            }

            .customer-item {
                align-items: flex-start;
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
        <a href="{{ route('kasir.pesanan') }}">Pesanan</a>
        <a href="{{ route('kasir.pelanggan.index') }}" class="active">Pelanggan</a>
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
        <h1>Reset Password Pelanggan</h1>
        <p>Cari pelanggan menggunakan nomor HP untuk membantu mengatur ulang password.</p>
    </div>

    <div class="content">

        <!-- PENCARIAN PELANGGAN -->
        <section class="panel">

            <h2>Cari Pelanggan</h2>
            <p class="description">Masukkan nomor HP pelanggan yang ingin dicari.</p>

            <div class="field">
                <label>Nomor HP</label>

                <div class="search-box">
                    <input type="text"
                        id="searchPhone"
                        placeholder="Contoh: 081234567890">

                    <button type="button" class="search-btn" onclick="searchCustomer()">
                        Cari Pelanggan
                    </button>
                </div>
            </div>

            <p class="result-title">Hasil Pencarian</p>

            <div class="customer-list" id="customerList">

                @forelse($pelanggan as $item)
                    <div class="customer-item"
                        data-name="{{ strtolower($item->nama) }}"
                        data-phone="{{ $item->no_hp }}">

                        <div class="customer-info">
                            <h3>{{ $item->nama }}</h3>
                            <p>{{ $item->no_hp }}</p>
                        </div>

                        <button type="button" class="select-btn"
                            onclick="selectCustomer(
                                @js($item->id_pelanggan),
                                @js($item->nama),
                                @js($item->no_hp),
                                this
                            )">
                            Pilih
                        </button>

                    </div>
                @empty
                    <div class="empty">
                        Belum ada data pelanggan.
                    </div>
                @endforelse

            </div>

        </section>

        <!-- RESET PASSWORD -->
        <section class="panel password-panel">

            <h2>Password Sementara</h2>
            <p class="description">Informasi password sementara pelanggan yang dipilih.</p>

            <div id="passwordContent">

                <div class="placeholder">
                    <div class="icon">🔐</div>
                    <p>Pilih pelanggan terlebih dahulu untuk melihat informasi reset password.</p>
                </div>

            </div>

        </section>

    </div>

</main>

<div class="toast" id="toast">
    Password berhasil disalin!
</div>

<script>
    const resetUrlTemplate = @json(route('pelanggan.reset-password', ['id' => '__ID__']));
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function searchCustomer() {
        const keyword = document.getElementById('searchPhone')
            .value.toLowerCase().replace(/\s/g, '');

        const items = document.querySelectorAll('.customer-item');
        let found = 0;

        items.forEach(item => {
            const phone = item.dataset.phone.replace(/\s/g, '');
            const name = item.dataset.name;

            const cocok = phone.includes(keyword) || name.includes(keyword);

            item.style.display = cocok ? 'flex' : 'none';

            if (cocok) found++;
        });

        if (found === 0) {
            alert('Pelanggan tidak ditemukan.');
        }
    }

    document.getElementById('searchPhone')
        .addEventListener('input', searchCustomer);

    async function selectCustomer(id, nama, nomor, button) {
        const passwordContent = document.getElementById('passwordContent');

        document.querySelectorAll('.customer-item').forEach(item => {
            item.classList.remove('selected');
        });

        button.closest('.customer-item').classList.add('selected');

        document.querySelectorAll('.select-btn').forEach(btn => {
            btn.disabled = true;
        });

        passwordContent.innerHTML = `
            <div class="placeholder">
                <div class="icon">⏳</div>
                <p>Sedang membuat password sementara...</p>
            </div>
        `;

        try {
            const response = await fetch(
                resetUrlTemplate.replace('__ID__', encodeURIComponent(id)),
                {
                    method: 'PUT',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                }
            );

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Gagal mereset password.');
            }

            passwordContent.innerHTML = `
                <div class="selected-customer">
                    <small>Pelanggan Terpilih</small>
                    <h3>${escapeHTML(nama)}</h3>
                    <p>${escapeHTML(nomor)}</p>
                </div>

                <p class="password-label">Password Sementara</p>

                <div class="password-box">
                    <span class="password-value" id="temporaryPassword">${escapeHTML(data.password_sementara)}</span>

                    <button type="button" class="copy-btn" onclick="copyPassword()">
                        Salin Password
                    </button>
                </div>

                <div class="notice">
                    <strong>Perhatian</strong><br>
                    Password sementara berhasil dibuat. Berikan password ini kepada pelanggan.
                    Pelanggan wajib mengganti password saat login berikutnya.
                </div>
            `;

        } catch (error) {
            passwordContent.innerHTML = `
                <div class="notice">
                    <strong>Gagal mereset password</strong><br>
                    ${escapeHTML(error.message)}
                </div>
            `;
        } finally {
            document.querySelectorAll('.select-btn').forEach(btn => {
                btn.disabled = false;
            });
        }
    }

    function escapeHTML(value) {
        return String(value).replace(/[&<>"']/g, char => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        })[char]);
    }

    function copyPassword() {
        const passwordElement = document.getElementById('temporaryPassword');

        if (!passwordElement) return;

        const password = passwordElement.textContent;

        navigator.clipboard.writeText(password).then(() => {
            const toast = document.getElementById('toast');
            toast.style.display = 'block';

            setTimeout(() => {
                toast.style.display = 'none';
            }, 2000);
        }).catch(() => {
            alert('Tidak dapat menyalin password. Silakan salin secara manual.');
        });
    }
</script>

</body>
</html>
