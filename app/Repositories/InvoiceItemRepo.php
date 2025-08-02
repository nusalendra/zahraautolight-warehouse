<?php

namespace App\Repositories;

use App\Models\InvoiceItem;

class InvoiceItemRepo
{
    public function create(array $items): void
    {
        foreach ($items as $item) {
            InvoiceItem::create($item);
        }
    }
}
