<?php

namespace App\Http\Controllers\manajemen_produk;

use App\Http\Controllers\API\monitoring_produk\Merek;
use App\Http\Controllers\Controller;
use App\Http\Services\MerekService;
use App\Models\Produk;
use App\Repositories\MerekRepo;
use Illuminate\Http\Request;

class ListProduk extends Controller
{
    public function index()
    {
        $data = Produk::all();
        $merekRepo = new MerekRepo();
        $listMerek = $merekRepo->fetch();

        return view('content.manajemen-produk.list-produk.index', compact('data', 'listMerek'));
    }
}
