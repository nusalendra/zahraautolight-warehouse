<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        @page {
            margin: 0.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 1cm;
            padding: 0;
            color: #333;
            line-height: 1.5;
            font-size: 12px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .header {
            margin-bottom: 20px;
        }

        .logo {
            float: left;
            width: 25%;
            padding: 10px;
        }

        .invoice-info {
            float: right;
            width: 40%;
            text-align: right;
            padding: 10px;
        }

        .invoice-info h2 {
            margin: 0;
            font-size: 24px;
            color: #4267b2;
        }

        .invoice-details {
            margin-bottom: 5px;
        }

        .info-container {
            clear: both;
            margin-top: 20px;
        }

        .company-info {
            width: 48%;
            float: left;
            margin-bottom: 20px;
        }

        .customer-info {
            width: 48%;
            float: right;
            margin-bottom: 20px;
        }

        h3 {
            margin-top: 0;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            clear: both;
        }

        thead {
            background-color: #263238;
            color: white;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }

        .amount-column {
            text-align: right;
        }

        .subtotal-section {
            float: right;
            width: 40%;
            margin-top: 20px;
        }

        .subtotal-table {
            width: 100%;
        }

        .subtotal-table td {
            padding: 5px;
        }

        .total-row {
            font-weight: bold;
        }

        .signature {
            text-align: right;
            margin-top: 40px;
            float: right;
            width: 30%;
        }

        .signature .name {
            margin-top: 50px;
            font-weight: bold;
        }

        .footer-sections {
            clear: both;
            margin-top: 30px;
            padding-top: 20px;
        }

        .footer-section {
            margin-bottom: 15px;
        }

        .footer-section h3 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        hr {
            border: 0;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="header clearfix">
        <div class="logo">
            <img src="{{ public_path('/assets/img/icons/brands/logo-product.jpeg') }}" alt="Zaira Automotive Lighting Logo" style="max-width: 100%; max-height: 100px;">
        </div>
        <div class="invoice-info">
            <h2>Invoice</h2>
            <div class="invoice-details">
                <div><strong>Referensi: </strong> {{ $data->nomor_invoice }}</div>
                <div><strong>Tanggal: </strong> {{ $data->invoice_date ? date('d.m.Y', strtotime($data->invoice_date)) : '02.05.2025' }}</div>
            </div>
        </div>
    </div>

    <div class="info-container clearfix">
        <div class="company-info">
            <h3>Info Perusahaan</h3>
            <div>
                <strong>Zaira Automotive Lighting</strong><br>
                Jalan Raya Petiken No.3 Ruko GWK, Driyorejo, Kab. Gresik,<br>
                Jawa Timur<br>
                Telp: 6289685443747<br>
                Email: fiqijulian18@gmail.com
            </div>
        </div>

        <div class="customer-info">
            <h3>Tagihan Untuk</h3>
            <div>
                <strong>{{ $data->mitra->nama }}</strong><br>
                Telp: {{ $data->mitra->nomor_telepon }}
            </div>
        </div>
    </div>

    <div style="clear: both;"></div>

    <table>
        <thead>
            <tr>
                <th>Merek</th>
                <th>Produk</th>
                <th>Kuantitas</th>
                <th class="amount-column">Harga (Rp)</th>
                <th class="amount-column">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($data->invoiceItem) && count($data->invoiceItem) > 0)
            @foreach($data->invoiceItem as $item)
            <tr>
                <td>{{$item->produk->merek->nama}}</td>
                <td>{{ $item->produk->nama }}</td>
                <td>{{ $item->qty ?? '-' }}</td>
                <td class="amount-column">{{ number_format($item->amount, 2, '.', ',') ?? '-' }}</td>
                <td class="amount-column">{{ number_format($item->qty * $item->amount, 2, '.', ',') ?? '-' }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="subtotal-section">
        <table class="subtotal-table">
            <tr>
                <td>Subtotal</td>
                <td class="amount-column">Rp {{ number_format($data->subtotal, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td class="amount-column">Rp {{ number_format($data->total, 2, '.', ',') }}</td>
            </tr>
            <tr class="total-row">
                <td>Sisa Tagihan:</td>
                <td class="amount-column">Rp {{ number_format($data->sisa_tagihan, 2, '.', ',') }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div class="footer-sections">
        <div class="footer-section">
            <h3>Keterangan</h3>
            <p>{{ $data->notes ?? 'Garansi Toko 6 Bulan' }}</p>
        </div>

        <div class="footer-section">
            <h3>Syarat & Ketentuan</h3>
            <p>{{ $data->terms ?? 'Klaim Garansi Wajib Membawa Invoice dan No Asli' }}</p>
        </div>
    </div>

    <div class="signature">
        <p>{{ $data->admin_name ?? 'Sumanto (Admin)' }}</p>
        <div class="name">
            <p>____________________</p>
        </div>
    </div>
</body>

</html>