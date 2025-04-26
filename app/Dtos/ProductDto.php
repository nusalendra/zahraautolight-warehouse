<?php

namespace App\Dtos;

class ProductDto
{
    public int $merek_id;
    public string $nama_produk;
    public int $jumlah;
    public int $harga;
    public array $products;

    public static function fromRequest($request): self
    {
        $dto = new self();

        $dto->merek_id = $request->merek_id ?? 0;
        if ($dto->merek_id == 0) {
            throw new \Exception('Id Merek tidak ditemukan');
        }

        $nama_produk = $request->nama_produk ?? "";
        $jumlah = $request->jumlah ?? 0;
        $harga = $request->harga ?? 0;

        $dto->products = [];

        foreach ($nama_produk as $index => $namaProduk) {
            if (isset($jumlah[$index]) && isset($harga[$index])) {
                $dto->products[] = [
                    'merek_id' => $dto->merek_id,
                    'nama' => $namaProduk,
                    'stok' => (int) $jumlah[$index],
                    'harga' => (int) $harga[$index],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        return $dto;
    }
}
