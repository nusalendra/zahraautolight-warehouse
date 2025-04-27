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

    public function processStock(string $type_stock, array $data)
    {
        if ($type_stock == 'reduce_stock') {
            $checkStockReady = $this->checkStockReady($data);

            if ($checkStockReady['status'] == 0) {
                $productDetails = array_map(function ($product) {
                    return $product['name'] . ' (Stok Tersedia: ' . $product['remainingStock'] . ')';
                }, $checkStockReady['products']);

                $productList = implode(', ', $productDetails);

                throw new \Exception('Stok tidak mencukupi untuk produk: ' . $productList);
            }
        }

        foreach ($data as $produk) {
            if ($produk['type'] == 'add_stock') {
                $response = $this->produkRepo->addStockProduct($produk);
            } elseif ($produk['type'] == 'reduce_stock') {
                $response = $this->produkRepo->reduceStockProduct($produk);
            }

            $produk['harga'] = $response['data']->harga;

            if ($response['status'] == 1) {
                $logStokProdukDto = LogStokProductDto::fromRequest((object) $produk);
                $addLogStokProduk = $this->logStokProdukRepo->addLog($logStokProdukDto->products);
            }
        }

        return [
            'status' => 'success',
        ];
    }

    public function fetchByMerekId(int $id)
    {
        return $this->produkRepo->fetchProductByMerekId($id);
    }

    public function update(int $id, array $data)
    {
        $response = $this->produkRepo->update($id, $data[0]);
        if ($response['status'] == 'error') {
            throw new \Exception($response['message']);
        }

        return [
            'status' => 'success'
        ];
    }

    public function deleteProduct(int $id)
    {
        $response = $this->produkRepo->delete($id);
        if ($response['status'] == 'error') {
            throw new \Exception($response['message']);
        }

        return [
            'status' => 'success'
        ];
    }

    private function checkStockReady(array $data)
    {
        $productsLowStock = [];

        foreach ($data as $product) {
            $fetchProduct = $this->produkRepo->fetchById($product['id']);

            if ($fetchProduct->stok < $product['stok']) {
                $productsLowStock[] = [
                    'name' => $fetchProduct->nama,
                    'requestedStock' => $product['stok'],
                    'remainingStock' => $fetchProduct->stok
                ];
            }
        }

        return [
            'status' => empty($productsLowStock) ? 1 : 0,
            'products' => $productsLowStock
        ];
    }
}
