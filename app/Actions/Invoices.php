<?php

namespace App\Actions;

use App\Repositories\InvoiceRepo;

class Invoices
{
    public static function generateNoInvoice(string $tanggalInvoice)
    {
        $tahun = date('Y', strtotime($tanggalInvoice));
        $invoiceRepo = new InvoiceRepo();
        $lastInvoice = $invoiceRepo->fetchLastInvoice($tahun);

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
}
