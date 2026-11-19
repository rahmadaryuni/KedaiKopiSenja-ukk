
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Resep | Kedai Kopi Senja</title>

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
            min-height: 100vh;
            background: var(--cream);
            color: var(--blue);
            font-family: 'Poppins', sans-serif;
        }

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
        }

        .back-dashboard:hover {
            color: var(--mauve);
        }

        .back-dashboard span {
            font-size: 21px;
        }

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

        .btn-main {
            background: var(--blue);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 17px;
            font-size: 12px;
            font-weight: 500;
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

        .form-control,
        .form-select {
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px 13px;
            font-size: 12px;
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

        .small-text {
            color: var(--muted);
            font-size: 10px;
        }

        .badge-resep {
            background: #F0EDF4;
            color: var(--blue);
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .btn-edit,
        .btn-delete {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 10px;
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
                min-width: 650px;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="topbar">
        <div class="container-fluid">
            <a href="{{ route('manajer.dashboard') }}" class="back-dashboard">
                <span>←</span>
                Kembali ke Dashboard
            </a>
        </div>
    </header>

    <main class="container-main">

        <!-- JUDUL -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <div class="page-title">Kelola Resep</div>
                <div class="subtitle">
                    Atur komposisi bahan untuk setiap menu Kedai Kopi Senja.
                </div>
            </div>

            <button class="btn btn-main"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                + Tambah Resep
            </button>
        </div>

        <!-- NOTIFIKASI -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- TABEL RESEP -->
        <section class="panel">

            <div class="row g-3 mb-4">

                <div class="col-md-6">
                    <input type="text"
                           id="searchResep"
                           class="form-control"
                           placeholder="Cari nama menu atau bahan...">
                </div>

                <div class="col-md-3">
                    <select id="filterMenu" class="form-select">
                        <option value="">Semua menu</option>

                        @foreach($menu as $item)
                            <option value="{{ strtolower($item->nama_menu) }}">
                                {{ $item->nama_menu }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="form-control bg-white">
                        Total resep:
                        <strong>{{ $resep->count() }}</strong>
                    </div>
                </div>

            </div>

            <div class="table-responsive">
                <table class="table" id="tabelResep">

                    <thead>
                        <tr>
                            <th>MENU</th>
                            <th>BAHAN</th>
                            <th>TAKARAN</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($resep as $item)
                            <tr>

                                <td>
                                    <div class="menu-name">
                                        {{ $item->menu->nama_menu ?? 'Menu tidak ditemukan' }}
                                    </div>
                                    <div class="small-text">
                                        {{ $item->menu->kode_menu ?? '-' }}
                                    </div>
                                </td>

                                <td>
                                    <div class="menu-name">
                                        {{ $item->bahan->nama_bahan ?? 'Bahan tidak ditemukan' }}
                                    </div>
                                    <div class="small-text">
                                        {{ $item->bahan->satuan_dasar ?? '' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge-resep">
                                        {{ number_format((float) $item->takaran, 2, ',', '.') }}
                                        {{ $item->bahan->satuan_dasar ?? '' }}
                                    </span>
                                </td>

                                <td class="text-center">

                                    <button type="button"
                                            class="btn btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit"
                                            data-url="{{ route('resep.update', $item->id_resep) }}"
                                            data-menu="{{ $item->id_menu }}"
                                            data-bahan="{{ $item->id_bahan }}"
                                            data-takaran="{{ $item->takaran }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('resep.destroy', $item->id_resep) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus resep ini?')">

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
                                <td colspan="4"
                                    class="text-center py-5"
                                    style="color: var(--muted);">
                                    Belum ada data resep.
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


    <!-- MODAL TAMBAH -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title">Tambah Resep Baru</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('resep.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Pilih Menu</label>

                            <select name="id_menu"
                                    class="form-select"
                                    required>

                                <option value="">Pilih menu</option>

                                @foreach($menu as $item)
                                    <option value="{{ $item->id_menu }}">
                                        {{ $item->nama_menu }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih Bahan</label>

                            <select name="id_bahan"
                                    class="form-select"
                                    required>

                                <option value="">Pilih bahan</option>

                                @foreach($bahan as $item)
                                    <option value="{{ $item->id_bahan }}">
                                        {{ $item->nama_bahan }} ({{ $item->satuan_dasar }})
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Takaran</label>

                            <input type="number"
                                   name="takaran"
                                   class="form-control"
                                   placeholder="Masukkan jumlah takaran"
                                   min="0.01"
                                   step="0.01"
                                   required>
                        </div>

                        <div class="small-text">
                            Satuan takaran mengikuti satuan dasar bahan yang dipilih.
                        </div>

                    </div>

                    <div class="modal-footer border-0">

                        <button type="button"
                                class="btn btn-light-custom"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-main">
                            Simpan Resep
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- MODAL EDIT -->
    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title">Edit Resep</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Pilih Menu</label>

                            <select name="id_menu"
                                    id="editMenu"
                                    class="form-select"
                                    required>

                                @foreach($menu as $item)
                                    <option value="{{ $item->id_menu }}">
                                        {{ $item->nama_menu }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih Bahan</label>

                            <select name="id_bahan"
                                    id="editBahan"
                                    class="form-select"
                                    required>

                                @foreach($bahan as $item)
                                    <option value="{{ $item->id_bahan }}">
                                        {{ $item->nama_bahan }} ({{ $item->satuan_dasar }})
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Takaran</label>

                            <input type="number"
                                   name="takaran"
                                   id="editTakaran"
                                   class="form-control"
                                   min="0.01"
                                   step="0.01"
                                   required>
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
        // ISI FORM EDIT
        const modalEdit = document.getElementById('modalEdit');

        modalEdit.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            document.getElementById('formEdit').action =
                button.getAttribute('data-url');

            document.getElementById('editMenu').value =
                button.getAttribute('data-menu');

            document.getElementById('editBahan').value =
                button.getAttribute('data-bahan');

            document.getElementById('editTakaran').value =
                button.getAttribute('data-takaran');
        });


        // PENCARIAN DAN FILTER
        const searchResep = document.getElementById('searchResep');
        const filterMenu = document.getElementById('filterMenu');

        function filterResep() {
            const keyword = searchResep.value.toLowerCase();
            const menuDipilih = filterMenu.value;

            document.querySelectorAll('#tabelResep tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                const cocokCari = text.includes(keyword);

                const cocokMenu =
                    !menuDipilih || text.includes(menuDipilih);

                row.style.display =
                    cocokCari && cocokMenu ? '' : 'none';
            });
        }

        searchResep.addEventListener('input', filterResep);
        filterMenu.addEventListener('change', filterResep);
    </script>

</body>
</html>
