<?php

namespace App\Http\Services;

use App\Dtos\LogStokProductDto;
use App\Repositories\LogStokProdukRepo;
use App\Repositories\ProdukRepo;

class ProdukService
{
    private ProdukRepo $produkRepo;
    private LogStokProdukRepo $logStokProdukRepo;

    public function __construct(ProdukRepo $produkRepo, LogStokProdukRepo $logStokProdukRepo)
    {
        $this->produkRepo = $produkRepo;
        $this->logStokProdukRepo = $logStokProdukRepo;
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

    public function processStock(array $data)
    {
        try {
            foreach ($data as $produk) {
                if ($produk['type_stock'] == 'add_stock') {
                    $response = $this->produkRepo->addStockProduct($produk);
                } elseif ($produk['type_stock'] == 'reduce_stock') {
                    $response = $this->produkRepo->reduceStockProduct($produk);
                }

                if ($response['status'] == 1) {
                    $logStokProdukDto = LogStokProductDto::fromRequest((object) $produk);
                    $addLogStokProduk = $this->logStokProdukRepo->addLog($logStokProdukDto->products);
                }
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

    public function fetchByMerekId(int $id)
    {
        return $this->produkRepo->fetchProductByMerekId($id);
    }
}
