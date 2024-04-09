<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LocationController extends Controller
{
    public function index()
    {
        return view('pages.location');
    }

    public function list(Request $request)
    {
        return Laratables::recordsOf(Location::class);
    }

    public function getOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:locations,id'
        ]);
        return Location::where('id', $request->id)->first();
    }

    public function deleteOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:locations,id'
        ]);
        Location::where('id', $request->id)->update(['status' => 4]);

        return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Location Successfully Removed']);
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'isnew' => 'required|in:1,2',
            'location' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:1,2',
            'setdefault' => 'required|in:1,0'
        ]);

        $data = [
            'location' => $request->location,
            'status' => $request->status
        ];

        if ($request->has('description')) {
            $data['description'] = $request->description;
        }

        if ($request->setdefault == 1) {
            Location::whereIn('status', [1, 2])->update([
                'setdefault' => 0
            ]);
            $data['setdefault'] = $request->setdefault;
        }

        if ($request->isnew == 1) {

            Location::create($data);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Location Successfully Registered']);
        } else {

            $request->validate([
                'record' => 'required|exists:locations,id'
            ]);

            Location::where('id', $request->record)->update($data);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Location Successfully Updated']);
        }
    }
}
