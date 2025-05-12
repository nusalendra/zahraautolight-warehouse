<?php

use App\Http\Controllers\API\manajemen_produk\ListProduk;
use App\Http\Controllers\API\mitra\Mitra;
use App\Http\Controllers\API\monitoring_produk\Merek;
use App\Http\Controllers\API\monitoring_produk\Produk;
use App\Http\Controllers\API\User\User;
use Illuminate\Support\Facades\Route;

Route::put('update-product/{id}', [ListProduk::class, 'update']);
Route::delete('delete-product/{id}', [ListProduk::class, 'delete']);

Route::post('add-mitra', [Mitra::class, 'store']);
Route::put('update-mitra/{id}', [Mitra::class, 'update']);
Route::delete('delete-mitra/{id}', [Mitra::class, 'destroy']);

Route::post('add-user', [User::class, 'store']);
Route::put('update-user/{id}', [User::class, 'update']);
Route::delete('delete-user/{id}', [User::class, 'delete']);

Route::post('add-merek', [Merek::class, 'store']);
Route::put('update-merek/{id}', [Merek::class, 'update']);
Route::delete('delete-merek/{id}', [Merek::class, 'delete']);

Route::get('/get-product-by-merek/{merekId}', [Produk::class, 'getProductByMerek']);
Route::post('add-product', [Produk::class, 'store']);
Route::post('process-stock-product', [Produk::class, 'processStockProduct']);
