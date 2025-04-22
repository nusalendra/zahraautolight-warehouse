<?php

namespace App\Repositories;

use App\Models\Produk;

class ProdukRepo
{
    public function fetch()
    {
        return Produk::all();
    }

    public function create(array $data)
    {
        return Produk::insert($data);
    }

    public function fetchToday()
    {
        return Produk::whereDate('created_at', today())->get();
    }

    public function fetchProductByMerekId(int $merekId)
    {
        return Produk::where('merek_id', $merekId)->get();
    }

    public function addStockProduct(array $data)
    {
        $produk = Produk::find($data['id']);
        $produk->stok += $data['stok'];
        $produk->save();

        return [
            'status' => 1
        ];
    }
}
