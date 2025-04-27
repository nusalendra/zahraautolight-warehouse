<?php

namespace App\Dtos;

class LogStokProductDto
{
    public int $produk_id;
    public int $stok;
    public int $harga;
    public array $products;

    public static function fromRequest(object $request): self
    {
        $dto = new self();

        $dto->produk_id = $request->id ?? 0;
        $dto->harga = $request->harga ?? 0;

        if ($dto->produk_id == 0) {
            throw new \Exception('Id Produk tidak ditemukan');
        }

        $dto->products[] = [
            'produk_id' => $dto->produk_id,
            'type' => $request->type,
            'status' => 'success',
            'stok' => $request->stok,
            'harga' => $dto->harga,
            'created_at' => now(),
            'updated_at' => now()
        ];

        return $dto;
    }
}
