<?php

namespace App\Repositories;

use App\Models\LogStokProduk;
use Illuminate\Support\Facades\DB;

class LogStokProdukRepo
{
    public function addLog(array $data)
    {
        return LogStokProduk::insert($data);
    }

    public function fetchToday(string $type)
    {
        return LogStokProduk::where('type', $type)->whereDate('created_at', today())->get();
    }

    public function fetchByTypeStock(string $type_stock)
    {
        $query = LogStokProduk::where('type', '=', $type_stock)->where('status', '=', 'success')->get();

        return $query;
    }

    public function fetchByTanggal(string $type, string $start_date, string $end_date)
    {
        $query = LogStokProduk::select(
            'produk_id',
            'harga',
            DB::raw('SUM(stok) as total_stok')
        )
            ->where('type', $type)
            ->where('status', 'success')
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->groupBy('produk_id', 'harga')
            ->get();

        return $query;
    }
}
