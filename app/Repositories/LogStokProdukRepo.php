<?php

namespace App\Repositories;

use App\Models\LogStokProduk;

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
}
