<?php

namespace App\Dtos;

class InvoiceItemDto
{
    public array $items;
    public array $products;

    public static function fromRequest(array $items, int $invoice_id): self
    {
        $dto = new self();

        foreach ($items as $item) {
            $dto->items[] = [
                'invoice_id' => $invoice_id,
                'product_id' => $item['produk_id'],
                'description' => $item['nama'],
                'qty' => $item['qty'],
                'amount' => $item['harga']
            ];
        }

        return $dto;
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
