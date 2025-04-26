<?php

use App\Http\Controllers\API\monitoring_produk\Merek;
use App\Http\Controllers\API\monitoring_produk\Produk;
use Illuminate\Support\Facades\Route;

Route::post('add-merek', [Merek::class, 'store']);
Route::put('update-merek/{id}', [Merek::class, 'update']);
Route::delete('delete-merek/{id}', [Merek::class, 'delete']);

Route::get('/get-product-by-merek/{merekId}', [Produk::class, 'getProductByMerek']);
Route::post('add-product', [Produk::class, 'store']);
Route::post('process-stock-product', [Produk::class, 'processStockProduct']);
