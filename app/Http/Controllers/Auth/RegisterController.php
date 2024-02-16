<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\UsrUser;
use App\Models\SysCountry;
use App\Models\UsrCat;
class RegisterController extends Controller
{
    /**
     * The Validator method
     *
     * @var array<string, string>
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usr_users'],
            'password' => ['required', 'string', 'min:8'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'alt_name' => ['nullable', 'string', 'max:255'],
            'email2' => ['nullable', 'string', 'email', 'max:255'],
            'phone1' => ['required', 'string', 'max:255'],
            'phone2' => ['nullable', 'string', 'max:255'],
            'address1' => ['nullable', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'address3' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'country_id' => ['required', 'integer', 'exists:sys_countries,id'],
            'zip_post_code' => ['nullable', 'string', 'max:255'],
            // Assuming cat_id is always required and should exist in usr_cats table
            'cat_id' => ['required', 'integer', 'exists:usr_cats,id'],
            'access_level' => ['required', 'integer'],
            'contact_status' => ['nullable', 'string', 'max:255'],
        ]);
    }

    /** Create User in Database
     *
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::create([
            'email' => $request->email,
            'email_verified_at' => null, // You might set this upon email verification
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'alt_name' => $request->alt_name,
            'email2' => $request->email2,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'address3' => $request->address3,
            'city' => $request->city,
            'state' => $request->state,
            'country_id' => $request->country_id,
            'zip_post_code' => $request->zip_post_code,
            'cat_id' => $request->cat_id,
            'access_level' => $request->access_level,
            'contact_status' => $request->contact_status,
            // 'remember_token' will be generated automatically if you're using Laravel's Auth system
        ]);

        // Post-registration actions (e.g., login, redirect, flash message)

        return redirect()->route('home')->with('success', 'Registration successful.');
    }


    public function showRegistrationForm()
    {
        $countries = SysCountry::all(); // Fetch all countries
        $categories = UsrCat::all(); // Fetch all categories

        // Pass the countries and categories to your view
        return view('auth.register', compact('countries', 'categories'));
    }
}
