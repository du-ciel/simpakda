<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = today();
        $totalVehicle = Vehicle::count();
        $activeVehicles = Vehicle::where('status', 'aktif')->count();
        $expiredTax = Vehicle::whereDate('masa_berlaku_pajak', '<', $today)->count();
        $expiredStnk = Vehicle::whereDate('masa_berlaku_stnk', '<', $today)->count();
        $activePercentage = $totalVehicle > 0 ? round(($activeVehicles / $totalVehicle) * 100) : 0;

        return view('dashboard', compact(
            'totalVehicle',
            'activeVehicles',
            'expiredTax',
            'expiredStnk',
            'activePercentage',
        ));
    }
}
