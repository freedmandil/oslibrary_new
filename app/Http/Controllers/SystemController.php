<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SysState;

class SystemController extends Controller
{
    public function handle(Request $request, $method, $param = null)
    {
        // Check if the method exists in the controller
        if (method_exists($this, $method)) {
            // Call the method dynamically
            return $this->{$method}($request, $param);
        } else {
            // Method not found, handle error or return response
            return response()->json(['error' => 'Method not found: {'.$method.'}' ], 404);
        }
    }
    public function getStatesByCountry(Request $request, $country_id)
    {
        // Query books with the specified shelf name
            $states = SysState::select('*')->where('country_id', intval($country_id))->orderBy('name_en')->get();

        return response()->json($states);
    }
}

