<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogStokProduk extends Model
{
    protected $table = "log_stok_produks";
    protected $fillable = [
        'produk_id',
        'invoice_id',
        'type',
        'status',
        'stok',
        'harga'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
