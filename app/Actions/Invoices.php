<?php

namespace App\Actions;

use App\Models\Invoice;
use App\Repositories\InvoiceRepo;
use Exception;

class Invoices
{
    private InvoiceRepo $invoiceRepo;

    public function __construct(InvoiceRepo $invoiceRepo)
    {
        $this->invoiceRepo = $invoiceRepo;
    }

    public function generateNoInvoice(string $tanggalInvoice): string
    {
        $tahun = date('Y', strtotime($tanggalInvoice));
        $lastInvoice = $this->invoiceRepo->fetchLastInvoice($tahun);

        if ($lastInvoice) {
            $parts = explode('/', $lastInvoice->nomor_invoice);
            $lastNumber = (int) $parts[2];
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $nomorUrut = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        $nomorInvoice = "INV/{$tahun}/{$nomorUrut}";

        return $nomorInvoice;
    }

    public function validateInvoice(int $invoice_id, float $amount_transaction): Invoice
    {
        $invoice = $this->invoiceRepo->fetchById($invoice_id);

        if (empty($invoice))
            throw new Exception('Invoice tidak ditemukan');

        if ($invoice->status == 'paid')
            throw new Exception('Invoice sudah paid');

        if ($amount_transaction > $invoice->total)
            throw new Exception('Nominal pembayaran melebihi total pembayaran invoice');

        return $invoice;
    }
}
