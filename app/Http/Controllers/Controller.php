<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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
}
