<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\ProjectModel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class ProjectController extends Controller
{
   
    public function index()
    {
        //user_ids
        // Load all projects for the view (used for Blade rendering)
        $ProjectModel = ProjectModel::select(
                                'id',
                                'project_id',
                                'project_name',
                                'description',
                                'start_date',
                                'due_date',
                                'status',
                                'created_at'
                            )->get();

        $users = User::select(
                                'id',
                                'name',
                                'email'
                            )->get();
        return view('admin.projects.index', compact('ProjectModel', 'users'));
    }

    public function list()
    {
        // Return data as JSON (for DataTables AJAX, etc.)
        $projects = ProjectModel::select(
            'id',
            'project_id',
            'project_name',
            'description',
            'start_date',
            'due_date',
            'status',
            'created_at'
        )->get();

        return response()->json(['data' => $projects]);
    }


    function create()
    { 
        return view('admin.projects.create');
    }

    /**
     * Return user data for editing (AJAX).
     */
    public function edit($id)
    {
        //user_ids  this field i need to send as json decode
        $Project = ProjectModel::find($id);


        if (! $Project) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        // ensure user_ids returned as array
        $projectData = $Project->toArray();
        $projectData['user_ids'] = $Project->user_ids ? json_decode($Project->user_ids, true) : [];

        return response()->json([
            'status' => 'success',
            'data' => $projectData,
        ], 200);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        try {
            // Find project
            $project = ProjectModel::find($id);
            if (! $project) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Project not found.',
                ], 404);
            }

            // Validate input (ignore unique for the same project_id)
            $validator = Validator::make($request->all(), [
                'project_id'     => 'required|string|max:100|unique:projects,project_id,' . $id,
                'project_name'   => 'required|string|max:255',                
                'project_users'  => 'required|array',
                'description'    => 'nullable|string',
                'start_date'     => 'date',
                'due_date'       => 'date|after_or_equal:start_date',
                'status'         => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Update fields
            $project->project_id   = $request->project_id;
            $project->project_name = $request->project_name;
            $project->user_ids    = json_encode($request->project_users);
            $project->description  = $request->description;
            $project->start_date   = $request->start_date;
            $project->due_date     = $request->due_date;
            $project->status       = $request->status;

            if (Auth::user()->user_type == 'super_admin' || Auth::user()->user_type == 'admin') {
                $project->save();
            }
            

            // Return project with user_ids as array
            $projectData = $project->toArray();
            $projectData['user_ids'] = $project->user_ids ? json_decode($project->user_ids, true) : [];

            return response()->json([
                'status'  => 'success',
                'message' => 'Project updated successfully.',
                'data'    => $projectData,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    // delete user based on id  need to redirect to users page with success message
    function destroy($id)
    {
        try {
            if (Auth::user()->user_type == 'super_admin' || Auth::user()->user_type == 'admin') {
                $ProjectModel = ProjectModel::findOrFail($id);
                $ProjectModel->delete();
            }

            return redirect()->route('admin.projects.index')->with('success', 'User deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.projects.index')->with('error', 'Something went wrong.');
        }
    }

     // i'm doing ajax form submission so store function need to handle request so need to add request parameter
    public function store(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'project_id'     => 'required|string|max:100|unique:projects,project_id',
                'project_name'   => 'required|string|max:255',
                'description'    => 'nullable|string',
                'project_users'  => 'required|array',
                'start_date'     => 'required|date',
                'due_date'       => 'required|date|after_or_equal:start_date',
                'status'         => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // dd($request->project_users) ;
            // Create project record
            if (Auth::user()->user_type == 'super_admin' || Auth::user()->user_type == 'admin') {
                $project = ProjectModel::create([
                    'project_id'   => $request->project_id,
                    'user_ids'     => json_encode($request->project_users),
                    'project_name' => $request->project_name,
                    'description'  => $request->description,
                    'start_date'   => $request->start_date,
                    'due_date'     => $request->due_date,
                    'status'       => $request->status,
                ]);
            }

            // Return created project with user_ids decoded as array
            $projectData = $project->toArray();
            $projectData['user_ids'] = $project->user_ids ? json_decode($project->user_ids, true) : [];

            return response()->json([
                'status'  => 'success',
                'message' => 'Project created successfully.',
                'data'    => $projectData,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

}
