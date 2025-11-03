@extends('admin.layouts.main')
@section('title', 'Projects')
@section('menu_title2', ' Project - Management')
@section('innerPageTitleIconClass', 'ti ti-briefcase')
@section('inner_page_title', 'Projects List')
@section('inner_page_subtitle', 'Projects Management')
@section('inner_page_title2', 'Projects List')

<!-- inner section -->
 <!-- add user button  -->
  @section('inner_button_section')
	<div class="d-flex justify-content-end mb-3">
		<a href="#" data-bs-toggle="modal" data-bs-target="#model_item" class="create-btn btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Add Projects</a>
	</div>
	@endsection
 <!-- add user button  -->
	
		
		@section('content')

			<x-table 
				title="Project List" 
				:headers="['S.No', 'Project Code', 'Project Name', 'Status', 'Actions']" 
				:fields="[ 'project_id', 'project_name', 'status', 'actions']" 
				:rows="$ProjectModel"
				module='projects'
			/>

			<!--Model box  -->
			@include('admin.projects.create')

			 

		@endsection
		
	@section('scripts')
		<!-- -- ensure jQuery + validation + toastr are loaded before custom scripts - -->
			@include('admin.layouts.validation-links')
			<!-- Custom JS -->
			<script src="{{ asset('assets/js/admin-project/project.js') }}"></script>
	@endsection


@push('styles')
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/webfonts/css/all.min.css') }}"> -->
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush


