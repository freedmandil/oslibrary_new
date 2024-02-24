<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Attempt to authenticate the user based on the request.
        // If authentication fails, Laravel automatically redirects back to the login form
        // with error messages without proceeding further.
        $request->authenticate();

        // Regenerate the session to prevent session fixation attacks.

        // After successful authentication, check if the user is indeed authenticated.
        if (Auth::check()) {
            $user = Auth::user()->load('usr_cat','sys_country','sys_state'); // Retrieve the currently authenticated user

            // The user is authenticated, so redirect to the intended location or a default.
            // This avoids returning a no-content response, which might be confusing in a web context.
            $request->session()->regenerate();
            Session::put('user_role', $user->user_cat); // Assuming the user has a 'role' attribute
            Session::put('user_permissions', $user->access_level); // Assuming permissions are retrieved somehow
            return redirect()->intended('dashboard')->with('status', 'Welcome. You have successfully logged in.');; // Adjust 'dashboard' to your default post-login location
        } else {
            // If, for any reason, Auth::check() returns false after calling authenticate(),
            // it's likely an unexpected state. Log this issue or handle accordingly.
            // Redirecting back to the login route with an error message.
            return redirect()->intended('login')->with('error', 'There was an issue with your login details. Please try again.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/')->with('status', 'You have successfully logged out.');;
    }
}
