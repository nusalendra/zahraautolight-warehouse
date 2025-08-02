<?php

namespace App\Dtos;

use App\Models\Invoice;

class TransactionDto
{
    public float $amount_transaction;
    public string $payment_method;
    public \Carbon\Carbon $transaction_date;
    public string $trx_id;

    private Invoice $invoice;

    public static function fromRequest(Invoice $invoice, float $amount_transaction, string $payment_method): self
    {
        $dto = new self();
        $dto->invoice = $invoice;
        $dto->amount_transaction = $amount_transaction;
        $dto->payment_method = $payment_method;
        $dto->transaction_date = now();

        return $dto;
    }

    public function toArray(): array
    {
        return [
            'invoice_id' => $this->invoice->id,
            'trx_id' => $this->formatTrxId($this->invoice->nomor_invoice),
            'amount_transaction' => $this->amount_transaction,
            'payment_method' => $this->payment_method,
            'transaction_date' => $this->transaction_date,
        ];
    }

    private function formatTrxId(string $nomor_invoice): string
    {
        $trxNumber = preg_replace('/[^0-9]/', '', substr($nomor_invoice, 4));
        $timestamp = now()->format('His');
        $random = mt_rand(100, 999);

        return $this->trx_id = 'trx-' . $random . $trxNumber . $timestamp;
    }
}
