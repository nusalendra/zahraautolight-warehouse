<?php

namespace App\Repositories;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;

class InvoiceRepo
{
    public function all()
    {
        return Invoice::all();
    }
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

    public function updateInvoiceAfterPayment(int $id, float $amount_transaction): void
    {
        $invoice = Invoice::find($id);

        $isFullyPaid = $amount_transaction == $invoice->sisa_tagihan;

        $invoice->update([
            'status' => $isFullyPaid ? InvoiceStatus::PAID->value : InvoiceStatus::PARTIALLY_PAID->value,
            'sisa_tagihan' => $isFullyPaid
                ? 0
                : $invoice->sisa_tagihan - $amount_transaction,
        ]);
    }
}
