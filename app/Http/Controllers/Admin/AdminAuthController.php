<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

class AdminAuthController extends Controller
{
    public function loginForm(Request $request)
    {
        // Check if the admin is already authenticated
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard'); // Redirect to dashboard if logged in
        }

        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest  $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to log in
        if (Auth::guard('admin')->attempt($credentials)) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Set additional session data if needed
            session(['email' => $credentials['email']]);

            // Set cookie with admin email (adjust expiration time as needed)
            $minutes = 60; // Cookie will last for 60 minutes

            // If successful, redirect to the intended route
            return redirect()->route('admin.dashboard')->withCookie(cookie('email', $credentials['email'], $minutes));
        }



        return back()->withErrors([
            'email' => 'The provided credentials does not match our records.'
        ])->withInput($request->only('email')); // Keep the email input for user convenience

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        request()->session()->invalidate(); // Invalidate the session
        request()->session()->regenerateToken(); // Regenerate CSRF token
        // Clear the session data
        request()->session()->forget('email');
        return redirect()->route('admin.login')->withCookie(cookie('email', '', -1));;
    }
}
