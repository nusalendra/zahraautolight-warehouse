<?php

namespace App\Http\Controllers\print;

use App\Http\Controllers\Controller;
use App\Repositories\InvoiceRepo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class Invoice extends Controller
{
    public function print(int $id)
    {
        $invoiceRepo = new InvoiceRepo();
        $invoice = $invoiceRepo->fetchById($id);

        $pdf = Pdf::loadView('content.invoice.index', [
            'title' => 'Laporan Hari Ini',
            'data' => $invoice,
        ]);

        $pdf->setPaper('A4', 'potrait');

        $cleanFileName = str_replace(['/', '\\'], '_', $invoice->nomor_invoice);
        return $pdf->stream($cleanFileName . '.pdf');
    }
}
