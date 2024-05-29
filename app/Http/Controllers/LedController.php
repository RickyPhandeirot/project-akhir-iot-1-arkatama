<?php

namespace App\Http\Controllers;
use App\Models\Led;
use Illuminate\Http\Request;

class LedController extends Controller
{

    public function index()
    {
        $data['title'] = 'LED Control';
        $data['breadcrumbs'][] = [
            'title' => 'Dashboard',
            'url' => route('dashboard')
    ];
        $data['breadcrumbs'][] = [
            'title' => 'LED Control',
            'url' => route('led-control')
    ];

        // Mendapatkan semua data LED
        $leds = Led::all();
        $data['leds'] = $leds;

        // Kirim data ke tampilan
        return view('pages.ledcontrol', $data);
    }
}
