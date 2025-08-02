<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepo
{
    public function fetchById(int $id): Transaction
    {
        return Transaction::where('id', $id)->first();
    }
    public function add(array $params): Transaction
    {
        $dataTransaction = Transaction::create($params);
        (new InvoiceRepo)->updateInvoiceAfterPayment($params['invoice_id'], $params['amount_transaction']);

        return $dataTransaction;
    }
}
