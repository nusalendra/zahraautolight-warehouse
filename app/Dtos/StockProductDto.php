<?php

namespace App\Dtos;

use Illuminate\Http\Request;

class StockProductDto
{
    public int $produk_id;
    public int $merek_id;
    public int $stok;
    public string $type_stock;
    public array $products;

    public static function fromRequest(Request $request): self
    {
        $dto = new self();

        $dto->merek_id = $request->merek_id ?? 0;
        if ($dto->merek_id == 0) {
            throw new \Exception('Id Merek tidak ditemukan');
        }

        $produk_id = $request->produk_id ?? "";
        $stok = $request->jumlah ?? 0;

        $dto->products = [];

        foreach ($produk_id as $index => $id) {
            $dto->products[] = [
                'id' => $id,
                'merek_id' => $dto->merek_id,
                'stok' => (int) $stok[$index],
                'type_stock' => $request->query('type_stock')
            ];
        }

        return $dto;
    }
}
