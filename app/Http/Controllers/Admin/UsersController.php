<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    function index()
    { 
        // i need to show all users pass to list view i'm use data table so just return view
        // $users = User::all();
        $users = User::select('id', 'name', 'staff_id', 'email', 'hourly_charges', 'created_at')->orderby('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    function list(){
        $users = User::select('id', 'name', 'staff_id', 'email', 'hourly_charges', 'created_at')->orderby('created_at', 'desc')->get();
        return response()->json(['data' => $users]);
    }

    function create()
    { 
        return view('admin.users.create');
    }

    /**
     * Return user data for editing (AJAX).
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (! $user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        try {
            // i need to get login user id 
            $loggedInUserId = Auth::id();
            $user = User::find($id);
            if (! $user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found.'
                ], 404);
            }

            // Validate; for unique rules, ignore current user's id
            $validator = Validator::make($request->all(), [
                'name'           => 'required|string|max:255',
                // 'user_name'      => 'required|string|max:255|unique:users,user_name,'.$id,
                'company_name'   => 'required|string|max:255|unique:users,company_name,'.$id,
                'staff_id'       => 'required|string|max:255|unique:users,staff_id,'.$id,
                'email'          => 'required|string|email|max:255|unique:users,email,'.$id,
                'hourly_charges' => 'nullable|numeric|min:0',
                'status'         => 'required|in:active,inactive',
                'user_type'      => 'required|string|in:super_admin,admin,staff',
                'avatar'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                // $path = $file->store('avatars', 'public');
                // delete old avatar if not default and exists
                if ($user->avatar && $user->avatar !== 'default/avatar.png' && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $user->avatar = $path;
            }

            // Update fields
            $user->name = $request->input('name');
            // $user->user_name = $request->input('user_name');
            $user->company_name = $request->input('company_name');
            $user->staff_id = $request->input('staff_id');
            $user->email = $request->input('email');
            $user->hourly_charges = $request->input('hourly_charges') !== null ? $request->input('hourly_charges') : $user->hourly_charges;
            
            if($loggedInUserId != $id ) {
                $user->status = $request->input('status');
            }
            
            $user->user_type = $request->input('user_type');

            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully.',
                'data' => $user,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // delete user based on id  need to redirect to users page with success message
    function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Something went wrong.');
        }
    }

     // i'm doing ajax form submission so store function need to handle request so need to add request parameter
    function store(Request $request)
    { 

        // dd($request);
         try {
            // Manual validation so we can return JSON errors
            $validator = Validator::make($request->all(), [

                'name'           => 'required|string|max:255',
                // 'user_name'      => 'required|string|max:255|unique:users,user_name,',
                'company_name'   => 'required|string|max:255|unique:users,company_name,',
                'staff_id'       => 'required|string|max:255|unique:users,staff_id,',
                'email'          => 'required|string|email|max:255|unique:users,email,',
                'password'       => 'required|string|min:8|confirmed',
                'hourly_charges' => 'nullable|numeric|min:0',
                'status'         => 'required|in:active,inactive',
                'user_type'      => 'required|string|in:super_admin,admin,staff',

            ]);

            // If validation fails, return JSON error
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                // 'user_name' => $request->user_name,
                'company_name' => $request->company_name,
                'staff_id' => $request->staff_id,
                'password' => bcrypt($request->password),
                'hourly_charges' => $request->hourly_charges,
                'status' => $request->status,
                'user_type' => $request->user_type,
            ]);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully.',
                'data' => $user,
            ], 200);

        } catch (Exception $e) {
            // Catch any other errors
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
