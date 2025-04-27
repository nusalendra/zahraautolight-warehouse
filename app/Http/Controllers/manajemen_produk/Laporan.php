<?php

namespace App\Http\Controllers\manajemen_produk;

use App\Http\Controllers\Controller;
use App\Repositories\LogStokProdukRepo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class Laporan extends Controller
{
    private string $type_stock = 'reduce_stock';

    public function index()
    {
        $logStokProduk = new LogStokProdukRepo();
        $data = $logStokProduk->fetchByTypeStock($this->type_stock);

        return view('content.manajemen-produk.laporan.index', compact('data'));
    }

    public function cetakLaporan(Request $request)
    {
        $logStokProdukRepo = new LogStokProdukRepo();
        $data = $logStokProdukRepo->fetchByTanggal($this->type_stock, $request->start_date, $request->end_date);

        $pdf = Pdf::loadView('content.manajemen-produk.laporan.cetak-laporan', [
            'title' => 'Laporan Hari Ini',
            'data' => $data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        $pdf->setPaper('A4', 'potrait');

        return $pdf->stream('report-online.pdf');
    }
}
