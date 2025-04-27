<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "produks";
    protected $fillable = [
        'merek_id',
        'nama',
        'stok',
        'harga'
    ];

    public function merek()
    {
        return $this->belongsTo(Merek::class, 'merek_id');
    }

    public function logStokProduk()
    {
        return $this->hasMany(LogStokProduk::class, 'produk_id');
    }
}
