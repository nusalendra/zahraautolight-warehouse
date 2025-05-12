<?php

namespace App\Repositories;

use App\Models\Invoice;

class InvoiceRepo
{
    public function create(array $data)
    {
        $invoice = Invoice::create($data);

        return $invoice->id;
    }

    public function fetchLastInvoice(string $tahun)
    {
        return Invoice::whereYear('tanggal_invoice', $tahun)
            ->orderBy('nomor_invoice', 'desc')
            ->first();
    }

    public function fetchById(int $id)
    {
        return Invoice::where('id', $id)
            ->with('logStokProduk')
            ->with('mitra')
            ->first();
    }
}
