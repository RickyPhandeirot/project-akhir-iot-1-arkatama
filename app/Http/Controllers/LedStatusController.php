<?php

namespace App\Http\Controllers;
use App\Models\LedStatus;
use Illuminate\Http\Request;

class LedStatusController extends Controller
{
    public function index()
    {
        return LedStatus::all();
    }

    public function store (Request $request)
    {
        $ledstatus = new LedStatus;
        $ledstatus->led_id = $request->led_id;
        $ledstatus->status_led = $request->status_led;
        $ledstatus->save();

        if (LedStatus::where('id', $request->led_id)->exists()){
            $ledstatus = LedStatus::find($request->led_id);
            $ledstatus->status_led = $request->status_led;
            $ledstatus->save();
        }

        return response()->json([
            "message" => "Data telah Ditambahkan."
        ], 201);
    }

    public function show(string $id)
    {
        return LedStatus::where('led_id', $id)->orderBy('created_at', 'DESC')->get();
    }
}
