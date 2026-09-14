<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DepreciationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider.
|
*/

Route::view('/', 'welcome')->name('home');

Route::view('/fitur', 'fitur')->name('fitur');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        'dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Anggaran
    |--------------------------------------------------------------------------
    */

    Route::get(
        'anggaran',
        [BudgetController::class, 'index']
    )->name('anggaran');

    // Export PDF Anggaran
    Route::get(
        'anggaran/export-pdf',
        [BudgetController::class, 'exportPdf']
    )->name('anggaran.export-pdf');


    /*
    |--------------------------------------------------------------------------
    | Monitoring
    |--------------------------------------------------------------------------
    */

    Route::get(
        'monitoring',
        [MonitoringController::class, 'index']
    )->name('monitoring');


    /*
    |--------------------------------------------------------------------------
    | Kendaraan
    |--------------------------------------------------------------------------
    */

    // Export data kendaraan
    Route::get(
        'vehicles/export',
        [VehicleController::class, 'export']
    )->name('vehicles.export');

    // Menandai pajak kendaraan sudah dibayar
    Route::post(
        'vehicles/{vehicle}/tax-paid',
        [VehicleController::class, 'markTaxPaid']
    )->name('vehicles.tax-paid');

    // Resource kendaraan
    Route::resource(
        'vehicles',
        VehicleController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Penyusutan Kendaraan
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar penyusutan kendaraan
    Route::get(
        'penyusutan',
        [DepreciationController::class, 'index']
    )->name('penyusutan.index');

    // Export data penyusutan ke Excel
    //
    // PENTING:
    // Nama route harus "penyusutan.exportExcel"
    // karena digunakan oleh index.blade.php
    Route::get(
        'penyusutan/export/excel',
        [DepreciationController::class, 'exportExcel']
    )->name('penyusutan.exportExcel');

    // Form edit penyusutan kendaraan
    Route::get(
        'penyusutan/{vehicle}/edit',
        [DepreciationController::class, 'edit']
    )->name('penyusutan.edit');

    // Update data penyusutan kendaraan
    Route::put(
        'penyusutan/{vehicle}',
        [DepreciationController::class, 'update']
    )->name('penyusutan.update');
});


/*
|--------------------------------------------------------------------------
| Settings
|--------------------------------------------------------------------------
*/

require __DIR__ . '/settings.php';