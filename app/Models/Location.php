<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['location', 'description', 'setdefault', 'status'];

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Blocked', 4 => 'Deleted'];

    public static function laratablesLocation($location)
    {
        return $location->location . (($location['setdefault'] == 1) ? '<span class="ml-2 badge badge-danger">Default Start Location</span>' : '');
    }

    public static function laratablesStatus($location)
    {
        return '<span class="badge badge-' . (new Colors)->getColor($location['status']) . '">' . self::$status[$location['status']] . '</span>';
    }

    public static function laratablesAdditionalColumns()
    {
        return ['setdefault'];
    }


    public static function laratablesCustomAction($location)
    {
        return '<i onclick="doEdit(' . $location['id'] . ')" class="la la-edit ml1 text-warning"></i><i onclick="doDelete(' . $location['id'] . ')" class="la la-trash ml-1 text-danger"></i>';
    }

    public static function laratablesSearchableColumns()
    {
        return ['location'];
    }

    public static function laratablesQueryConditions($query)
    {
        return $query->whereIn('status', [1, 2]);
    }
}
