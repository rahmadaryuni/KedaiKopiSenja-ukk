
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Bahan | Kedai Kopi Senja</title>

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
            max-width: 1250px;
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

        .bahan-name {
            color: var(--blue);
            font-weight: 600;
        }

        .bahan-code {
            color: var(--muted);
            font-size: 10px;
        }

        .stock-badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        .stock-safe {
            background: #E5EEE8;
            color: #496C58;
        }

        .stock-low {
            background: #F3E5E8;
            color: #986475;
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
                min-width: 850px;
            }
        }
    </style>
</head>

<body>

    
    <header class="topbar">
        <div class="container-fluid">
            <a href="{{ route('manajer.dashboard') }}" class="back-dashboard">
                <span>←</span>
                Kembali ke Dashboard
            </a>
        </div>
    </header>

    <main class="container-main">

        
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <div class="page-title">Kelola Bahan</div>
                <div class="subtitle">
                    Kelola persediaan bahan baku Kedai Kopi Senja.
                </div>
            </div>

            <button class="btn btn-main"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                + Tambah Bahan
            </button>
        </div>

        
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
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        
        <section class="panel">

            <div class="row g-3 mb-4">

                <div class="col-md-6">
                    <input type="text"
                           id="searchBahan"
                           class="form-control"
                           placeholder="Cari nama atau kode bahan...">
                </div>

                <div class="col-md-3">
                    <select id="filterStok" class="form-select">
                        <option value="">Semua kondisi stok</option>
                        <option value="aman">Stok Aman</option>
                        <option value="menipis">Stok Menipis</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="form-control bg-white">
                        Total bahan:
                        <strong>{{ $bahan->count() }}</strong>
                    </div>
                </div>

            </div>

            <div class="table-responsive">
                <table class="table" id="tabelBahan">

                    <thead>
                        <tr>
                            <th>KODE API</th>
                            <th>NAMA BAHAN</th>
                            <th>STOK</th>
                            <th>BATAS MINIMUM</th>
                            <th>HARGA PER SATUAN</th>
                            <th>TERAKHIR DIPERBARUI</th>
                            <th>KONDISI</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($bahan as $item)

                            @php
                                $menipis = (float) $item->stok <= (float) $item->batas_min;
                            @endphp

                            <tr data-kondisi="{{ $menipis ? 'menipis' : 'aman' }}">

                                <td>
                                    <span class="bahan-code">
                                        {{ $item->kode_api ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="bahan-name">
                                        {{ $item->nama_bahan }}
                                    </div>
                                    <div class="bahan-code">
                                        Satuan: {{ $item->satuan_dasar }}
                                    </div>
                                </td>

                                <td>
                                    {{ number_format((float) $item->stok, 2, ',', '.') }}
                                    {{ $item->satuan_dasar }}
                                </td>

                                <td>
                                    {{ number_format((float) $item->batas_min, 2, ',', '.') }}
                                    {{ $item->satuan_dasar }}
                                </td>

                                <td>
                                    @if($item->harga_per_satuan !== null)
                                        Rp {{ number_format((float) $item->harga_per_satuan, 0, ',', '.') }}
                                    @else
                                        <span class="bahan-code">Belum tersedia</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->harga_diperbarui)
                                        {{ \Carbon\Carbon::parse($item->harga_diperbarui)->format('d-m-Y') }}
                                    @else
                                        <span class="bahan-code">Belum tersedia</span>
                                    @endif
                                </td>

                                <td>
                                    @if($menipis)
                                        <span class="stock-badge stock-low">
                                            Menipis
                                        </span>
                                    @else
                                        <span class="stock-badge stock-safe">
                                             Aman
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <button type="button"
                                            class="btn btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit"
                                            data-id="{{ $item->id_bahan }}"
                                            data-nama="{{ $item->nama_bahan }}"
                                            data-satuan="{{ $item->satuan_dasar }}"
                                            data-stok="{{ $item->stok }}"
                                            data-batas="{{ $item->batas_min }}"
                                            data-url="{{ route('bahan.update', $item->id_bahan) }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('bahan.destroy', $item->id_bahan) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus bahan ini?')">

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
                                <td colspan="7"
                                    class="text-center py-5"
                                    style="color: var(--muted);">
                                    Belum ada data bahan.
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


    
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title">Tambah Bahan Baru</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('bahan.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Bahan</label>
                            <input type="text"
                                   name="nama_bahan"
                                   class="form-control"
                                   placeholder="Contoh: Susu UHT"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Satuan Dasar</label>
                            <input type="text"
                                   name="satuan_dasar"
                                   class="form-control"
                                   placeholder="Contoh: ml, g, pcs"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number"
                                   name="stok"
                                   class="form-control"
                                   min="0"
                                   step="0.01"
                                   value="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Batas Minimum Stok</label>
                            <input type="number"
                                   name="batas_min"
                                   class="form-control"
                                   min="0"
                                   step="0.01"
                                   value="0">
                        </div>

                    </div>

                    <div class="modal-footer border-0">
                        <button type="button"
                                class="btn btn-light-custom"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-main">
                            Simpan Bahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title">Edit Data Bahan</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Bahan</label>
                            <input type="text"
                                   name="nama_bahan"
                                   id="editNama"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Satuan Dasar</label>
                            <input type="text"
                                   name="satuan_dasar"
                                   id="editSatuan"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number"
                                   name="stok"
                                   id="editStok"
                                   class="form-control"
                                   min="0"
                                   step="0.01">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Batas Minimum Stok</label>
                            <input type="number"
                                   name="batas_min"
                                   id="editBatas"
                                   class="form-control"
                                   min="0"
                                   step="0.01">
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
        const modalEdit = document.getElementById('modalEdit');

        modalEdit.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            document.getElementById('formEdit').action =
                button.getAttribute('data-url');

            document.getElementById('editNama').value =
                button.getAttribute('data-nama');

            document.getElementById('editSatuan').value =
                button.getAttribute('data-satuan');

            document.getElementById('editStok').value =
                button.getAttribute('data-stok');

            document.getElementById('editBatas').value =
                button.getAttribute('data-batas');
        });


        
        const searchBahan = document.getElementById('searchBahan');
        const filterStok = document.getElementById('filterStok');

        function filterBahan() {
            const keyword = searchBahan.value.toLowerCase();
            const kondisi = filterStok.value;

            document.querySelectorAll('#tabelBahan tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                const rowKondisi = row.dataset.kondisi;

                const cocokNama = text.includes(keyword);
                const cocokStok = !kondisi || rowKondisi === kondisi;

                row.style.display = cocokNama && cocokStok ? '' : 'none';
            });
        }

        searchBahan.addEventListener('input', filterBahan);
        filterStok.addEventListener('change', filterBahan);
    </script>

</body>
</html>
