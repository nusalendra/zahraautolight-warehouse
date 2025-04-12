<?php

namespace App\Http\Controllers\monitoring_produk;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProdukMasuk extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('content.monitoring-barang.barang-masuk.index', compact('data'));
    }
}
