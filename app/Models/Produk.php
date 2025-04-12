<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "produks";
    protected $fillable = [
        'merek_id',
        'nama'
    ];

    public function merek()
    {
        return $this->belongsTo(Merek::class, 'merek_id');
    }
}
