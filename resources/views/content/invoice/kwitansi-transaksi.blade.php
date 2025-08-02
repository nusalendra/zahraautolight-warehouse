<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kwitansi Pembayaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            background-color: #f8f9fa;
            margin: 0;
            padding: 40px;
        }

        .receipt-container {
            max-width: 750px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border: 1px solid #dee2e6;
            border-radius: 6px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .shop-header {
            display: flex;
            align-items: center;
        }

        .logo-image {
            width: 60px;
            height: auto;
            margin-right: 15px;
        }

        .header .shop-info h1 {
            font-size: 20px;
            color: #212529;
            margin: 0;
            margin-top: 5px;
        }

        .header .shop-info p {
            font-size: 11px;
            color: #495057;
            margin: 2px 0;
        }

        .header .receipt-info {
            text-align: right;
            margin-top: 5px;
        }

        .header .receipt-info h2 {
            font-size: 16px;
            margin: 0;
            color: #343a40;
        }

        .header .receipt-info p {
            font-size: 11px;
            margin: 3px 0;
            color: #495057;
        }

        .section-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 5px;
            color: #343a40;
        }

        .customer-details,
        .signature-section {
            margin-bottom: 20px;
        }

        .customer-details p {
            margin: 4px 0;
            color: #495057;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            font-size: 11px;
        }

        table th {
            background-color: #f1f3f5;
            font-weight: bold;
            color: #212529;
        }

        table td:last-child,
        th:last-child {
            text-align: right;
        }

        .totals {
            margin-top: 20px;
            width: 100%;
            font-size: 12px;
        }

        .totals tr td {
            padding: 5px 10px;
        }

        .totals .label {
            text-align: right;
        }

        .totals .amount {
            text-align: right;
            font-weight: bold;
        }

        .terbilang {
            margin-top: 15px;
            font-style: italic;
            color: #212529;
            font-size: 12px;
        }

        .signature-section {
            text-align: right;
            margin-top: 30px;
        }

        .signature-name {
            font-weight: bold;
            color: #212529;
        }

        .footer-notes {
            margin-top: 40px;
            font-size: 10px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }

        .status-label {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            font-weight: bold;
            font-size: 12px;
            border-radius: 4px;
            text-transform: uppercase;
            box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        .status-label.paid {
            background-color: #198754;
        }

        .status-label.unpaid {
            background-color: #dc3545;
        }

        .status-label.partial {
            background-color: #ffc107;
            color: #000;
        }

        /* Hapus atau ganti style .signature-section img jika tidak digunakan untuk logo di header */
        .signature-section img {
            width: 30;
            /* Ini harusnya 30px atau 30% jika ingin diukur dengan unit */
            height: auto;
        }

        .signature-name {
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="header">
            <div class="shop-header">
                <img src="assets/img/icons/brands/logo-product.jpeg" alt="Zahra Auto Light" class="logo-image">
                <div class="shop-info">
                    <h1>Zahra Automotive Lighting</h1>
                    <p>Jl. Raya Petiken Ruko No.3, Mulung, Gresik, Jawa Timur</p>
                    <p>Email: zahraautolight@gmail.com | Telp: +62 812 3456 7890</p>
                </div>
            </div>
            <div class="receipt-info">
                <h2>KWITANSI PEMBAYARAN</h2>
                <p>Tanggal: <strong>{{ \Carbon\Carbon::parse($data->transaction_date)->translatedFormat('d F Y') }}</strong></p>
                <p>No. Transaksi: {{ $data->trx_id }}</p>

                @if($data->invoice->status === 'paid')
                <div class="status-label paid">PAID</div>
                @elseif($data->invoice->status === 'unpaid')
                <div class="status-label unpaid">UNPAID</div>
                @elseif($data->invoice->status === 'partially_paid')
                <div class="status-label partial">PARTIALLY PAID</div>
                @endif
            </div>
        </div>

        <div class="customer-details">
            <div class="section-title">Detail Mitra</div>
            <p>Nama: <strong>{{ $data->invoice->mitra->nama }}</strong></p>
            <p>Email: {{ $data->invoice->mitra->email }}</p>
            <p>Telepon: {{ $data->invoice->mitra->nomor_telepon }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data->invoice->invoiceItem as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->qty }} pcs</td>
                    <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->amount * $item->qty, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals">
            <tr>
                <td class="label">Total Tagihan</td>
                <td class="amount">Rp {{ number_format($data->invoice->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Dibayar</td>
                <td class="amount">Rp {{ number_format($data->amount_transaction, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label"><strong>Sisa Tagihan</strong></td>
                <td class="amount">Rp {{ number_format($data->invoice->sisa_tagihan, 0, ',', '.') }}</td>
            </tr>

        </table>

        <div class="signature-section">
            <p>Gresik, {{ \Carbon\Carbon::parse($data->transaction_date)->translatedFormat('d F Y') }}</p>
            <img src="{{ public_path('assets/img/icons/tanda_tangan/tanda_tangan_kwitansi.jpeg') }}" alt="Tanda Tangan">
            <div class="signature-name">{{ $username }}</div>
            <div class="signature-title">Karyawan</div>
        </div>

        <div class="footer-notes">
            <p><strong>Catatan:</strong></p>
            <ul>
                <li>Simpan kwitansi ini sebagai bukti pembayaran resmi.</li>
                <li>Terima kasih atas kepercayaan Anda menggunakan layanan kami.</li>
            </ul>
        </div>
    </div>
</body>

</html>