<?php

namespace App\Http\Controllers\monitoring_produk;

use App\Http\Controllers\Controller;
use App\Http\Services\MerekService;
use App\Http\Services\ProdukService;
use App\Models\User;
use App\Repositories\LogStokProdukRepo;
use Illuminate\Http\Request;

class TambahStokProduk extends Controller
{
    private MerekService $merekService;
    private ProdukService $produkService;
    private LogStokProdukRepo $logStokProduk;

    public function __construct(
        MerekService $merekService,
        ProdukService $produkService,
        LogStokProdukRepo $logStokProduk
    ) {
        $this->merekService = $merekService;
        $this->produkService = $produkService;
        $this->logStokProduk = $logStokProduk;
    }

    public function index()
    {
        $listMerek = $this->merekService->fetchAll();
        $listProduk = $this->produkService->fetchDataToday();
        $logStokProduk = $this->logStokProduk->fetchToday();

        return view('content.monitoring-produk.tambah-stok-produk.index', compact('listMerek', 'listProduk', 'logStokProduk'));
    }
}
