<?php

namespace App\Exports;

use App\Models\Pricing;
use Maatwebsite\Excel\Concerns\FromArray;

class PricingExport implements FromArray
{
    protected $exportable = [];

    function __construct($exportable)
    {
        $this->exportable = $exportable;
    }

    public function array(): array
    {
        $query = Pricing::where('status', 1);
        if (count($this->exportable)) {
            $query->whereIn('id', $this->exportable);
        }

        $data = [];

        foreach ($query->with('startdata')->with('enddata')->with('routedata')->with('vehicletypedata')->get() as $key => $pricing) {
            $data[] = [$pricing['startdata']->location, $pricing['enddata']->location, ($pricing['routedata']) ? $pricing['routedata']->location : '', $pricing['vehicletypedata']->type, $pricing->journey_price, $pricing->driver_price, ($pricing->km && $pricing->km != '') ? $pricing->km : 'NA', ($pricing->extra && $pricing->extra != 0) ? $pricing->extra : 'NA', ($pricing->waiting && $pricing->waiting != 0) ? $pricing->waiting : 'NA'];
        }

        return $data;
    }
}
