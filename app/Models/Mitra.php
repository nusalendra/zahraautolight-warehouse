<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $table = "mitras";
    protected $fillable = [
        'badan_usaha',
        'nama',
        'email',
        'nomor_telepon'
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'invoice_id');
    }
}
