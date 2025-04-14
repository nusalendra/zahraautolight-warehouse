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

    public function update(int $id, array $data)
    {
        $merek = Produk::find($id);

        $merek->update([
            'nama' => $data['nama']
        ]);

        return true;
    }

    public function fetchToday()
    {
        return Produk::whereDate('created_at', today())->get();
    }
}
