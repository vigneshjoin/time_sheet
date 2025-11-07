@extends('admin.layouts.main')
@section('title', 'Projects')
@section('menu_title2', ' Project - Management')
@section('innerPageTitleIconClass', 'ti ti-briefcase')
@section('inner_page_title', 'Projects List')
@section('inner_page_subtitle', 'Projects Management')
@section('inner_page_title2', 'Projects List')

@php
	$user = Auth::user();
	$user_type = $user->user_type;
	if($user_type == 'admin' || $user_type == 'super_admin' ){
		$type = 'true';
		$viewType = 'false';
	}else{
		$type = 'false';	
		$viewType = 'true';

	}
@endphp

<!-- inner section -->
 <!-- add user button  -->
  @section('inner_button_section')
		@if($user ->user_type == 'admin' || $user ->user_type == 'super_admin' )
			<div class="d-flex justify-content-end mb-3">
				<a href="#" data-bs-toggle="modal" data-bs-target="#model_item" class="create-btn btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Add Projects</a>
			</div>
		@endif
	@endsection
 <!-- add user button  -->
	
		
		@section('content')

		<div class="card-header">

			<div class="d-flex justify-content-end">
				<!-- Filter form  -->
				<form action="" class="d-flex" name="filter_projects" method="GET" id="filter_projects_form">
					<!-- Filter by project  -->
					<div class="dropdown me-3">
						<select class="form-select form-select-md select2" name="filter_project" id="filter_project">
							<option value=""  disabled selected>Filter by Project</option>
							@foreach($ProjectLists as $project)
								<option {{ ($_GET['filter_project'] ?? '') == $project->project_id ? 'selected' : '' }} value="{{ $project->project_id }}">{{ $project->project_id }} ( {{ $project->project_name }} )</option>
							@endforeach
						</select>
					</div>

					<!-- action=filter&filter_start_date=2025-11-01&filter_due_date=2025-11-16 -->
					 <!-- i need to bind the get values in below fileds  -->
					<div class="dropdown me-3">
						<input 
							type="date" 
							class="form-control form-control-md" 
							name="filter_start_date" 
							id="filter_start_date" 
							placeholder="Filter by Start Date"
							value="{{ request('filter_start_date') ? date('Y-m-d', strtotime(request('filter_start_date'))) : '' }}"
						>
					</div>

					<div class="dropdown me-3">
						<input 
							type="date" 
							class="form-control form-control-md" 
							name="filter_due_date" 
							id="filter_due_date" 
							placeholder="Filter by Due Date"
							value="{{ request('filter_due_date') ? date('Y-m-d', strtotime(request('filter_due_date'))) : '' }}"
						>
					</div>


					<div class="dropdown">
						<select class="form-select form-select-md select2" name="filter_status" id="filter_status">
							<option value="" disabled selected>Filter by Status</option>
							<option value="Not Started" {{ ($_GET['filter_status'] ?? '') == 'Not Started' ? 'selected' : '' }}>Not Started</option>
							<option value="In Progress" {{ ($_GET['filter_status'] ?? '') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
							<option value="Completed" {{ ($_GET['filter_status'] ?? '') == 'Completed' ? 'selected' : '' }}>Completed</option>
							<option value="On Hold" {{ ($_GET['filter_status'] ?? '') == 'On Hold' ? 'selected' : '' }}>On Hold</option>
						</select>
					</div>
					<div class="d-flex justify-content-end ms-3">
						<button type="button" class="btn btn-primary ms-2" id="filter_projects_btn">Filter</button>
						<button type="button" class="btn btn-secondary ms-2" id="reset_filters_btn">Reset</button>
					</div>
				</form>

				<!-- Filter form  -->

			</div>
			
		</div>

			<x-table 
				title="Project List" 
				:headers="['S.No', 'Project Code', 'Project Start date', 'Project Due date', 'Project Name', 'Status', 'Actions']" 
				:fields="[ 'project_id', 'start_date', 'due_date', 'project_name', 'status', 'actions']" 
				:rows="$ProjectModel"
				module='projects'
				edit="{{ $type }}"
                preview="{{ $viewType }}"
                delete="{{ $type }}"
			/>

			<!--Model box  -->
			@include('admin.projects.create')

		@endsection
		
	@section('scripts')
		<!-- -- ensure jQuery + validation + toastr are loaded before custom scripts - -->
			@include('admin.layouts.validation-links')
			<!-- Select2 JS (for multi-select) -->
			<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
			<!-- Custom JS -->
			<script src="{{ asset('assets/js/admin-project/project.js') }}"></script>

			<script>
				// Initialize Select2 when the modal is shown and destroy on hide to avoid duplicates
				$(document).ready(function() {
					$('#model_item').on('shown.bs.modal', function () {
						if ( $.fn.select2 ) {
							$('#project_users').select2({
								dropdownParent: $('#model_item'),
								placeholder: 'Select users',
								allowClear: true,
								width: '100%'
							});
						}
					});
				});
			</script>
	@endsection


@push('styles')
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush


