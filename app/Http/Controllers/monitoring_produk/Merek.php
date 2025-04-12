<?php

namespace App\Http\Controllers\monitoring_produk;

use App\Http\Controllers\Controller;
use App\Http\Services\MerekService;
use App\Models\User;
use Illuminate\Http\Request;

class Merek extends Controller
{
    private MerekService $service;

    public function __construct(MerekService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->fetchAll();

        return view('content.monitoring-barang.merek-barang.index', compact('data'));
    }
}
