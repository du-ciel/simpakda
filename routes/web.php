<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('monitoring', [MonitoringController::class, 'index'])->name('monitoring');

    Route::get('vehicles/export', [VehicleController::class, 'export'])->name('vehicles.export');
    Route::post('vehicles/{vehicle}/tax-paid', [VehicleController::class, 'markTaxPaid'])->name('vehicles.tax-paid');
    Route::resource('vehicles', VehicleController::class);
});

require __DIR__.'/settings.php';
