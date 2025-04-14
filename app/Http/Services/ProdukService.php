<?php

namespace App\Http\Services;

use App\Repositories\ProdukRepo;

class ProdukService
{
    private ProdukRepo $produkRepo;

    public function __construct(ProdukRepo $produkRepo)
    {
        $this->produkRepo = $produkRepo;
    }

    public function create(array $data)
    {
        try {
            foreach ($data as $produk) {
                $this->produkRepo->create($produk);
            }

            return [
                'status' => 'success',
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
        }
    }

    public function fetchDataToday()
    {
        return $this->produkRepo->fetchToday();
    }
}
