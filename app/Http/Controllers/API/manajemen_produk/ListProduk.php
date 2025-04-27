<?php

namespace App\Http\Controllers\API\manajemen_produk;

use App\Dtos\ProductDto;
use App\Http\Controllers\Controller;
use App\Http\Services\ProdukService;
use Illuminate\Http\Request;

class ListProduk extends Controller
{
    private ProdukService $produkService;

    public function __construct(ProdukService $produkService)
    {
        $this->produkService = $produkService;
    }

    public function update($id, Request $request)
    {
        try {
            $productDto = ProductDto::fromRequestListProduct($request);
            $result = $this->produkService->update($id, $productDto->products);

            return $result;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->produkService->deleteProduct($id);

            return $result;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}
