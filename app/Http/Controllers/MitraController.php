<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\mitra\Mitra;

class MitraController extends Controller
{
    private Mitra $mitra;

    public function __construct(Mitra $mitra)
    {
        $this->mitra = $mitra;
    }

    public function index()
    {
        $data = $this->mitra->fetchAll();

        return view('content.mitra.index', compact('data'));
    }
}
