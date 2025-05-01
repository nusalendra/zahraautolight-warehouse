<?php

namespace App\Repositories;

use App\Models\LogStokProduk;
use Carbon\Carbon;
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

    public function getTotalProductStockOut()
    {
        return LogStokProduk::where('type', 'reduce_stock')
            ->where('status', 'success')
            ->sum('stok');
    }

    public function getMonthlyIncomeProductOut()
    {
        $currentYear = Carbon::now()->year;

        $monthlyRevenue = DB::table('log_stok_produks')
            ->selectRaw("MONTH(created_at) as month, SUM(stok * harga) as total_pendapatan")
            ->where('type', 'reduce_stock')
            ->where('status', 'success')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $monthlyRevenue->firstWhere('month', $i);
            $revenueData[] = $monthData ? (int) $monthData->total_pendapatan : 0;
        }

        return $revenueData;
    }
}
