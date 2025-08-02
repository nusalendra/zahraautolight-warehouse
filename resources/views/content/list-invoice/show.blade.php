<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .logo {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .logo .text-overlay {
            position: absolute;
            display: none;
            /* Hide the text overlay since we're using the image */
            color: white;
            font-weight: bold;
            font-size: 36px;
        }

        .logo .text-overlay span {
            color: #ff0000;
        }

        .invoice-info {
            text-align: right;
        }

        .invoice-info h2 {
            margin: 0;
            font-size: 24px;
            color: #4267b2;
        }

        .invoice-details {
            margin-bottom: 5px;
        }

        .company-info,
        .customer-info {
            margin-bottom: 20px;
        }

        .company-info h3,
        .customer-info h3 {
            margin-top: 0;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        thead {
            background-color: #263238;
            color: white;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .amount-column {
            text-align: right;
        }

        .subtotal-section {
            display: flex;
            justify-content: flex-end;
        }

        .subtotal-table {
            width: 300px;
        }

        .subtotal-table td {
            padding: 5px 10px;
        }

        .total-row {
            font-weight: bold;
        }

        .signature {
            text-align: right;
            margin-top: 40px;
        }

        .signature p {
            margin-bottom: 40px;
        }

        .signature .name {
            margin-top: 10px;
            font-weight: bold;
        }

        .footer-sections {
            margin-top: 50px;
        }

        .footer-section {
            margin-bottom: 30px;
        }

        .footer-section h3 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="/assets/img/icons/brands/logo-product.jpeg" alt="Zaira Automotive Lighting Logo">
                <div class="text-overlay">Z<span>i</span></div>
            </div>
            <div class="invoice-info">
                <h2>Invoice</h2>
                <div class="invoice-details">
                    <div><strong>Referensi: </strong> {{ $invoice->nomor_invoice }}</div>
                    <div><strong>Tanggal: </strong> {{ $invoice->invoice_date ? date('d.m.Y', strtotime($invoice->invoice_date)) : '02.05.2025' }}</div>
                </div>
            </div>
        </div>

        <div class="info-section">
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
                    <strong>{{ $invoice->mitra->nama }}</strong><br>
                    Telp: {{ $invoice->mitra->nomor_telepon }}
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Deskripsi</th>
                    <th>Kuantitas</th>
                    <th class="amount-column">Harga (Rp)</th>
                    <th class="amount-column">Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($invoice->logStokProduk) && count($invoice->logStokProduk) > 0)
                @foreach($invoice->logStokProduk as $item)
                <tr>
                    <td>{{$item->produk->merek->nama}} | {{ $item->produk->nama }}</td>
                    <td>{{ $item->description ?? '-' }}</td>
                    <td>{{ $item->stok ?? '-' }}</td>
                    <td class="amount-column">{{ number_format($item->harga, 2, '.', ',') ?? '' }}</td>
                    <td class="amount-column">{{ number_format($item->stok * $item->harga, 2, '.', ',') ?? '' }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

        <div class="subtotal-section">
            <table class="subtotal-table">
                <tr>
                    <td>Subtotal</td>
                    <td class="amount-column">Rp {{ number_format($invoice->subtotal, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td class="amount-column">Rp {{ number_format($invoice->total, 2, '.', ',') }}</td>
                </tr>
                <tr class="total-row">
                    <td>Sisa Tagihan:</td>
                    <td class="amount-column">Rp {{ number_format($invoice->sisa_tagihan, 2, '.', ',') }}</td>
                </tr>
            </table>
        </div>

        <div class="footer-sections">
            <div class="footer-section">
                <h3>Keterangan</h3>
                <p>{{ $invoice->notes ?? 'Garansi Toko 6 Bulan' }}</p>
            </div>

            <div class="footer-section">
                <h3>Syarat & Ketentuan</h3>
                <p>{{ $invoice->terms ?? 'Klaim Garansi Wajib Membawa Invoice dan No Asli' }}</p>
            </div>
        </div>

        <div class="signature">
            <p>{{ $invoice->admin_name ?? 'Sumanto (Admin)' }}</p>
            <div class="name">
                <p>____________________</p>
            </div>
        </div>
    </div>
</body>

</html>