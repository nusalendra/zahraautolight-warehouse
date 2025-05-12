<?php

namespace App\Repositories;

use App\Models\Mitra;

class MitraRepo
{
    public function fetch()
    {
        return Mitra::all();
    }

    public function create(array $data)
    {
        return Mitra::insert($data);
    }

    public function update(int $id, array $data)
    {
        $mitra = Mitra::find($id);

        if (empty($mitra)) {
            return [
                'status' => 'error',
                'message' => 'Mitra tidak ditemukan'
            ];
        }

        $mitra->update([
            'badan_usaha' => $data['badan_usaha'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'nomor_telepon' => $data['nomor_telepon'],
        ]);

        return [
            'status' => 'success',
            'message' => 'Mitra berhasil di update'
        ];
    }

    public function delete(int $id)
    {
        $mitra = Mitra::find($id);

        if (empty($mitra)) {
            return [
                'status' => 'error',
                'message' => 'Mitra tidak ditemukan'
            ];
        }

        $mitra->delete();

        return [
            'status' => 'success',
            'message' => 'Mitra berhasil di hapus'
        ];
    }
}
