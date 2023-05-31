<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function __invoke(Location $location, Request $request)
    {
        return view('location-builder')->with([
            'location' => $location,
            'request' => $request
        ]);
    }
}
