<?php

namespace App\Repositories;

use App\Models\Merek;

class MerekRepo
{
    public function fetch()
    {
        return Merek::all();
    }

    public function create(array $data)
    {
        return Merek::insert($data);
    }

    public function update(int $id, array $data)
    {
        $merek = Merek::find($id);

        $merek->update([
            'nama' => $data['nama']
        ]);

        return true;
    }

    public function delete(int $id)
    {
        $merek = Merek::find($id);

        if ($merek->produk()->exists()) {
            return response()->json(['message' => 'Merek masih memiliki produk dan tidak dapat dihapus.'], 400);
        }

        $merek->delete();

        return response()->json(null, 200);
    }
}
