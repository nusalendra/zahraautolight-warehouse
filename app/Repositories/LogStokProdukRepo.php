<?php

namespace App\Repositories;

use App\Models\LogStokProduk;

class LogStokProdukRepo
{
    public function addLog(array $data)
    {
        return LogStokProduk::insert($data);
    }

    public function fetchToday()
    {
        return LogStokProduk::whereDate('created_at', today())->get();
    }
}
