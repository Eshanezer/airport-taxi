<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable=['refno','driver','representative','passenger','passport','remark','date','pax','waiting','extrakm','kmtotal','extrakmtotal','waitingtotal','driver_total','journey_total','discount_total','dcc','grand_total','status'];

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Blocked', 4 => 'Deleted'];

    public function getNextId()
    {
        return DB::select("SHOW TABLE STATUS LIKE 'invoices'")[0]->Auto_increment;
    }

    public function driverdata(){
        return $this->hasOne(Driver::class,'id','driver');
    }

    public function representativedata(){
        return $this->hasOne(Representative::class,'id','representative');
    }

    public function pricingrecords(){
       return $this->hasMany(InvoicePricing::class,'invoice','id')->with('startdata')->with('enddata')->with('routedata')->with('vehicletypedata');
    }
}
