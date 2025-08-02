<?php

namespace App\Http\Services;

use App\Repositories\TransactionRepo;
use Exception;

class TransactionService
{
    private TransactionRepo $transactionRepo;

    public function __construct(
        TransactionRepo $transactionRepo
    ) {
        $this->transactionRepo = $transactionRepo;
    }

    public function fetchById(int $id)
    {
        return $this->transactionRepo->fetchById($id);
    }
}
