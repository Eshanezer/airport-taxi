<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Validation\ValidationException;

class DriverController extends Controller
{
    public function index()
    {
        return view('pages.drivers');
    }

    public function list(Request $request)
    {
        return Laratables::recordsOf(Driver::class);
    }

    public function isValidTurnNo(Request $request)
    {
        $type = $request->type;
        $turnno = $request->turnno;
        $id = $request->record;

        $query = Driver::whereIn('status', [1, 2])->where('turnno', $turnno);
        if ($type == 1) {
            if ($query->count() > 0) {
                return 2;
            }
            return 1;
        }

        if ($query->first()->id != $id) {
            return 2;
        }
        return 1;
    }

    public function getOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:drivers,id'
        ]);
        return Driver::where('id', $request->id)->first();
    }

    public function deleteOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:drivers,id'
        ]);
        Driver::where('id', $request->id)->update(['status' => 4]);
        return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Driver Successfully Removed']);
    }

    public function blockOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:drivers,id'
        ]);
        $driver = Driver::where('id', $request->id)->first();
        $driver->update(['status' => (($driver->status == 3) ? 1 : 3)]);
        return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Driver Successfully Blocked']);
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'isnew' => 'required|in:1,2',
            'fname' => 'required',
            'lname' => 'required',
            'licensenumber' => 'required',
            'license_expiry_date' => 'required',
            'joining_date' => 'required',
            'address1' => 'required',
            'address2' => 'nullable',
            'city' => 'required',
            'mobile_number' => 'required',
            'phone_number' => 'nullable',
            'email' => 'required',
            'status' => 'required|in:1,2,3'
        ]);

        if ($request->isnew == 1) {
            $request->validate([
                'turnno' => 'required|unique:drivers,turnno',
                'nic' => 'required|unique:drivers,nic',
                'vehiclenumber' => 'required|unique:drivers,vehicle_number'
            ]);

            $data = [
                'turnno' => $request->turnno,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'nic' => $request->nic,
                'address1' => $request->address1,
                'city' => $request->city,
                'tp1' => $request->mobile_number,
                'license_number' => $request->licensenumber,
                'license_date' => $request->license_expiry_date,
                'joining_date' => $request->joining_date,
                'vehicle_number' => $request->vehiclenumber,
                'status' => $request->status
            ];

            if ($request->has('address2')) {
                $data['address2'] = $request->address2;
            }
            if ($request->has('tp2')) {
                $data['tp2'] = $request->phone_number;
            }

            Driver::create($data);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Driver Successfully Registered']);
        } else {

            $request->validate([
                'record' => 'required|exists:drivers,id'
            ]);

            $driver = Driver::whereIn('status', [1, 2])->where('turnno', $request->turnno)->first();

            if ($driver->id != $request->record) {
                throw ValidationException::withMessages(['turnno' => 'This value exists.']);
            }

            $data = [
                'turnno' => $request->turnno,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'nic' => $request->nic,
                'address1' => $request->address1,
                'city' => $request->city,
                'tp1' => $request->mobile_number,
                'license_number' => $request->licensenumber,
                'license_date' => $request->license_expiry_date,
                'joining_date' => $request->joining_date,
                'vehicle_number' => $request->vehiclenumber,
                'status' => $request->status
            ];

            if ($request->has('address2')) {
                $data['address2'] = $request->address2;
            }
            if ($request->has('tp2')) {
                $data['tp2'] = $request->phone_number;
            }

            Driver::where('id', $request->record)->update($data);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Driver Successfully Updated']);
        }
    }
}
