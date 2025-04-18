<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "produks";
    protected $fillable = [
        'merek_id',
        'nama',
        'jumlah',
        'harga_satuan',
        'total'
    ];

    public function merek()
    {
        return $this->belongsTo(Merek::class, 'merek_id');
    }
}
