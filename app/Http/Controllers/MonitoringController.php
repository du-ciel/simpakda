<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Contracts\View\View;

class MonitoringController extends Controller
{
    public function index(): View
    {
        $today = today();
        $totalVehicle = Vehicle::count();
        $activeVehicles = Vehicle::where('status', 'aktif')->count();
        $expiredTax = Vehicle::whereDate('masa_berlaku_pajak', '<', $today)->count();
        $expiredStnk = Vehicle::whereDate('masa_berlaku_stnk', '<', $today)->count();
        $expiringSoon = Vehicle::whereBetween('masa_berlaku_pajak', [$today, $today->addDays(21)])->get();
        $inactive = Vehicle::whereIn('status', ['non_aktif', 'perbaikan', 'dijual'])->get();
        $reminderYear = $today->year;
        $vehiclesDueThisYear = Vehicle::whereBetween('masa_berlaku_pajak', [
            $today->startOfYear(),
            $today->endOfYear(),
        ])
            ->orderBy('masa_berlaku_pajak')
            ->get();
        $reminderCount = $vehiclesDueThisYear->count();

        return view('monitoring', compact(
            'totalVehicle',
            'activeVehicles',
            'expiredTax',
            'expiredStnk',
            'expiringSoon',
            'inactive',
            'reminderYear',
            'vehiclesDueThisYear',
            'reminderCount',
        ));
    }
}
