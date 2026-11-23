
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan #{{ $pesanan->id_pesanan }} | Kedai Kopi Senja</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            background: #F7EDE5;
            color: #343B64;
            font-family: Arial, sans-serif;
        }

        .receipt {
            width: 100%;
            max-width: 430px;
            margin: auto;
            padding: 28px;
            background: #FFFAF6;
            border: 1px solid #E8D6C8;
            border-radius: 16px;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px dashed #CDBBAF;
        }

        .header h2 {
            margin: 0 0 7px;
            letter-spacing: 1px;
        }

        .header p {
            margin: 0;
            font-size: 12px;
            color: #898394;
        }

        .info {
            padding: 16px 0;
            font-size: 13px;
            border-bottom: 1px dashed #CDBBAF;
        }

        .info div,
        .summary div {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin: 8px 0;
        }

        .items {
            padding: 15px 0;
            border-bottom: 1px dashed #CDBBAF;
        }

        .items h4 {
            margin: 0 0 14px;
        }

        .item {
            margin-bottom: 15px;
            font-size: 13px;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .item-detail {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            color: #898394;
            font-size: 12px;
        }

        .summary {
            padding-top: 15px;
            font-size: 13px;
        }

        .grand-total {
            padding-top: 13px;
            margin-top: 13px;
            border-top: 1px solid #E8D6C8;
            font-size: 17px;
            font-weight: bold;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #898394;
        }

        .actions {
            max-width: 430px;
            margin: 18px auto;
            display: flex;
            gap: 10px;
        }

        .actions button,
        .actions a {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 9px;
            background: #343B64;
            color: white;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }

            .receipt {
                border: none;
                border-radius: 0;
            }

            .actions {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="receipt">

        <div class="header">
            <h2>KEDAI KOPI SENJA</h2>
            <p>COFFEE & STORIES</p>
            <p>Struk Pembayaran</p>
        </div>

        <div class="info">
            <div>
                <span>No. Pesanan</span>
                <strong>#{{ $pesanan->id_pesanan }}</strong>
            </div>

            <div>
                <span>Tanggal</span>
                <strong>
                    {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d/m/Y H:i') }}
                </strong>
            </div>

            <div>
                <span>Pelanggan</span>
                <strong>{{ $pesanan->pelanggan->nama ?? 'Pelanggan umum' }}</strong>
            </div>

            @if($pesanan->nomor_meja)
                <div>
                    <span>Nomor Meja</span>
                    <strong>{{ $pesanan->nomor_meja }}</strong>
                </div>
            @endif

            @if($pesanan->metode_pembayaran)
                <div>
                    <span>Pembayaran</span>
                    <strong>{{ $pesanan->metode_pembayaran }}</strong>
                </div>
            @endif
        </div>

        <div class="items">
            <h4>Detail Pesanan</h4>

            @foreach($pesanan->detailPesanan as $detail)
                <div class="item">
                    <div class="item-name">
                        {{ $detail->menu->nama_menu ?? 'Menu' }}
                    </div>

                    <div class="item-detail">
                        <span>
                            {{ $detail->jumlah }} x
                            Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}
                        </span>

                        <strong>
                            Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="summary">
            <div>
                <span>Subtotal</span>
                <strong>Rp{{ number_format($pesanan->subtotal, 0, ',', '.') }}</strong>
            </div>

            <div>
                <span>Biaya layanan (5%)</span>
                <strong>Rp{{ number_format($pesanan->biaya_layanan, 0, ',', '.') }}</strong>
            </div>

            <div>
                <span>Pajak (10%)</span>
                <strong>Rp{{ number_format($pesanan->pajak, 0, ',', '.') }}</strong>
            </div>

            <div class="grand-total">
                <span>Total</span>
                <strong>Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih telah berkunjung!</p>
            <strong>Kedai Kopi Senja</strong>
        </div>

    </div>

    <div class="actions">
        <a href="{{ route('kasir.pesanan') }}">Kembali</a>
    </div>

</body>
</html>
