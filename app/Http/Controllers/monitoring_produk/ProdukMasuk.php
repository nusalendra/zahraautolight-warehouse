<?php

namespace App\Http\Controllers\monitoring_produk;

use App\Http\Controllers\Controller;
use App\Http\Services\MerekService;
use App\Http\Services\ProdukService;
use App\Models\User;
use Illuminate\Http\Request;

class ProdukMasuk extends Controller
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

        return view('content.monitoring-produk.proses-produk-masuk.index', compact('listMerek', 'listProduk'));
    }
}
