<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UsrUser;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
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
            'state_id' => ['nullable', 'integer', 'exists:sys_states,id'],
            'country_id' => ['required', 'integer', 'exists:sys_countries,id'],
            'zip_post_code' => ['nullable', 'string', 'max:255'],
            // Assuming cat_id is always required and should exist in usr_cats table
            'cat_id' => ['required', 'integer', 'exists:usr_cats,id'],
            'access_level' => ['nullable', 'integer'],
            'contact_status' => ['nullable', 'string', 'max:255'],
            'language_id' => ['required', 'integer','exists:sys_languages,id'],

        ]);
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Post-registration actions (e.g., login, redirect, flash message)
        $user = UsrUser::create([
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
            'state_id' => $request->state_id,
            'country_id' => $request->country_id,
            'zip_post_code' => $request->zip_post_code,
            'cat_id' => $request->cat_id,
            'access_level' => 0,
            'contact_status' => $request->contact_status,
            'language_id' => $request->language_id,

            // 'remember_token' will be generated automatically if you're using Laravel's Auth system
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Your account has been created. Please check your email to verify your account.');
    }
}
