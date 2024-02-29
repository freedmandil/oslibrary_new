<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\UsrUser;
use App\Models\SysCountry;
use App\Models\SysState;
use App\Models\SysLanguage;
use App\Models\UsrCat;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $page_title = 'Register New User';
        $countries = SysCountry::all(); // Fetch all countries
        $categories = UsrCat::all(); // Fetch all categories
        $states = SysState::all(); // Fetch all states
        $languages = SysLanguage::all(); // Fetch all languages

        // Pass the countries and categories to your view
        return view('auth.register', compact('countries', 'categories', 'states', 'page_title', 'languages'));
    }
}
