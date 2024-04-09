<?php

namespace App\Http\Controllers;

use App\Exports\PricingExport;
use App\Http\Controllers\Controller;
use App\Imports\PricingImport;
use App\Models\Location;
use App\Models\Pricing;
use App\Models\VehicleType;
use Carbon\Carbon;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class PricingController extends Controller
{
    public function index()
    {
        $locations = Location::where('status', 1)->orderBy('location', 'ASC')->get();
        $vtypes = VehicleType::where('status', 1)->get();
        return view('pages.addpricing', compact(['locations', 'vtypes']));
    }

    public function list(Request $request)
    {
        return Laratables::recordsOf(Pricing::class);
    }

    public function getOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pricings,id'
        ]);
        return Pricing::where('id', $request->id)->first();
    }

    public function deleteOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pricings,id'
        ]);
        Pricing::where('id', $request->id)->update(['status' => 4]);

        return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Location Successfully Removed']);
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'isnew' => 'required|in:1,2',
            'start' => 'required|exists:locations,id',
            'end' => 'required|exists:locations,id|different:start',
            'route' => 'nullable|exists:locations,id',
            'vehicle_type' => 'required|exists:vehicle_types,id',
            'journey_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'driver_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'km' => 'nullable|numeric',
            'extra' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'required|in:1,2'
        ]);

        $data = [
            'start' => $request->start,
            'end' => $request->end,
            'route' => $request->route,
            'vehicletype' => $request->vehicle_type,
            'journey_price' => $request->journey_price,
            'driver_price' => $request->driver_price,
            'status' => $request->status,
            'km' => null,
            'extra' => 0,
            'waiting' => 0
        ];

        if ($request->has('route') && $request->route != '') {
            $data['route'] = $request->route;
        }

        if ($request->has('km') && $request->km != '') {
            $data['km'] = $request->km;
        }

        if ($request->has('extra') && $request->extra != '') {
            $data['extra'] = $request->extra;
        }

        if ($request->has('waiting') && $request->waiting != '') {
            $data['waiting'] = $request->waiting;
        }

        if ($request->isnew == 1) {

            if ($request->has('route')) {
                if (Pricing::whereIn('status', [1, 2])->where('start', $request->start)->where('end', $request->end)->where('route', $request->route)->where('vehicletype', $request->vehicle_type)->count()) {
                    throw  ValidationException::withMessages([
                        'start' => ['Pricing data exists with same start location, end location, route and vehicle type'],
                        'end' => ['Pricing data exists with same start location, end location, route and vehicle type'],
                        'route' => ['Pricing data exists with same start location, end location, route and vehicle type'],
                        'vehicle_type' => ['Pricing data exists with same start location, end location, route and vehicle type']
                    ]);
                }
            } else {
                if (Pricing::whereIn('status', [1, 2])->where('start', $request->start)->where('end', $request->end)->where('route')->where('vehicletype', $request->vehicle_type)->count()) {
                    throw  ValidationException::withMessages([
                        'start' => ['Pricing data exists with same start location, end location, route and vehicle type'],
                        'end' => ['Pricing data exists with same start location, end location, route and vehicle type'],
                        'vehicle_type' => ['Pricing data exists with same start location, end location, route and vehicle type']
                    ]);
                }
            }

            Pricing::create($data);
            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Pricing Successfully Registered']);
        } else {
            $request->validate([
                'record' => 'required|exists:pricings,id'
            ]);

            if ($request->has('route')) {
                if (Pricing::whereIn('status', [1, 2])->where('id', '!=', $request->record)->where('start', $request->start)->where('end', $request->end)->where('route', $request->route)->where('vehicletype', $request->vehicle_type)->count()) {
                    throw  ValidationException::withMessages([
                        'start' => ['Pricing data exists with same start location, end location, route and vehicle type'],
                        'end' => ['Pricing data exists with same start location, end location, route and vehicle type'],
                        'route' => ['Pricing data exists with same start location, end location, route and vehicle type'],
                        'vehicletype' => ['Pricing data exists with same start location, end location, route and vehicle type']
                    ]);
                }
            } else {
                if (Pricing::whereIn('status', [1, 2])->where('id', '!=', $request->record)->where('start', $request->start)->where('end', $request->end)->where('route')->where('vehicletype', $request->vehicle_type)->count()) {
                    throw  ValidationException::withMessages([
                        'start' => ['Pricing data exists with same start location, end location and vehicle type'],
                        'end' => ['Pricing data exists with same start location, end location and vehicle type'],
                        'vehicletype' => ['Pricing data exists with same start location, end location and vehicle type']
                    ]);
                }
            }

            Pricing::where('id', $request->record)->update($data);
            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Pricing Successfully Updated']);
        }
    }

    public function export($exportable)
    {
        return Excel::download(new PricingExport(json_decode($exportable)), getDownloadFileName('pricing') . '.xlsx');
    }

    public function sample()
    {
        return Response::download(public_path() . '/assets/samples/pricing.xlsx');
    }

    public function import(Request $request)
    {
        if ($request->file('excel_file')) {
            Excel::import(new PricingImport, $request->excel_file);
            return 1;
        } else {
            return 2;
        }
    }

    public function getSuitablePricing(Request $request)
    {
        $start = $request->start;
        $route = $request->route;
        $end = $request->end;

        $query = Pricing::whereIn('status', [1, 2])->where('start', $start)->where('end', $end)->with('startdata')->with('enddata')->with('routedata')->with('vehicletypedata');

        if ($route != '' && $request->has('route')) {
            $query->where('route', $route);
        }

        if ($query->count()) {
            $data = $query->get();
            return [
                $data,
                view('subcontents.invoice_vehicletype')->with('data', $data)->render()
            ];
        } else {
            return 2;
        }
    }
}
