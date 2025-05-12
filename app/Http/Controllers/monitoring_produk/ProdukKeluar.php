<?php

namespace App\Http\Controllers\monitoring_produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\MerekService;
use App\Http\Services\MitraService;
use App\Http\Services\ProdukService;
use App\Repositories\LogStokProdukRepo;

class ProdukKeluar extends Controller
{
    private MerekService $merekService;
    private ProdukService $produkService;
    private LogStokProdukRepo $logStokProduk;
    private MitraService $mitraService;

    public function __construct(
        MerekService $merekService,
        ProdukService $produkService,
        LogStokProdukRepo $logStokProduk,
        MitraService $mitraService
    ) {
        $this->merekService = $merekService;
        $this->produkService = $produkService;
        $this->logStokProduk = $logStokProduk;
        $this->mitraService = $mitraService;
    }

    public function index()
    {
        $listMerek = $this->merekService->fetchAll();
        $listProduk = $this->produkService->fetchDataToday();
        $logStokProduk = $this->logStokProduk->fetchToday($type_stock = 'reduce_stock');
        $listMitra = $this->mitraService->fetchAll();

        return view('content.monitoring-produk.produk-keluar.index', compact('listMerek', 'listProduk', 'logStokProduk', 'listMitra'));
    }
}
