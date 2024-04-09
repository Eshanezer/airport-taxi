<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Invoice;
use App\Models\InvoicePricing;
use App\Models\Location;
use App\Models\Representative;
use App\Models\VehicleType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function index()
    {
        $locations = Location::whereIn('status', [1, 2])->orderBy('location', 'ASC')->get();
        $vehicletypes = VehicleType::whereIn('status', [1, 2])->orderBy('type', 'ASC')->get();
        $representatives = Representative::whereIn('status', [1, 2])->get();
        $drivers = Driver::whereIn('status', [1, 2])->get();
        return view('pages.posinvoice', compact(['locations', 'vehicletypes', 'representatives', 'drivers']));
    }

    public function deleteOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:invoices,id'
        ]);
        Invoice::where('id', $request->id)->update(['status' => 4]);
        return 1;
    }

    public function billedList()
    {
        $representatives = Representative::whereIn('status', [1, 2])->get();
        $drivers = Driver::whereIn('status', [1, 2])->orderBy('fname', 'ASC')->get();
        return view('pages.salesreport', compact(['representatives', 'drivers']));
    }

    public function list(Request $request)
    {
        $data = [];
        $query = Invoice::where('status', 1);

        if ($request->has('from') && $request->from != '') {
            $query->whereDate('date', '>=', Carbon::parse($request->from)->format('Y-m-d'));
        }

        if ($request->has('to') && $request->to != '') {
            $query->whereDate('date', '<', Carbon::parse($request->to)->format('Y-m-d'));
        }

        if ($request->has('driver') && $request->driver != '') {
            $query->where('driver', $request->driver);
        }

        if ($request->has('representative') && $request->representative != '') {
            $query->where('representative', $request->representative);
        }

        $index = $request->start;
        $term = $request->search['value'];
        $query->where('refno', 'LIKE', '%' . $term . '%');
        if ($request->length != '-1') {
            $query->skip($request->start)->take($request->start + $request->length);
        }

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
                $invoice->id,
                $invoice->refno,
                ' <span class="badge badge-primary">' . $invoice->dcc . '</span>',
                $invoice['driverdata']->turnno . ' - ' . $invoice['driverdata']->fname . ' ' . $invoice['driverdata']->lname,
                $invoice['representativedata']->first_name . ' ' . $invoice['representativedata']->last_name,
                $invoice->kmtotal + $invoice->extrakm,
                format_currency($invoice->journey_total),
                format_currency($invoice->discount_total),
                format_currency($invoice->driver_total - $invoice->discount_total),
                format_currency($invoice->journey_total - $invoice->driver_total),
                '<i onclick="doView(' . $invoice->id . ')" class="la la-eye ml-1 text-warning"></i><i onclick="doPrint(' . $invoice->id . ')" title="Print" class="la la-print ml-1 text-primary"></i><i onclick="doDelete(' . $invoice->id . ')" class="la la-trash ml-1 text-danger"></i>'
            ];
            $index++;
        }

        $data[] = [0,'-', '-', '-', '<strong>Total</strong>', '<strong>' . $totalextrakm . '</strong>', '<strong>'.format_currency($totaljourney).'</strong>', '<strong>'.format_currency($totaldiscount).'</strong>', '<strong>'.format_currency($totaldriver).'</strong>', '<strong>'.format_currency($totalcompany).'</strong>', '-'];

        return [
            'data' => $data,
            'recordsFiltered' => $query->count(),
            'recordsTotal' => $query->count(),
        ];
    }

    public function getRefNo()
    {
        return env('INVPREFIX', '') . str_pad((new Invoice)->getNextId(), 4, "0", STR_PAD_LEFT);
    }

    public function export($exportable)
    {
        return Excel::download(new InvoiceExport(json_decode($exportable)), getDownloadFileName('invoices') . '.xlsx');
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'driver' => 'required|exists:drivers,id',
            'representative' => 'required|exists:representatives,id',
            'passenger' => 'nullable',
            'passport' => 'nullable',
            'remark' => 'nullable',
            'date' => 'required|date',
            'pax' => 'nullable',
            'kmtotal' => 'required|numeric',
            'waiting' => 'nullable|numeric',
            'extrakm' => 'nullable|numeric',
            'extrakmtotal' => 'nullable|numeric',
            'waitingtotal' => 'nullable|numeric',
            'driver_total' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'journey_total' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'discount_total' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'grand_total' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'invoicerecords' => 'required|array'
        ]);


        $data = [
            'refno' => $this->getRefNo(),
            'driver' => $request->driver,
            'representative' => $request->representative,
            'date' => $request->date,
            'waiting' => $request->waiting,
            'extrakm' => $request->extrakm,
            'kmtotal' => $request->kmtotal,
            'extrakmtotal' => $request->extrakmtotal,
            'waitingtotal' => $request->waitingtotal,
            'driver_total' => $request->driver_total,
            'journey_total' => $request->journey_total,
            'discount_total' => $request->discount_total,
            'dcc' =>  Carbon::now()->format('Y') . '/' . ($request->journey_total - $request->driver_total) . '/' . ($request->driver_total - $request->discount_total),
            'grand_total' => $request->grand_total,
        ];

        if ($request->has('passenger') && $request->passenger != '') {
            $data['passenger'] = $request->passenger;
        }
        if ($request->has('passport') && $request->passport != '') {
            $data['passport'] = $request->passport;
        }
        if ($request->has('remark') && $request->remark != '') {
            $data['remark'] = $request->remark;
        }
        if ($request->has('pax') && $request->pax != '') {
            $data['pax'] = $request->pax;
        }

        $invoice = Invoice::create($data);

        foreach ($request->invoicerecords as $pricingKey => $pricingValue) {
            InvoicePricing::create([
                'invoice' => $invoice->id,
                'start' => $pricingValue['start'],
                'end' => $pricingValue['end'],
                'vehicletype' => $pricingValue['vehicletype'],
                'discount' => $pricingValue['discount'],
                'journey_price' => $pricingValue['journey_price'],
                'driver_price' => $pricingValue['driver_price'],
                'km' => $pricingValue['km'],
                'extra' => $pricingValue['extra'],
                'waiting' => $pricingValue['waiting'],
            ]);
        }

        return $this->getInvoiceView($invoice->id, 1);
    }

    protected function getInvoiceView($id, $type = 2)
    {
        $invoice = Invoice::where('id', $id)->with('driverdata')->with('representativedata')->with('pricingrecords')->first();
        if ($invoice) {
            return view('prints.invoice')->with('invoice', $invoice)->with('type', $type);
        } else {
            return 2;
        }
    }
}
