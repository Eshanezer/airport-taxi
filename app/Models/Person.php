<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'lname', 'email', 'address1', 'address2', 'city', 'tp1', 'tp2', 'tp3', 'person_type', 'status'];

    public $personTypes = [1 => 'Executive', 2 => 'Representative'];
    public $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Blocked', 4 => 'Deleted'];
}
