<?php

namespace App\Http\Services;

use App\Dtos\InvoiceDto;
use App\Dtos\LogStokProductDto;
use App\Helpers\SendWhatsapp;
use App\Repositories\InvoiceRepo;
use App\Repositories\LogStokProdukRepo;
use App\Repositories\ProdukRepo;

class ProdukService
{
    private ProdukRepo $produkRepo;
    private LogStokProdukRepo $logStokProdukRepo;
    private InvoiceRepo $invoiceRepo;

    public function __construct(ProdukRepo $produkRepo, LogStokProdukRepo $logStokProdukRepo, InvoiceRepo $invoiceRepo)
    {
        $this->produkRepo = $produkRepo;
        $this->logStokProdukRepo = $logStokProdukRepo;
        $this->invoiceRepo = $invoiceRepo;
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

        $logIds = [];
        $whatsappData = [];
        $invoiceItems = [];
        $idInvoice = 0;

        foreach ($data as $produk) {
            if ($produk['type'] == 'add_stock') {
                $response = $this->produkRepo->addStockProduct($produk);
            } elseif ($produk['type'] == 'reduce_stock') {
                $response = $this->produkRepo->reduceStockProduct($produk);

                $tanggalInvoice = $produk['tanggal_invoice'];
                $mitraId = $produk['mitra_id'];
                $invoiceItems[] = [
                    'produk_id' => $response['data']['id'],
                    'qty' => $produk['stok'],
                    'harga' => $response['data']['harga'],
                ];

                $whatsappData[] = $response['data'];
            }

            $produk['harga'] = $response['data']['harga'];

            if ($response['status'] == 1) {
                $logStokProdukDto = LogStokProductDto::fromRequest((object) $produk);
                $getIdLog = $this->logStokProdukRepo->addLog($logStokProdukDto->products);
                $logIds[] = $getIdLog;
            }
        }

        if ($invoiceItems && $mitraId && $tanggalInvoice) {
            $invoiceDto = InvoiceDto::fromRequest($invoiceItems, $mitraId, $tanggalInvoice);
            $arrayData = $invoiceDto->toArray();
            $idInvoice = $this->invoiceRepo->create($arrayData[0]);

            foreach ($logIds as $logId) {
                $this->logStokProdukRepo->updateInvoiceIdById($logId, $idInvoice);
            }

            $whatsapp = new SendWhatsapp();
            foreach ($whatsappData as $waData) {
                $send = $whatsapp->handle($waData);
            }
        }

        return [
            'status' => 'success',
            'invoice_id' => $idInvoice
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
