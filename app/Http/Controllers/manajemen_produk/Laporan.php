<?php

namespace App\Http\Controllers\manajemen_produk;

use App\Http\Controllers\Controller;
use App\Models\LogStokProduk;
use Illuminate\Http\Request;

class Laporan extends Controller
{
    public function index()
    {
        $data = LogStokProduk::all();

        return view('content.manajemen-produk.laporan.index', compact('data'));
    }
}
