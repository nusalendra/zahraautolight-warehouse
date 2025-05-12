<?php

namespace App\Actions;

class InvoiceItems
{
    public static function calculateItemPrice(array $items)
    {
        $subtotal = 0;

        foreach ($items as $item) {
            $subtotal += $item['qty'] * $item['harga'];
        }

        return [
            'subtotal' => $subtotal,
            'total' => $subtotal,
            'sisa_tagihan' => $subtotal
        ];
    }
}
