<?php

namespace App\Http\Controllers;
use App\Models\Led;
use Illuminate\Http\Request;

class LedController extends Controller
{

    public function index()
    {
        return Led::all();
    }

    public function store(Request $request)
    {
        $led = new Led;
        $led->led_name = $request->led_name;
        $led->led_value = $request->led_value;
        $led->save();
        return response()->json([
            "message" => "LED telah Ditambahkan."
        ], 201);
    }

    public function show(string $id)
    {
        return Led::find($id);
    }

    public function update(Request $request, string $id)
    {
        if (Led::where('id', $id)->exists()) {
            $led = Led::find($id);
            $led->led_name = is_null($request->led_name) ? $led->led_name : $request->led_name;
            $led->led_value = is_null($request->led_value) ? $led->led_value : $request->led_value;
            $led->save();
            return response()->json([
                "message" => "LED telah diupdate."
            ], 201);
           } else {
            return response()->json([
                "message" => "LED tidak ditemukan."
           ], 404);
        }
    }

    public function destroy(string $id)
    {
        if (Led::where('id', $id)->exists()) {
            $led = Led::find($id);
            $led->delete();
            return response()->json([
                "message" => "LED telah dihapus."
            ], 201);
            } else {
            return response()->json([
                "message" => "LED tidak ditemukan."
            ], 404);
            }
    }
}
