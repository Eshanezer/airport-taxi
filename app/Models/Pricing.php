<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = ['start', 'end', 'route', 'vehicletype', 'journey_price', 'driver_price', 'km', 'status','extra','waiting'];

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Blocked', 4 => 'Deleted'];

    public static function laratablesStatus($pricing)
    {
        return '<span class="badge badge-' . (new Colors)->getColor($pricing['status']) . '">' . self::$status[$pricing['status']] . '</span>';
    }

    public static function laratablesCustomAction($pricing)
    {
        return '<i onclick="doEdit(' . $pricing['id'] . ')" class="la la-edit ml1 text-warning"></i><i onclick="doDelete(' . $pricing['id'] . ')" class="la la-trash ml-1 text-danger"></i>';
    }

    public static function laratablesStart($pricing)
    {
        return ($pricing->startdata) ? (($pricing->startdata->status == 4) ? '<strong>' . $pricing->startdata->location . '</strong>' : $pricing->startdata->location) : '<span class="badge badge-danger">N/A</span>';
    }

    public static function laratablesEnd($pricing)
    {
        return ($pricing->enddata) ? (($pricing->enddata->status == 4) ? '<strong class="text-danger">' . $pricing->enddata->location . '</strong>' : $pricing->enddata->location) : '<span class="badge badge-danger">N/A</span>';
    }

    public static function laratablesRoute($pricing)
    {
        return ($pricing->routedata) ? $pricing->routedata->location : '<span class="badge badge-danger">N/A</span>';
    }

    public static function laratablesJourneyPrice($pricing)
    {
        return format_currency($pricing->journey_price);
    }

    public static function laratablesDriverPrice($pricing)
    {
        return format_currency($pricing->driver_price);
    }

    public static function laratablesVehicletype($pricing)
    {
        return ($pricing->vehicletypedata) ? (($pricing->vehicletypedata->status == 4) ? '<strong class="text-danger">' . $pricing->vehicletypedata->type . '</strong>' : $pricing->vehicletypedata->type) : '<span class="badge badge-danger">N/A</span>';
    }

    public static function laratableskm($pricing)
    {
        return ($pricing->km) ? $pricing->km : '<span class="badge badge-danger">N/A</span>';
    }

    public static function laratablesSearchableColumns()
    {
        return ['startdata.location', 'enddata.location', 'routedata.location', 'vehicletypedata.type', 'journey_price', 'driver_price', 'km'];
    }

    public static function laratablesQueryConditions($query)
    {
        return $query->whereIn('status', [1, 2])->with('startdata')->with('enddata')->with('routedata')->with('vehicletypedata');
    }

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
