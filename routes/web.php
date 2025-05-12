<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\manajemen_produk\Laporan;
use App\Http\Controllers\manajemen_produk\ListProduk;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\monitoring_produk\Merek;
use App\Http\Controllers\monitoring_produk\ProdukKeluar;
use App\Http\Controllers\monitoring_produk\ProdukMasuk;
use App\Http\Controllers\monitoring_produk\TambahStokProduk;
use App\Http\Controllers\print\Invoice;
use App\Http\Controllers\users\ListUser;

// Main Page Route
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginBasic::class, 'index'])->name('login');
    Route::post('/login', [LoginBasic::class, 'login'])->name('login-store');
});

Route::middleware('auth')->group(function () {
    Route::middleware('role:Admin')->group(function () {
        Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard.index');
        Route::get('/mitra', [MitraController::class, 'index'])->name('mitra.index');
        Route::post('/logout', [LoginBasic::class, 'logout']);
        Route::prefix('manajemen-produk')->name('manajemen-produk.')->group(function () {
            Route::get('/list', [ListProduk::class, 'index'])->name('list');
            Route::get('/laporan', [Laporan::class, 'index'])->name('laporan');
        });
        Route::get('/cetak-laporan', [Laporan::class, 'cetakLaporan'])->name('cetak-laporan');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/list', [ListUser::class, 'index'])->name('list');
        });
    });

    Route::middleware('role:Karyawan')->group(function () {
        Route::prefix('monitoring-produk')->name('monitoring-produk.')->group(function () {
            Route::get('/merek', [Merek::class, 'index'])->name('merek');
            Route::get('/proses-produk-masuk', [ProdukMasuk::class, 'index'])->name('proses-produk-masuk');
            Route::get('/tambah-stok-produk', [TambahStokProduk::class, 'index'])->name('tambah-stok-produk');
            Route::get('/produk-keluar', [ProdukKeluar::class, 'index'])->name('produk-keluar');
            Route::get('/invoice', function () {
                return view('content.invoice.index');
            });
        });

        Route::get('/invoice/{id}/print', [Invoice::class, 'print'])->name('invoice.print');
    });
});
