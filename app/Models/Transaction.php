<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";
    public $timestamps = false;
    protected $fillable = [
        'invoice_id',
        'trx_id',
        'transaction_date',
        'amount_transaction',
        'payment_method',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
