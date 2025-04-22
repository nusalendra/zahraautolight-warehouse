<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogStokProduk extends Model
{
    protected $table = "log_stok_produks";
    protected $fillable = [
        'produk_id',
        'status',
        'stok',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
