@extends('admin.layouts.main')
@section('title', 'Timesheet')
@section('innerPageTitleIconClass', 'ti ti-briefcase')
@section('inner_page_title', 'Timesheet List')
@section('inner_page_subtitle', 'Timesheet Management')
@section('inner_page_title2', 'Timesheet List')

<!-- inner section -->
 <!-- add user button  -->
  @section('inner_button_section')
	<!-- <div class="d-flex justify-content-end mb-3">
		<a href="#" data-bs-toggle="modal" data-bs-target="#model_item" class="create-btn btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Add Projects</a>
	</div> -->
	@endsection
 <!-- add user button  -->
	
		
		@section('content')

			<div class="card-header">
				<div class="d-flex justify-content-end">
					<!-- Filter form  -->
					<form action="" class="d-flex" name="filter_timesheet" method="GET" id="filter_timesheet_form">
						<!-- Filter by project  -->
						<div class="dropdown me-3">
							<select class="form-select form-select-md select2" name="filter_project" id="filter_project">
								<option value="" disabled selected>Filter by Projects</option>
								@foreach($projects as $project)
									<option {{ ($_GET['filter_project'] ?? '') == $project->project_id ? 'selected' : '' }} value="{{ $project->project_id }}">
										{{ $project->project_id }} ( {{ $project->project_name }} )
									</option>
								@endforeach
							</select>
						</div>

						<div class="dropdown me-3">
							<select class="form-select form-select-md select2" name="filter_user" id="filter_user">
								<option value="" disabled selected>Filter by Users</option>
								@foreach($users as $user)
									<option {{ ($_GET['filter_user'] ?? '') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="dropdown me-3">
							<input 
								type="date" 
								class="form-control form-control-md" 
								name="filter_entry_date" 
								id="filter_entry_date" 
								placeholder="Filter by Entry Date"
								value="{{ request('filter_entry_date') ? date('Y-m-d', strtotime(request('filter_entry_date'))) : '' }}"
							>
						</div>
						<div class="d-flex justify-content-end ms-3">
							<button type="button" class="btn btn-primary ms-2" id="filter_btn">Filter</button>
							<button type="button" class="btn btn-secondary ms-2" id="reset_filters_btn">Reset</button>
						</div>
					</form>
					<!-- Filter form  -->
				</div>
			</div>

			<x-table 
				title="Time sheet" 
				:headers="['S.No', 'Project Code', 'User', 'Staff ID', 'Entry Date', 'Hours spent', 'Cost per Hour', 'Total Cost', 'Status', 'Actions']" 
				:fields="[ 
							'project_id',
                            'user_name',
							'staff_id',
							'entry_date',
							'hours_spent',
							'hourly_charges',
							'total_cost',
							'status',
							'actions'
						]" 
				:rows="$Timesheet"
				module='timesheet'
                edit='false'
                preview='true'
                delete='false'
			/>

			<!-- Total hrs , Total cost alignment right side   -->
			<div class="container mb-2">
				<div class="text-end">
					<p class=""><strong>Total Hours:</strong> {{ $totalHours }}</p>
					<p class=""><strong>Total Cost:</strong> {{ $totalHourlyChargesSum }}</p>
				</div>
				
			</div>

			<!--Model box  -->
			@include('admin.timesheet.view')

			 

		@endsection
		
	@section('scripts')
		<!-- -- ensure jQuery + validation + toastr are loaded before custom scripts - -->
			@include('admin.layouts.validation-links')
			<!-- Custom JS -->
			<script src="{{ asset('assets/js/users-timesheet/admin-timesheet.js') }}"></script>
	@endsection


@push('styles')
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/webfonts/css/all.min.css') }}"> -->
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush


   