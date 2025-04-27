<?php

namespace App\Http\Controllers\API\monitoring_produk;

use App\Dtos\StockProductDto;
use App\Dtos\ProductDto;
use App\Http\Controllers\Controller;
use App\Http\Services\ProdukService;
use Illuminate\Http\Request;

class Produk extends Controller
{
    private ProdukService $produkService;

    public function __construct(ProdukService $produkService)
    {
        $this->produkService = $produkService;
    }

    public function getProductByMerek($merekId)
    {
        try {
            if (!$merekId) {
                throw new \Exception('MerekId not found');
            }

            $result = $this->produkService->fetchByMerekId($merekId);

            return [
                'status' => 'success',
                'data' => $result
            ];
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $productDto = ProductDto::fromRequest($request);
            $result = $this->produkService->create($productDto->products);

            if ($result['status'] == 'error') {
                throw new \Exception($result['message']);
            }

            return $result;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function processStockProduct(Request $request)
    {
        try {
            $productDto = StockProductDto::fromRequest($request);
            $result = $this->produkService->processStock($productDto->type_stock, $productDto->products);

            return $result;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}
