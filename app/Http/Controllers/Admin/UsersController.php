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
        // $users = User::all();
        // user_type need to captalize first letter only in listing

        $UserModel = User::query(); // start the query builder

            // 🔹 Apply filters if requested
            if (request()->query('action') === 'filter') {
                $filters = request()->only(['filter_user']);

                foreach ($filters as $key => $value) {
                    if (!empty($value)) {
                        // Adjust filter field names to actual DB columns if different
                        $column = match ($key) {
                            'filter_user'       => 'id',
                            default                => $key,
                        };

                        //i dont want like where function for id field exact match
                        if($column == 'id'){
                            $UserModel->where($column, $value);
                            continue;
                        }
                        // $UserModel->where($column, 'like', '%' . $value . '%');
                    }
                }
            }


        $users = $UserModel->select('id', 'name', 'staff_id', 'email','user_type', 'hourly_charges', 'created_at')->orderby('created_at', 'desc')->get();
        $users->transform(function ($user) {
            $user->user_type = ucfirst(str_replace('_', ' ', $user->user_type));
            return $user;
        });

        $users->transform(function ($user) {
            $user->hourly_charges =  '₹ '. $user->hourly_charges;
            return $user;
        });

        $usersLists = User::select('id', 'name', 'staff_id','user_type', 'email')->orderby('name', 'asc')->get();$usersLists->transform(function ($userList) {
            $userList->user_type = ucfirst(str_replace('_', ' ', $userList->user_type));
            return $userList;
        });
        return view('admin.users.index', compact('users', 'usersLists'));
    }

    function list(){
        $users = User::select('id', 'name', 'staff_id', 'email', 'user_type', 'hourly_charges', 'created_at')->orderby('created_at', 'desc')->get();
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

    function export(Request $request)
    {
        // Implement CSV export logic here

        $UserModel = User::query(); // start the query builder
        $users = $UserModel->select('id', 'name', 'staff_id', 'email','user_type', 'hourly_charges', 'created_at')->orderby('created_at', 'desc')->get();
        $users->transform(function ($user) {
            $user->user_type = ucfirst(str_replace('_', ' ', $user->user_type));
            return $user;
        });

        $users->transform(function ($user) {
            $user->hourly_charges =  '₹ '. $user->hourly_charges;
            return $user;
        });

        $usersLists = User::select('id', 'name', 'staff_id','user_type', 'email')->orderby('name', 'asc')->get();$usersLists->transform(function ($userList) {
            $userList->user_type = ucfirst(str_replace('_', ' ', $userList->user_type));
            return $userList;
        });


        $filename = 'users_export_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];  
        $columns = ['S.no', 'Name', 'Staff ID', 'Email', 'User Type', 'Hourly Charges', 'Created At'];

        $dir = public_path('users_'.DIRECTORY_SEPARATOR.date('Ymd'));
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }

        $filename = $dir . DIRECTORY_SEPARATOR . 'users_'.date('Ymd_His').'.csv';
        $fileURL = 'users_/' . date('Ymd') . '/' . 'users_'.date('Ymd_His').'.csv';   

        // Create and write the CSV file
        $file = fopen($filename, 'w+');
        fwrite($file, "\xEF\xBB\xBF");
        fputcsv($file, $columns);
        $serial = 1;
        foreach ($users as $user) {
            $row = [
                $serial++,
                $user->name,
                $user->staff_id,
                $user->email,
                $user->user_type,
                $user->hourly_charges,
                $user->created_at,
            ];
            fputcsv($file, $row);
        }
        fclose($file);

        return response()->json([
            'status' => 'success',
            'message' => 'CSV generated successfully.',
            'file' => $filename,
            'file_url' => asset($fileURL),
            
        ]);
    }   
}
