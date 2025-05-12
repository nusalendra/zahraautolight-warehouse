<?php

namespace App\Dtos;

use App\Actions\InvoiceItems;
use App\Actions\Invoices;

class InvoiceDto
{
    public int $mitra_id;
    public string $nomor_invoice;
    public string $tanggal_invoice;
    public string $status = 'Unpaid';
    public int $subtotal;
    public int $total;
    public int $sisa_tagihan;
    public array $data;

    public static function fromRequest(array $items, int $mitraId, string $tanggalInvoice): self
    {
        $dto = new self();
        $generateNoInvoice = Invoices::generateNoInvoice($tanggalInvoice);
        $price = InvoiceItems::calculateItemPrice($items);

        $dto->nomor_invoice = $generateNoInvoice;
        $dto->mitra_id = $mitraId;
        $dto->tanggal_invoice = $tanggalInvoice;
        $dto->subtotal = $price['subtotal'];
        $dto->total = $price['total'];
        $dto->sisa_tagihan = $price['sisa_tagihan'];

        $dto->data[] = [
            'mitra_id' => $dto->mitra_id,
            'nomor_invoice' => $dto->nomor_invoice,
            'tanggal_invoice' => $dto->tanggal_invoice,
            'status' => $dto->status,
            'subtotal' => $dto->subtotal,
            'total' => $dto->total,
            'sisa_tagihan' => $dto->sisa_tagihan,
            'created_at' => now(),
            'updated_at' => now()
        ];

        return $dto;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
