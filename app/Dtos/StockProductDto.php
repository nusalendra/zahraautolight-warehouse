<?php

namespace App\Dtos;

use Illuminate\Http\Request;

class StockProductDto
{
    public string $type_stock;
    public array $products;

    public static function fromRequest(Request $request): self
    {
        $dto = new self();

        $merek_id = $request->merek_id ?? 0;
        if ($merek_id == 0) {
            throw new \Exception('Id Merek tidak ditemukan');
        }

        $produk_id = $request->produk_id ?? "";
        $stok = $request->jumlah ?? 0;
        $dto->type_stock = $request->query('type_stock');

        $dto->products = [];

        foreach ($produk_id as $index => $id) {
            $dto->products[] = [
                'id' => $id,
                'merek_id' => $merek_id,
                'stok' => (int) $stok[$index],
                'type' => $dto->type_stock
            ];
        }

        return $dto;
    }
}
