<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'description', 'path', 'status'];

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Blocked', 4 => 'Deleted'];

    public static function laratablesAdditionalColumns()
    {
        return ['id'];
    }

    public static function laratablesPath($type)
    {
        return '<img style="height:30px; width:30px;"
        class="media-object rounded-circle"
        src="' . getUploadsPath($type->path) . '"
        alt="Avatar">';
    }

    public static function laratablesStatus($type)
    {
        return '<span class="badge badge-' . (new Colors)->getColor($type['status']) . '">' . self::$status[$type['status']] . '</span>';
    }

    public static function laratablesCustomAction($type)
    {
        return '<i onclick="doEdit(' . $type['id'] . ')" class="la la-edit ml1 text-warning"></i><i onclick="doDelete(' . $type['id'] . ')" class="la la-trash ml-1 text-danger"></i>';
    }

    public static function laratablesQueryConditions($query)
    {
        return $query->whereIn('status', [1, 2]);
    }
}
