<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $table = "mereks";
    protected $fillable = [
        'nama'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'merek_id');
    }
}
