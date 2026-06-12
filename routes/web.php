<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
    Route::prefix('master')->group(function () {
        Route::get('/toko', [MasterController::class, 'indexTableA'])->name('toko.index');
        Route::get('/toko/create', [MasterController::class, 'createTableA'])->name('toko.create');
        Route::post('/toko', [MasterController::class, 'storeTableA'])->name('toko.store');
        Route::get('/toko/{id}/edit', [MasterController::class, 'editTableA'])->name('toko.edit');
        Route::put('/toko/{id}', [MasterController::class, 'updateTableA'])->name('toko.update');
        Route::delete('/toko/{id}', [MasterController::class, 'destroyTableA'])->name('toko.destroy');

        Route::get('/area', [MasterController::class, 'indexTableC'])->name('area.index');
        Route::get('/area/create', [MasterController::class, 'createTableC'])->name('area.create');
        Route::post('/area', [MasterController::class, 'storeTableC'])->name('area.store');
        Route::get('/area/{id}/edit', [MasterController::class, 'editTableC'])->name('area.edit');
        Route::put('/area/{id}', [MasterController::class, 'updateTableC'])->name('area.update');
        Route::delete('/area/{id}', [MasterController::class, 'destroyTableC'])->name('area.destroy');

        Route::get('/sales', [MasterController::class, 'indexTableD'])->name('sales.index');
        Route::get('/sales/create', [MasterController::class, 'createTableD'])->name('sales.create');
        Route::post('/sales', [MasterController::class, 'storeTableD'])->name('sales.store');
        Route::get('/sales/{id}/edit', [MasterController::class, 'editTableD'])->name('sales.edit');
        Route::put('/sales/{id}', [MasterController::class, 'updateTableD'])->name('sales.update');
        Route::delete('/sales/{id}', [MasterController::class, 'destroyTableD'])->name('sales.destroy');
    });

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/export/excel', [TransaksiController::class, 'exportExcel'])->name('transaksi.export_excel');
Route::get('/transaksi/export/pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.export_pdf');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi/manual', [TransaksiController::class, 'store'])->name('transaksi.store_manual');
Route::post('/transaksi/excel', [TransaksiController::class, 'importExcel'])->name('transaksi.store_excel');
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');

Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
