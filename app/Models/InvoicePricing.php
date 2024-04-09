<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePricing extends Model
{
    use HasFactory;

    protected $fillable = ['invoice', 'start', 'end', 'route', 'vehicletype', 'discount', 'journey_price', 'driver_price', 'km', 'extra', 'waiting'];

    public function startdata()
    {
        return $this->hasOne(Location::class, 'id', 'start');
    }

    public function enddata()
    {
        return $this->hasOne(Location::class, 'id', 'end');
    }

    public function routedata()
    {
        return $this->hasOne(Location::class, 'id', 'route');
    }

    public function vehicletypedata()
    {
        return $this->hasOne(VehicleType::class, 'id', 'vehicletype');
    }
}
