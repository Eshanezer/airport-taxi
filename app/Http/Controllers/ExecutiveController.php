<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Executive;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class ExecutiveController extends Controller
{
    public function index()
    {
        return view('pages.executive');
    }

    public function list(Request $request)
    {
        return Laratables::recordsOf(Executive::class);
    }

    public function getOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:executives,id'
        ]);
        return Executive::where('id', $request->id)->first();
    }

    public function deleteOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:executives,id'
        ]);
        Executive::where('id', $request->id)->update(['status' => 4]);

        return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Executive Successfully Removed']);
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'isnew' => 'required|in:1,2',
            'first_name' => 'required',
            'last_name' => 'required',
            'address_1' => 'required',
            'address_2' => 'nullable',
            'city' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|email',
            'status' => 'required|in:1,2'
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address1' => $request->address_1,
            'city' => $request->city,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'status' => $request->status
        ];

        if ($request->has('address_2')) {
            $data['address2'] = $request->address_2;
        }

        if ($request->isnew == 1) {

            Executive::create($data);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Executive Successfully Registered']);
        } else {

            $request->validate([
                'record' => 'required|exists:executives,id'
            ]);

            Executive::where('id', $request->record)->update($data);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Executive Successfully Updated']);
        }
    }
}
