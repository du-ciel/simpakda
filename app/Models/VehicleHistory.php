<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'user_id',
        'action',
        'changes',
    ];

    protected function casts(): array
    {
        return [
            'changes' => 'array',
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
