<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\TimesheetModel;
use App\Models\ProjectModel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class TimesheetController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $userId = Auth::id();

        $projects = DB::select("
                        SELECT * 
                        FROM projects 
                        WHERE JSON_CONTAINS(user_ids, ?, '$') ", 
                    [json_encode((string)$userId)]);

        $Timesheet = TimesheetModel::select(
                            'timesheets.id',
                            'timesheets.project_id',
                            'timesheets.staff_id',
                            'timesheets.entry_date',
                            'timesheets.hours_spent',
                            'timesheets.notes',
                            'timesheets.status as timesheet_status',
                            'timesheets.created_at',
                            'projects.status as project_status' // project status
                        )
                        ->join('projects', 'projects.project_id', '=', 'timesheets.project_id')
                        ->where('timesheets.user_id', $userId)
                        ->get();

            // return response()->json(['data' => $Timesheet ]);

        return view('admin.timesheet.index', compact('Timesheet','user', 'projects'));
    }

   


    public function list()
    {
        $userId = Auth::id();
        $Timesheet = TimesheetModel::select(
                        'timesheets.id',
                        'timesheets.project_id',
                        'timesheets.staff_id',
                        'timesheets.entry_date',
                        'timesheets.hours_spent',
                        'timesheets.notes',
                        'timesheets.status as timesheet_status',
                        'timesheets.created_at',
                        'projects.status as project_status' // project status
                    )
                    ->join('projects', 'projects.project_id', '=', 'timesheets.project_id')
                    ->where('timesheets.user_id', $userId)
                    ->get();

        return response()->json(['data' => $Timesheet ]);
    }

    function create()
    { 
        return view('admin.timesheet.create');
    }

    /**
     * Return user data for editing (AJAX).
     */
    public function edit($id)
    {
        $Timesheet   = TimesheetModel::find($id);
        if (! $Timesheet) {
            return response()->json([
                'status' => 'error',
                'message' => 'Timesheet not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $Timesheet,
        ], 200);
    }

    

    /**
     * Update the specified Timesheet.
     */
    public function update(Request $request, $id)
    {
        try {
            // Find project
            $timesheet = TimesheetModel::find($id);
            if (! $timesheet) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Project not found.',
                ], 404);
            }

            // Validate input (ignore unique for the same project_code)
            $validator = Validator::make($request->all(), [
                'project_code'   => 'required|string|max:100',
                'staff_id'      => 'required|exists:users,staff_id',
                'entry_date'         => 'required|date',
                'hours_spent'  => 'required|numeric|min:0',
                'notes'        => 'nullable|string|max:1000',
                // 'status'       => 'required|string|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Update fields
            $timesheet->project_id      = $request->project_code;
            $timesheet->staff_id      = $request->staff_id;
            $timesheet->entry_date    = $request->entry_date;
            $timesheet->hours_spent  = $request->hours_spent;
            $timesheet->notes        = $request->notes;
            // $timesheet->status       = $request->status;
            $timesheet->save();


            return response()->json([
                'status'  => 'success',
                'message' => 'Timesheet updated successfully.',
                'data'    => $timesheet,
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
            $timesheet = TimesheetModel::findOrFail($id);
            $timesheet->delete();

            return redirect()->route('admin.timesheet.index')->with('success', 'User deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.timesheet.index')->with('error', 'Something went wrong.');
        }
    }

     // i'm doing ajax form submission so store function need to handle request so need to add request parameter
    public function store(Request $request)
    {
        try {
            // Validate input
            
            $validator = Validator::make($request->all(), [
                'project_code'   => 'required|string|max:100',
                'staff_id'      => 'required|exists:users,staff_id',
                'entry_date'         => 'required|date',
                'hours_spent'  => 'required|numeric|min:0',
                'notes'        => 'nullable|string|max:1000',
                // 'status'       => 'required|string|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $entryDate = $request->input('entry_date', now()->toDateString());
            // Create project record
            $timesheet = TimesheetModel::create([
                'project_id'  => $request->project_code,
                'staff_id'     => $request->staff_id,
                'user_id'      => Auth::id(),
                'entry_date'  => $entryDate,
                'hours_spent' => $request->hours_spent,
                'notes'       => $request->notes,
                // 'status'      => $request->status,
            ]);


            // Return success response
            return response()->json([
                'status'  => 'success',
                'message' => 'Timesheet created successfully.',
                'data'    => $timesheet,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    // Admin Edit Timesheet
    function adminEdit($id)
    { 
        $Timesheet   = TimesheetModel::find($id);
        if (! $Timesheet) {
            return response()->json([
                'status' => 'error',
                'message' => 'Timesheet not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $Timesheet,
        ], 200);
    }

    public function timesheetlists()
    {
        $user       = Auth::user();
        $projects   = ProjectModel::select(
                            'project_id',
                            'project_name',
                            'user_ids',
                            'description',
                            'start_date',
                            'due_date',
                            'status')
                        ->get();

                        //hourly_charges   i need to get user_id from timesheet table compare to user table and get hourly_charges add that column in timesheet list i need to multiple hours_spent * hourly_charges and show total cost in the data table update the userHourlyCharges  this variable
                        $userHourlyCharges = User::select('id', 'hourly_charges')->pluck('hourly_charges', 'id');

                    $Timesheet  = TimesheetModel::with('user:id,name') // eager load only id + name
                            ->select('id','project_id','user_id','staff_id','entry_date','hours_spent','status')
                            ->get()
                            ->transform(function ($item) use ($userHourlyCharges) {
                                $item->status = ucfirst($item->status);
                                $item->user_name = $item->user->name ?? 'N/A'; // Add user name column
                                
                                $item->hourly_charges = '$ '.($userHourlyCharges[$item->user_id] ?? 0); // Add hourly charges column
                                $item->total_cost = '$ '.($item->hours_spent * ($userHourlyCharges[$item->user_id] ?? 0)); // Add total cost column
                                
                                $item->hourlyCharges = ($userHourlyCharges[$item->user_id] ?? 0); // Add hourly charges column
                                $item->totalCost = ($item->hours_spent * ($userHourlyCharges[$item->user_id] ?? 0)); // Add total cost column
                                

                                return $item;
                        });

                        $totalHours = $Timesheet->sum('hours_spent');
                        $totalCostSum = $Timesheet->sum('hourlyCharges');
                        $totalHourlyChargesSum = $Timesheet->sum('totalCost');

        // Data table : buttom of the page : Total hrs , Total cost 
        return view('admin.timesheet.adminindex', compact('Timesheet', 'user', 'projects', 'totalHours', 'totalHourlyChargesSum'));
    }
}
