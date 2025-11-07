@extends('admin.layouts.main')
@section('title', 'Timesheet')
@section('innerPageTitleIconClass', 'ti ti-briefcase')
@section('inner_page_title', 'Timesheet List')
@section('inner_page_subtitle', 'Timesheet Management')
@section('inner_page_title2', 'Timesheet List')

<!-- inner section -->
 <!-- add user button  -->
  @section('inner_button_section')
	<div class="d-flex justify-content-end mb-3">
		<a href="#" data-bs-toggle="modal" data-bs-target="#model_item" class="create-btn btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Add Log hours</a>
		<!-- <button href="#" class="refresh">refresh</button> -->
		<!-- <button id="refreshBtn" class="btn btn-primary">Refresh Projects</button> -->
	</div>
	@endsection
 <!-- add user button  -->
	
		
		@section('content')

			<x-table 
				title="Time sheet" 
				:headers="['S.No', 'Project Code', 'Staff ID', 'Entry Date', 'Hours spent', 'Project Status', 'Actions']" 
				:fields="[ 
							'project_id',
							'staff_id',
							'entry_date',
							'hours_spent',
							'project_status',
							'actions'
						]" 
				:rows="$Timesheet"
				module='timesheet'
				edit="true"
                preview="false"
                delete="true"
			/>

			<!--Model box  -->
			@include('admin.timesheet.create')

			 

		@endsection
		
	@section('scripts')
		<!-- -- ensure jQuery + validation + toastr are loaded before custom scripts - -->
			@include('admin.layouts.validation-links')
			<!-- Custom JS -->
			<script src="{{ asset('assets/js/users-timesheet/timesheet.js') }}"></script>
	@endsection


@push('styles')
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/webfonts/css/all.min.css') }}"> -->
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush


   