<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class SendWhatsapp
{
    public function handle(array $data)
    {
        $url = env('BASE_URI_WHATSAPP') . '/send-message';
        $phone = env('PHONE_WHATSAPP');

        \Carbon\Carbon::setLocale('id');
        $waktu = now()->translatedFormat('d F Y, H:i') . ' WIB';

        $message = "📋 *NOTIFIKASI PENGELUARAN PRODUK*\n\n"
            . "*Merek:* {$data['merek']['nama']}\n"
            . "*Produk:* {$data['nama']}\n"
            . "*Jumlah:* {$data['reduce_stock']} item\n"
            . "*Harga Satuan:* Rp " . number_format($data['harga'], 0, ',', '.') . "\n"
            . "*Total:* Rp " . number_format($data['harga'] * $data['reduce_stock'], 0, ',', '.') . "\n"
            . "*Stok Tersisa:* {$data['stok']} item\n\n"
            . "*Waktu:* {$waktu}\n"
            . "*Catatan:* Stok telah diperbarui dalam sistem.";

        $response = Http::post($url, [
            'phone' => $phone,
            'message' => $message
        ]);

        if ($response->successful()) {
            return [
                'status' => 1,
            ];
        } else {
            return [
                'status' => 0,
            ];
        }
    }
}
