<?php

namespace App\Helpers\Discord;

use Illuminate\Support\Facades\Http;

class SendDiscord
{
    public function handle(array $data)
    {
        $url = env('WEBHOOK_URI_DISCORD');

        \Carbon\Carbon::setLocale('id');
        $waktu = now()->translatedFormat('d F Y, H:i') . ' WIB';

        $message = "📋 **NOTIFIKASI PENGELUARAN PRODUK**\n\n"
            . "**Merek:** {$data['merek']['nama']}\n"
            . "**Produk:** {$data['nama']}\n"
            . "**Jumlah:** {$data['reduce_stock']} item\n"
            . "**Harga Satuan:** Rp " . number_format($data['harga'], 0, ',', '.') . "\n"
            . "**Total:** Rp " . number_format($data['harga'] * $data['reduce_stock'], 0, ',', '.') . "\n"
            . "**Stok Tersisa:** {$data['stok']} item\n\n"
            . "**Waktu:** {$waktu}\n"
            . "**Catatan:** Stok telah diperbarui dalam sistem";

        $response = Http::post($url, [
            'content' => $message
        ]);

        if($response->successful()){
            return [
                'status' => 1,
                'message' => $data['nama'] . ' Berhasil mengirim notifikasi ke Discord',
            ];
        } else {
            return [
                'status' => 0,
                'message' => $data['nama'] . 'Gagal mengirim notifikasi ke Discord',
            ];
        }
    }
}