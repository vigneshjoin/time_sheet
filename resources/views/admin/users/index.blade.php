@extends('admin.layouts.main')
@section('title', 'Users')

@section('innerPageTitleIconClass', 'ti ti-users')
@section('inner_page_title', 'Users List')
@section('inner_page_subtitle', 'Users Management')
@section('inner_page_title2', 'Users List')

<!-- inner section -->
 <!-- add user button  -->
  @section('inner_button_section')
	<div class="d-flex justify-content-end mb-3">
		<a href="#" data-bs-toggle="modal" data-bs-target="#model_item" class="create-btn btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Add User</a>
	</div>
	@endsection
 <!-- add user button  -->
	
		
		@section('content')
		
			<x-table 
				title="User List" 
				:headers="['S.No',  'Staff ID', 'Email', 'Hourly Charges', 'User Type', 'Created At', 'Actions']" 
				:fields="[ 'staff_id', 'email', 'hourly_charges', 'user_type', 'created_at', 'actions']" 
				:rows="$users"
				module='users'
				edit="true"
                preview="false"
                delete="true"
			/>

			<!--Model box  -->
			@include('admin.users.create')

			 

		@endsection
		
	@section('scripts')
		<!-- -- ensure jQuery + validation + toastr are loaded before custom scripts - -->
			@include('admin.layouts.validation-links')
			<!-- Custom JS -->
			<script src="{{ asset('assets/js/admin-users/users.js') }}"></script>
	@endsection


@push('styles')
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/webfonts/css/all.min.css') }}"> -->
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush


   