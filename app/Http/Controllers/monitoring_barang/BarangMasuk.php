<?php

namespace App\Http\Controllers\monitoring_barang;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BarangMasuk extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('content.monitoring-barang.barang-masuk.index', compact('data'));
    }
}
