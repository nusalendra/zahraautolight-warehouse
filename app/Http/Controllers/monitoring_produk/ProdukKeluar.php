<?php

namespace App\Http\Controllers\monitoring_produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\MerekService;
use App\Http\Services\ProdukService;

class ProdukKeluar extends Controller
{
    private MerekService $merekService;
    private ProdukService $produkService;

    public function __construct(
        MerekService $merekService,
        ProdukService $produkService
    ) {
        $this->merekService = $merekService;
        $this->produkService = $produkService;
    }

    public function index()
    {
        $listMerek = $this->merekService->fetchAll();
        $listProduk = $this->produkService->fetchDataToday();

        return view('content.monitoring-produk.produk-keluar.index', compact('listMerek', 'listProduk'));
    }
}
