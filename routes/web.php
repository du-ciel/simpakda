<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('monitoring', 'monitoring')->name('monitoring');

    Route::get('vehicles/export', [VehicleController::class, 'export'])->name('vehicles.export');
    Route::resource('vehicles', VehicleController::class);
});

require __DIR__.'/settings.php';
