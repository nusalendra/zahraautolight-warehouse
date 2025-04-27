<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #fff;
            line-height: 1.6;
        }

        .container {
            margin: 20px auto;
            max-width: 900px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: #2c3e50;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #2c3e50;
            color: #fff;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 12px;
            color: #555;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header button {
            background-color: #2c3e50;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .header button:hover {
            background-color: #34495e;
        }

        .total-summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #ecf0f1;
            border-left: 4px solid #2c3e50;
            font-size: 16px;
            color: #2c3e50;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .report-date {
            margin-top: -10px;
            font-size: 16px;
            color: #7f8c8d;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div>
        <div class="header">
            <h1>Laporan Produk</h1>
            @if (isset($start_date) && isset($end_date))
            <p class="report-date">
                {{ \Carbon\Carbon::parse($start_date)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->format('d F Y') }}
            </p>
            @endif
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Merek</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Stok Keluar</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <h6>{{ $item->produk->merek->nama }}</h6>
                    </td>
                    <td>{{ $item->produk->nama }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->total_stok }}</td>
                    <td>Rp {{ number_format($item->total_stok * $item->harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>Dicetak pada: {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>

    <script>
        function printPage() {
            window.print();
        }
    </script>
</body>

</html>