<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;


class AdminAuthController extends Controller
{

    function login() : View
    {       
        return view('admin.auth.login');
    }
    
    function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect('/');
        //->with('success', 'You have been logged out successfully.');
   
    }

}
