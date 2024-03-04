<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SysState;
use App\Models\SysCountry;
use App\Models\SysLanguage;

class SystemController extends Controller
{
    public function getStatesByCountry(Request $request, $country_id)
    {
        // Query books with the specified shelf name
            $states = SysState::select('*')->where('country_id', intval($country_id))->orderBy('name_en')->get();

        return $states ? response()->json($states) : json(['error'=>true]);
    }

    public function getLanguages()
    {
        // Query books with the specified shelf name
        $languages = SysLanguage::select('*')->orderBy('name_en')->get();

        return $languages ? response()->json($languages) : json(['error'=>true]);
    }
}

