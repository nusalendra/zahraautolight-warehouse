<?php

namespace App\Http\Controllers\transactions;

use App\Http\Services\TransactionService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class Transaction
{
    private TransactionService $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    public function previewKwitansiPdf(int $id)
    {
        $transaksi = $this->service->fetchById($id);
        $pdf = Pdf::loadView('content.invoice.kwitansi-transaksi', [
            'title' => 'Kwitansi Pembayaran',
            'data' => $transaksi,
            'username' => Auth::user()->username
        ]);

        $pdf->setPaper('A4', 'potrait');

        $cleanFileName = 'kwitansi_' . str_replace(['/', '\\'], '_', $transaksi->trx_id) . '.pdf';
        return $pdf->stream($cleanFileName);
    }
}
