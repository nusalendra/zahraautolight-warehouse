<?php

namespace App\Http\Services;

use App\Actions\Invoices;
use App\Actions\TransactionAction;
use App\Repositories\InvoiceRepo;
use App\Repositories\TransactionRepo;
use Exception;

class InvoiceService
{
    private InvoiceRepo $invoiceRepo;
    private TransactionRepo $transactionRepo;

    public function __construct(
        InvoiceRepo $invoiceRepo,
        TransactionRepo $transactionRepo
    ) {
        $this->invoiceRepo = $invoiceRepo;
        $this->transactionRepo = $transactionRepo;
    }

    public function fetchAll()
    {
        return $this->invoiceRepo->all();
    }

    public function fetchById(int $id)
    {
        return $this->invoiceRepo->fetchById($id);
    }

    public function handlePayment(array $data)
    {
        $invoice = (new Invoices($this->invoiceRepo))->validateInvoice($data['invoice_id'], $data['amount_transaction']);
        $responsePayment = (new TransactionAction($this->transactionRepo, $invoice))->handle($data);

        if ($responsePayment['status'] != 1)
            throw new Exception('Transaksi gagal karena kesalahan yang tidak diketahui');

        return [
            'status' => $responsePayment['status'],
            'message' => $responsePayment['message'],
            'transaction' => $responsePayment['transaction'],
        ];
    }
}
