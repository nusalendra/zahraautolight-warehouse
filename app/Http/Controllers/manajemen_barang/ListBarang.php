<?php

namespace App\Http\Controllers\manajemen_barang;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ListBarang extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('content.manajemen-barang.list-barang.index', compact('data'));
    }
}
