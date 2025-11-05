<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    function changePassword() : View
    {       
        return view('admin.auth.change-password');
    }
    function updatePassword(Request $request)
    {
        $request->validate([
            'cur' => 'required',
            'newpwd' => 'required|min:8',
        ]);

        // current login user id
        $user = Auth::user();
        // Check if current password matches
        if (!password_verify($request->input('cur'), $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Current password is incorrect.'
            ], 400);
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->newpwd),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully.'
        ], 200);
    }   

}
