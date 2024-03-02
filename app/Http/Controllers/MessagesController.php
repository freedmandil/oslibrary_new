<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagesController extends Controller
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
    public function setMessage(Request $request)
    {
        $type = $request->input('type');
        $level = $request->input('level');
        $message = $request->input('message');

        $allowedLevels = ['success', 'info', 'warning', 'error'];
        $allowedTypes = ['', 'toast', 'alert', 'modal'];

        // Check if the provided type and level are valid
        if (!in_array($allowedLevels) || !in_array($allowedTypes)) {
            return response()->json(['success' => false, 'error' => 'Invalid level']);
        }

        session()->flash($level, $message);

        return response()->json(['success' => true]);
    }
}
