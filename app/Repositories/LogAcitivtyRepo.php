<?php

namespace App\Repositories;

use App\Models\LogActivity;

class LogAcitivtyRepo {
    public function create(array $data): LogActivity{
        return LogActivity::create($data);
    }
}