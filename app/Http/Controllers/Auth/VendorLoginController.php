<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:vendor')->except('logout');
    }
    public function showLoginForm()
    {
        return view('website.vendor.auth.login'); // Ensure this view exists
    }

    public function login(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the vendor in
        if (auth()->guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // If successful, redirect to the intended page
            return redirect()->intended(route('vendor.dashboard'));
        }

        // If unsuccessful, redirect back with an error message
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        auth()->guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }
    
}
