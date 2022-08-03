<?php

namespace App\Http\Controllers;


use App\Models\Orders;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function trackorder($tracking_no) {
        $tracking = Orders::where('tracking_no', $tracking_no)->first();
        return view('track/track',['tracking' => $tracking]);
    }

}
