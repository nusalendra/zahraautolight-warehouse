<?php

namespace App\Actions;

use App\Dtos\TransactionDto;
use App\Models\Invoice;
use App\Repositories\InvoiceRepo;
use App\Repositories\TransactionRepo;

class TransactionAction
{
    private TransactionRepo $transactionRepo;
    private Invoice $invoice;

    public function __construct(TransactionRepo $transactionRepo, Invoice $invoice)
    {
        $this->transactionRepo = $transactionRepo;
        $this->invoice = $invoice;
    }

    public function handle(array $data)
    {
        $res = $this->addTransaction($data);

        return [
            'status' => 1,
            'message' => 'Transaksi Berhasil di proses',
            'transaction' => $res->toArray()
        ];
    }

    private function addTransaction(array $data)
    {
        $dto = TransactionDto::fromRequest($this->invoice, $data['amount_transaction'], $data['payment_method']);
        return $this->transactionRepo->add($dto->toArray());
    }
}
