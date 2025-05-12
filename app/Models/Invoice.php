<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoices";
    protected $fillable = [
        'mitra_id',
        'nomor_invoice',
        'tanggal_invoice',
        'status',
        'subtotal',
        'total',
        'sisa_tagihan'
    ];

    public function logStokProduk()
    {
        return $this->hasMany(LogStokProduk::class, 'invoice_id');
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }
}
