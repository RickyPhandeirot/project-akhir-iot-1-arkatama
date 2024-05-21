<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Device;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return Data::all();
    }

    public function store (Request $request)
    {
        $data = new Data;
        $data->device_id = $request->device_id;
        $data->data = $request->data;
        $data->save();

        if (Device::where('id', $request->device_id)->exists()){
            $device = Device::find($request->device_id);
            $device->current_value = $request->data;
            $device->save();
        }

        return response()->json([
            "message" => "Data telah Ditambahkan."
        ], 201);
    }

    public function show(string $id)
    {
        return Data::where('device_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    // public function web_show(string $id){
    //     return view('device', [
    //         "title" => "device",
    //         "device" => Device::find($id),
    //         "data" => Data::where('device_id', $id)->orderBy('created_at', 'DESC')->get()
    //     ]);
    // }
}
