<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Carbon\Carbon;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        return view('pages.vehicletype');
    }

    public function list(Request $request)
    {
        return Laratables::recordsOf(VehicleType::class);
    }

    public function getOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:vehicle_types,id'
        ]);
        $vehicleType = VehicleType::where('id', $request->id)->first();
        $vehicleType['path'] = getUploadsPath($vehicleType->path);
        return $vehicleType;
    }

    public function deleteOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:vehicle_types,id'
        ]);
        VehicleType::where('id', $request->id)->update(['status' => 4]);
        return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Location Successfully Removed']);
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'isnew' => 'required|in:1,2',
            'vehicle_type' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:1,2'
        ]);

        $data = [
            'type' => $request->vehicle_type,
            'description' => $request->description,
            'status' => $request->status
        ];

        if ($request->has('description')) {
            $data['description'] = $request->description;
        }

        if ($request->has('image')) {
            $data['path'] = $this->uploadImage($request->file('image'), Carbon::now()->format('YmdHs'), $request->image);
        }

        if ($request->isnew == 1) {

            VehicleType::create($data);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Vehicle Type Successfully Registered']);
        } else {

            $request->validate([
                'record' => 'required|exists:vehicle_types,id'
            ]);

            VehicleType::where('id', $request->record)->update($data);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Vehicle Type Successfully Updated']);
        }
    }

    public function uploadImage($valid, $name, $file)
    {
        return resizeUploadImage($file, 'uploads', $name, 150, 150);
    }
}
