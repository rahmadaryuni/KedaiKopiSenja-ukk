
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu | Kedai Kopi Senja</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #F7EDE5;
            --card: #FFFAF6;
            --blue: #343B64;
            --muted: #898394;
            --border: #E8D6C8;
            --mauve: #9A8290;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--blue);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        /* HEADER */
        .topbar {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 17px 5%;
        }

        .back-dashboard {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--blue);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .back-dashboard:hover {
            color: var(--mauve);
        }

        .back-dashboard span {
            font-size: 21px;
        }

        /* MAIN */
        .container-main {
            max-width: 1200px;
            margin: 38px auto;
            padding: 0 20px;
        }

        .page-title {
            color: var(--blue);
            font-size: 25px;
            font-weight: 700;
        }

        .subtitle {
            color: var(--muted);
            font-size: 12px;
            margin-top: 5px;
        }

        .panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 24px;
        }

        /* BUTTON */
        .btn-main {
            background: var(--blue);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 17px;
            font-size: 12px;
            font-weight: 500;
            transition: .2s;
        }

        .btn-main:hover {
            background: #252B4D;
            color: white;
        }

        .btn-light-custom {
            background: var(--cream);
            color: var(--blue);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 9px 15px;
            font-size: 12px;
        }

        /* FORM */
        .form-control,
        .form-select {
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px 13px;
            font-size: 12px;
            background-color: white;
            color: var(--blue);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--mauve);
            box-shadow: 0 0 0 3px #9A829020;
        }

        .form-label {
            color: var(--blue);
            font-size: 12px;
            font-weight: 500;
        }

        /* TABLE */
        .table {
            font-size: 12px;
            vertical-align: middle;
            color: var(--blue);
            margin-bottom: 0;
        }

        .table thead th {
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .4px;
            background: var(--cream);
            padding: 14px;
            border: 0;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 15px 14px;
            border-color: var(--border);
        }

        .menu-name {
            color: var(--blue);
            font-weight: 600;
        }

        .menu-code {
            color: var(--muted);
            font-size: 10px;
        }

        /* STATUS */
        .status {
            border-radius: 20px;
            padding: 7px 13px;
            font-size: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: .2s;
        }

        .status:hover {
            transform: translateY(-1px);
            opacity: .85;
        }

        .available {
            background: #E5EEE8;
            color: #496C58;
        }

        .unavailable {
            background: #F3E5E8;
            color: #986475;
        }

        /* ACTION */
        .btn-edit,
        .btn-delete {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 10px;
            transition: .2s;
        }

        .btn-edit {
            color: var(--blue);
            background: #F0EDF4;
        }

        .btn-edit:hover {
            background: #E4DFED;
            color: var(--blue);
        }

        .btn-delete {
            color: #A35F70;
            background: #F9ECEE;
        }

        .btn-delete:hover {
            background: #F2DDE2;
            color: #A35F70;
        }

        /* MODAL */
        .modal-content {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
        }

        .modal-title {
            color: var(--blue);
            font-size: 17px;
            font-weight: 700;
        }

        .modal-footer {
            gap: 7px;
        }

        .alert {
            border-radius: 12px;
            font-size: 12px;
        }

        .footer {
            text-align: center;
            color: var(--muted);
            font-size: 10px;
            padding: 20px 0 30px;
        }

        @media(max-width: 700px) {
            .container-main {
                margin-top: 25px;
                padding: 0 14px;
            }

            .panel {
                padding: 15px;
            }

            .page-title {
                font-size: 21px;
            }

            .table {
                min-width: 700px;
            }
        }
    </style>
</head>

<body>

    <!-- TOMBOL KEMBALI -->
    <header class="topbar">
        <div class="container-fluid">
            <a href="{{ route('manajer.dashboard') }}" class="back-dashboard">
                <span>←</span>
                Kembali ke Dashboard
            </a>
        </div>
    </header>


    <main class="container-main">

        <!-- JUDUL HALAMAN -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <div class="page-title">Kelola Menu</div>
                <div class="subtitle">
                    Atur daftar menu dan harga Kedai Kopi Senja.
                </div>
            </div>

            <button class="btn btn-main"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                + Tambah Menu
            </button>
        </div>


        <!-- PESAN BERHASIL -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- PESAN ERROR -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- TABEL MENU -->
        <section class="panel">

            <div class="row g-3 mb-4">

                <div class="col-md-6">
                    <input type="text"
                           id="searchMenu"
                           class="form-control"
                           placeholder="Cari nama atau kode menu...">
                </div>

                <div class="col-md-3">
                    <select id="filterKategori" class="form-select">
                        <option value="">Semua kategori</option>

                        @foreach($kategori as $kat)
                            <option value="{{ strtolower($kat->nama_kategori) }}">
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="form-control bg-white">
                        Total menu:
                        <strong>{{ $menu->count() }}</strong>
                    </div>
                </div>

            </div>


            <div class="table-responsive">
                <table class="table" id="tabelMenu">

                    <thead>
                        <tr>
                            <th>KODE</th>
                            <th>NAMA MENU</th>
                            <th>KATEGORI</th>
                            <th>HARGA</th>
                            <th>STATUS</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($menu as $item)
                            <tr>

                                <td class="menu-code">
                                    {{ $item->kode_menu }}
                                </td>

                                <td>
                                    <div class="menu-name">
                                        {{ $item->nama_menu }}
                                    </div>

                                    <div class="menu-code">
                                        {{ $item->deskripsi }}
                                    </div>
                                </td>

                                <td>
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>

                                <!-- UBAH STATUS -->
                                <td>
                                    <form action="{{ route('menu.update', $item->id_menu) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden"
                                               name="nama_menu"
                                               value="{{ $item->nama_menu }}">

                                        <input type="hidden"
                                               name="id_kategori"
                                               value="{{ $item->id_kategori }}">

                                        <input type="hidden"
                                               name="deskripsi"
                                               value="{{ $item->deskripsi }}">

                                        <input type="hidden"
                                               name="harga"
                                               value="{{ $item->harga }}">

                                        
                                    @php
                                        $menuAktif = in_array($item->status_menu, ['Tersedia', 'Aktif'])
                                            && $item->status_stok === 'Tersedia';
                                    @endphp

                                    <input type="hidden"
                                        name="status_menu"
                                        value="{{ $menuAktif ? 'Tidak Tersedia' : 'Tersedia' }}">

                                    <button type="submit"
                                        class="status {{ $menuAktif ? 'available' : 'unavailable' }}"
                                        title="Klik untuk mengubah status">

                                        {{ $menuAktif ? '● Aktif' : '● Nonaktif' }}
                                    </button>
                                    </form>
                                    </td>

                                        </button>
                                    </form>
                                </td>

                                <!-- AKSI -->
                                <td class="text-center">

                                    <button type="button"
                                            class="btn btn-edit"
                                            onclick="editMenu(
                                                {{ $item->id_menu }},
                                                {{ Js::from($item->nama_menu) }},
                                                {{ Js::from($item->deskripsi) }},
                                                {{ $item->id_kategori }},
                                                {{ $item->harga }},
                                                {{ Js::from($item->status_menu) }}
                                            )">
                                        Edit
                                    </button>

                                    <form action="{{ route('menu.destroy', $item->id_menu) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus menu ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="6"
                                    class="text-center py-5"
                                    style="color: var(--muted);">
                                    Belum ada data menu.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </section>


        <footer class="footer">
            © {{ date('Y') }} Kedai Kopi Senja · COFFEE & STORIES
        </footer>

    </main>


    <!-- MODAL TAMBAH MENU -->
    <div class="modal fade" id="modalTambah" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title">Tambah Menu Baru</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <form action="{{ route('menu.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Menu</label>

                            <input type="text"
                                   name="nama_menu"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>

                            <select name="id_kategori"
                                    class="form-select"
                                    required>

                                <option value="">Pilih kategori</option>

                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}">
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>

                            <textarea name="deskripsi"
                                      class="form-control"
                                      rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>

                            <input type="number"
                                   name="harga"
                                   class="form-control"
                                   min="0"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Menu</label>

                            <select name="status_menu"
                                    class="form-select"
                                    required>

                                <option value="Tersedia">Aktif</option>
                                <option value="Tidak Tersedia">Nonaktif</option>

                            </select>
                        </div>

                    </div>

                    <div class="modal-footer border-0">

                        <button type="button"
                                class="btn btn-light-custom"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-main">
                            Simpan Menu
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- MODAL EDIT MENU -->
    <div class="modal fade" id="modalEdit" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title">Edit Menu</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Menu</label>

                            <input type="text"
                                   name="nama_menu"
                                   id="editNama"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>

                            <select name="id_kategori"
                                    id="editKategori"
                                    class="form-select"
                                    required>

                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}">
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>

                            <textarea name="deskripsi"
                                      id="editDeskripsi"
                                      class="form-control"
                                      rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>

                            <input type="number"
                                   name="harga"
                                   id="editHarga"
                                   class="form-control"
                                   min="0"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Menu</label>

                            <select name="status_menu"
                                    id="editStatus"
                                    class="form-select"
                                    required>

                                <option value="Tersedia">Aktif</option>
                                <option value="Tidak Tersedia">Nonaktif</option>

                            </select>
                        </div>

                    </div>

                    <div class="modal-footer border-0">

                        <button type="button"
                                class="btn btn-light-custom"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-main">
                            Simpan Perubahan
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // EDIT MENU
        function editMenu(id, nama, deskripsi, kategori, harga, status) {

            document.getElementById('formEdit').action = `/menu/${id}`;

            document.getElementById('editNama').value = nama;
            document.getElementById('editDeskripsi').value = deskripsi || '';
            document.getElementById('editKategori').value = kategori;
            document.getElementById('editHarga').value = harga;
            document.getElementById('editStatus').value = status;

            new bootstrap.Modal(
                document.getElementById('modalEdit')
            ).show();
        }


        // PENCARIAN DAN FILTER
        const search = document.getElementById('searchMenu');
        const filter = document.getElementById('filterKategori');

        function filterMenu() {

            const keyword = search.value.toLowerCase();
            const category = filter.value;

            document.querySelectorAll('#tabelMenu tbody tr').forEach(row => {

                const text = row.innerText.toLowerCase();

                const matchSearch = text.includes(keyword);
                const matchCategory = !category || text.includes(category);

                row.style.display =
                    matchSearch && matchCategory ? '' : 'none';
            });
        }

        search.addEventListener('input', filterMenu);
        filter.addEventListener('change', filterMenu);
    </script>

</body>
</html>
