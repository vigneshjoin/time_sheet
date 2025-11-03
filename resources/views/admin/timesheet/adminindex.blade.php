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

			<x-table 
				title="Time sheet" 
				:headers="['S.No', 'Project Code', 'User', 'Staff ID', 'Entry Date', 'Hours spent', 'Status', 'Actions']" 
				:fields="[ 
							'project_id',
                            'user_name',
							'staff_id',
							'entry_date',
							'hours_spent',
							'status',
							'actions'
						]" 
				:rows="$Timesheet"
				module='timesheet'
                edit='false'
                preview='true'
                delete='false'
			/>

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


   