<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'address1', 'address2', 'city', 'mobile_number', 'status'];

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Blocked', 4 => 'Deleted'];

    public static function laratablesAdditionalColumns()
    {
        return ['first_name', 'last_name', 'address1', 'address2'];
    }

    public static function laratablesFirstName($data)
    {
        return $data->first_name . ' ' . $data->last_name;
    }

    public static function laratablesSearchableColumns()
    {
        return ['first_name', 'first_name'];
    }

    public static function laratablesQueryConditions($query)
    {
        return $query->whereIn('status', [1, 2]);
    }

    public static function laratablesCustomAddress($data)
    {
        return '<span class="la la-map-marker mr-1"></span>' . $data->address1 . '<br><span class="la la-map-marker mr-1"></span>' . (($data->address2) ? $data->address2 : '-');
    }

    public static function laratablesStatus($data)
    {
        return '<span class="badge badge-' . (new Colors)->getColor($data['status']) . '">' . self::$status[$data['status']] . '</span>';
    }

    public static function laratablesCustomAction($data)
    {
        return '<i onclick="doEdit(' . $data['id'] . ')" class="la la-edit ml1 text-warning"></i><i onclick="doDelete(' . $data['id'] . ')" class="la la-trash ml-1 text-danger"></i>';
    }
}
