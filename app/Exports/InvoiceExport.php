<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\Pricing;
use Maatwebsite\Excel\Concerns\FromArray;

class InvoiceExport implements FromArray
{
    protected $exportable = [];

    function __construct($exportable)
    {
        $this->exportable = $exportable;
    }

    public function array(): array
    {
        $query = Invoice::where('status', 1);
        if (count($this->exportable)) {
            $query->whereIn('id', $this->exportable);
        }

        $data = [];

        $data[] = ['Invoice No', 'DCC', 'Driver', 'Representative', 'KM', 'Journey Total', 'Discount', 'Driver Profit', 'Company Profit'];

        $totalextrakm = 0;
        $totaljourney = 0;
        $totaldiscount = 0;
        $totaldriver = 0;
        $totalcompany = 0;

        foreach ($query->with('driverdata')->with('representativedata')->with('pricingrecords')->orderBy('id', 'DESC')->get() as $key => $invoice) {
            $totalextrakm += $invoice->kmtotal + $invoice->extrakm;
            $totaljourney += $invoice->journey_total;
            $totaldiscount += $invoice->discount_total;
            $totaldriver += $invoice->driver_total - $invoice->discount_total;
            $totalcompany += $invoice->journey_total - $invoice->driver_total;
            $data[] = [
                $invoice->refno,
                $invoice->dcc,
                $invoice['driverdata']->turnno . ' - ' . $invoice['driverdata']->fname . ' ' . $invoice['driverdata']->lname,
                $invoice['representativedata']->first_name . ' ' . $invoice['representativedata']->last_name,
                $invoice->kmtotal + $invoice->extrakm,
                $invoice->journey_total,
                $invoice->discount_total,
                $invoice->driver_total - $invoice->discount_total,
                $invoice->journey_total - $invoice->driver_total,
            ];
        }

        $data[] = ['', '', '', '',  $totalextrakm, format_currency($totaljourney), format_currency($totaldiscount),  format_currency($totaldriver), format_currency($totalcompany)];

        return $data;
    }
}
