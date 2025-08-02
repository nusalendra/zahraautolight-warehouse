<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use App\Http\Services\InvoiceService;
use App\Repositories\InvoiceRepo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Invoice extends Controller
{
    private InvoiceService $service;

    public function __construct(InvoiceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->fetchAll();

        if (Auth::user()->role_id == 1) {
            return view('content.invoice.index', compact('data'));
        }

        return view('content.list-invoice.index', compact('data'));
    }

    public function payInvoice(int $id)
    {
        $invoice = $this->service->fetchById($id);

        return view('content.invoice.pay-invoice', compact('invoice'));
    }

    public function previewPdf(int $id)
    {
        $invoice = $this->service->fetchById($id);

        $pdf = Pdf::loadView('content.list-invoice.preview-pdf', [
            'title' => 'Laporan Hari Ini',
            'data' => $invoice,
        ]);

        $pdf->setPaper('A4', 'potrait');

        $cleanFileName = str_replace(['/', '\\'], '_', $invoice->nomor_invoice);
        return $pdf->stream($cleanFileName . '.pdf');
    }

    public function show(int $id)
    {
        $invoice = $this->service->fetchById($id);

        return view('content.list-invoice.show', compact('invoice'));
    }
}
