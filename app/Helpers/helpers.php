<?php

use App\Models\Category;
use App\Models\Routes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


function required_mark()
{
    return '<span class="text-danger"> *</span>';
}

function isDateTime($dateString)
{
    if (strtotime($dateString)) {
        return true;
    }
    return false;
}

function days_between($end, $start)
{
    return (strtotime($end) - strtotime($start)) / (60 * 60 * 24);
}

function leftSpace($value)
{
    return ($value) ? ' ' . $value : '';
}

function rightSpace($value)
{
    return ($value) ? $value . ' ' : '';
}

function leftrightSpace($value)
{
    return ($value) ? ' ' . $value . ' ' : '';
}

function leftRightBrakets($value)
{
    return ($value) ? '( ' . $value . ' )' : '';
}

function resizeUploadImage($imageFile, $path, $name, $height, $width)
{
    $name = $name . '.' . strtolower($imageFile->getClientOriginalExtension());
    Image::make($imageFile->path())->resize($height, $width, function ($constraint) {
        $constraint->aspectRatio();
    })->save(public_path($path) . '/' . $name);
    return $name;
}

function format_currency($value)
{
    $value = ((env('CURRENCY'))?env('CURRENCY'):'Rs') .' '. number_format($value, 2);
    return $value;
}

function getUploadsPath($name){
    $name='uploads/'.$name;
    return asset($name);
}

function getDownloadFileName($prefix=null){
    return (($prefix)?$prefix:'').Carbon::now()->format('YmdHs');
}

function isntEmpty($val){
    return ($val && $val!='')?true:false;
}
