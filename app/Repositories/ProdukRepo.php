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
            'status' => 1,
            'data' => $produk
        ];
    }

    public function reduceStockProduct(array $data)
    {
        $produk = Produk::find($data['id']);
        $produk->stok -= $data['stok'];
        $produk->save();

        return [
            'status' => 1,
            'data' => $produk
        ];
    }

    public function update(int $id, array $data)
    {
        $produk = Produk::find($id);

        if (empty($produk)) {
            return [
                'status' => 'error',
                'message' => 'Produk Tidak Ditemukan'
            ];
        }

        if ($data['merek_id'] == 0) {
            $data['merek_id'] = $produk->merek_id;
        }

        $produk->update([
            'merek_id' => $data['merek_id'],
            'nama' => $data['nama'] ?? $produk->nama,
            'harga' => $data['harga'] ?? $produk->harga
        ]);

        return [
            'status' => 'success',
            'message' => 'Produk berhasil diperbarui'
        ];
    }

    public function delete($id)
    {
        $produk = Produk::find($id);

        if (empty($produk)) {
            return [
                'status' => 'error',
                'message' => 'Produk Tidak Ditemukan'
            ];
        }

        $produk->delete();

        return [
            'status' => 'success',
            'message' => 'Produk berhasil dihapus'
        ];
    }

    public function fetchById(int $id)
    {
        return Produk::find($id);
    }

    public function fetchTotalProduct()
    {
        return Produk::count();
    }

    public function fetchLowStockProducts()
    {
        return Produk::where('stok', '<=', 3)->get();
    }
}
