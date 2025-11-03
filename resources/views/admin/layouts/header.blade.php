<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="Smarthr - Bootstrap Admin Template">
	<meta name="keywords" content="admin, estimates, bootstrap, business, html5, responsive, Projects">
	<meta name="author" content="Dreams technologies - Bootstrap Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>@yield('title', 'Time Sheet - Tool')</title>
	<!-- basic details -->
	<input type="hidden" name="home_url" id="home_url" value="{{ url('/') }}">
	<!-- Favicon -->
	<!-- <link rel="shortcut icon" type="image/x-icon" href="https://smarthr.co.in/demo/html/template/assets/img/favicon.png"> -->

	<!-- Apple Touch Icon -->
	<!-- <link rel="apple-touch-icon" sizes="180x180" href="https://smarthr.co.in/demo/html/template/assets/img/apple-touch-icon.png"> -->

	<!-- Theme Script js -->
	<script src="{{ asset('admin/assets/js/theme-script.js') }}"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

	<!-- Feather CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/feather.css') }}">

	<!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/assets/css/all.min.css') }}">
	

	<link rel="stylesheet" href="{{ asset('admin/assets/css/all.min.css') }}">

	 <!-- Color Picker Css -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/assets/css/nano.min.css') }}">

	<!-- Daterangepicker CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/daterangepicker.css') }}">

	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap5.min.css') }}">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-datetimepicker.min.css') }}">

	<!-- Summernote CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/summernote-lite.min.css') }}">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">

	<!-- Bootstrap Tagsinput CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-tagsinput.css') }}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/style-min.css') }}">

</head>

<body>
    <div id="global-loader" style="display: none;">
		<div class="page-loader"></div>
	</div>

	@php
		use Illuminate\Support\Facades\Auth;
		$user = Auth::user();
	@endphp

    <!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header">
			<div class="main-header">
			
				<!-- <div class="header-left">
					<a href="https://smarthr.co.in/demo/html/template/index.html" class="logo">
						<img src="https://smarthr.co.in/demo/html/template/assets/img/logo.svg" alt="Logo">
					</a>
					<a href="https://smarthr.co.in/demo/html/template/index.html" class="dark-logo">
						<img src="https://smarthr.co.in/demo/html/template/assets/img/logo-white.svg" alt="Logo">
					</a>
				</div> -->

				<a id="mobile_btn" class="mobile_btn" href="#sidebar">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>

				<div class="header-user">
					<div class="nav user-menu nav-list">
	
						<div class="me-auto d-flex align-items-center" id="header-search" >					
							<a id="toggle_btn" href="javascript:void(0);" class="btn btn-menubar me-1">
								<i class="ti ti-arrow-bar-to-left"></i>
							</a>						
							<!-- Search -->
							<!-- <div class="input-group input-group-flat d-inline-flex me-1" >
								<span class="input-icon-addon">
									<i class="ti ti-search"></i>
								  </span>
								<input type="text" class="form-control" placeholder="Search in HRMS">
								<span class="input-group-text">
								  <kbd>CTRL + / </kbd>
								</span>
							</div> -->
							<!-- /Search -->
							<div class="dropdown crm-dropdown" style="display: none;">
								<a href="#" class="btn btn-menubar me-1" data-bs-toggle="dropdown">
									<i class="ti ti-layout-grid"></i>
								</a>
								<div class="dropdown-menu dropdown-lg dropdown-menu-start">
									<div class="card mb-0 border-0 shadow-none">
										<div class="card-header">
											<h4>CRM</h4>
										</div>
										<div class="card-body pb-1">		
											<div class="row">
												<div class="col-sm-6">							
													<a href="#" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
														<span class="d-flex align-items-center me-3">
															<i class="ti ti-user-shield text-default me-2"></i>Contacts
														</span>
														<i class="ti ti-arrow-right"></i>
													</a>							
													<a href="#" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
														<span class="d-flex align-items-center me-3">
															<i class="ti ti-heart-handshake text-default me-2"></i>Deals
														</span>
														<i class="ti ti-arrow-right"></i>
													</a>								
													<a href="#" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
														<span class="d-flex align-items-center me-3">
															<i class="ti ti-timeline-event-text text-default me-2"></i>Pipeline
														</span>
														<i class="ti ti-arrow-right"></i>
													</a>		
												</div>
												<div class="col-sm-6">							
													<a href="#" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
														<span class="d-flex align-items-center me-3">
															<i class="ti ti-building text-default me-2"></i>Companies
														</span>
														<i class="ti ti-arrow-right"></i>
													</a>								
													<a href="#" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
														<span class="d-flex align-items-center me-3">
															<i class="ti ti-user-check text-default me-2"></i>Leads
														</span>
														<i class="ti ti-arrow-right"></i>
													</a>								
													<a href="#" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
														<span class="d-flex align-items-center me-3">
															<i class="ti ti-activity text-default me-2"></i>Activities
														</span>
														<i class="ti ti-arrow-right"></i>
													</a>		
												</div>
											</div>		
										</div>
									</div>
								</div>
							</div>
							<a href="#" class="btn btn-menubar" style="display: none;">
								<i class="ti ti-settings-cog"></i>
							</a>					
						</div>
	
                        <!-- HorizontalSidebar -->
                         <!-- resources\views\admin\layouts\HorizontalSidebar.blade.php -->
	
						<div class="d-flex align-items-center">
							<div class="me-1">
								<a href="#" class="btn btn-menubar btnFullscreen">
									<i class="ti ti-maximize"></i>
								</a>
							</div>
							<div class="dropdown me-1" style="display: none;">
								<a href="#" class="btn btn-menubar" data-bs-toggle="dropdown">
									<i class="ti ti-layout-grid-remove"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="card mb-0 border-0 shadow-none">
										<div class="card-header">
											<h4>Applications</h4>
										</div>
										<div class="card-body">											
											<a href="https://smarthr.co.in/demo/html/template/calendar.html" class="d-block pb-2">
												<span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-calendar text-gray-9"></i></span>Calendar
											</a>										
											<a href="https://smarthr.co.in/demo/html/template/todo.html" class="d-block py-2">
												<span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-subtask text-gray-9"></i></span>To Do
											</a>										
											<a href="https://smarthr.co.in/demo/html/template/notes.html" class="d-block py-2">
												<span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-notes text-gray-9"></i></span>Notes
											</a>										
											<a href="https://smarthr.co.in/demo/html/template/file-manager.html" class="d-block py-2">
												<span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-folder text-gray-9"></i></span>File Manager
											</a>								
											<a href="https://smarthr.co.in/demo/html/template/kanban-view.html" class="d-block py-2">
												<span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-layout-kanban text-gray-9"></i></span>Kanban
											</a>								
											<a href="https://smarthr.co.in/demo/html/template/invoices.html" class="d-block py-2 pb-0">
												<span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-file-invoice text-gray-9"></i></span>Invoices
											</a>
										</div>
									</div>
								</div>
							</div>
							
                            
                            <div class="me-1" style="display: none;">
								<a href="#" class="btn btn-menubar position-relative">
									<i class="ti ti-brand-hipchat"></i>
									<span class="badge bg-info rounded-pill d-flex align-items-center justify-content-center header-badge">5</span>
								</a>
							</div>
							<div class="me-1" style="display: none;">
								<a href="#" class="btn btn-menubar">
									<i class="ti ti-mail"></i>
								</a>
							</div>
							<div class="me-1 notification_item" style="display: none;">
								<a href="#" class="btn btn-menubar position-relative me-1"
									id="notification_popup" data-bs-toggle="dropdown">
									<i class="ti ti-bell"></i>
									<span class="notification-status-dot"></span>
								</a>
								<div class="dropdown-menu dropdown-menu-end notification-dropdown p-4">
									<div class="d-flex align-items-center justify-content-between border-bottom p-0 pb-3 mb-3">
										<h4 class="notification-title">Notifications (2)</h4>
										<div class="d-flex align-items-center">
											<a href="#" class="text-primary fs-15 me-3 lh-1">Mark all as read</a>
											<div class="dropdown">
												<a href="javascript:void(0);" class="bg-white dropdown-toggle"
													data-bs-toggle="dropdown"><i class="ti ti-calendar-due me-1"></i>Today
												</a>
												<ul class="dropdown-menu mt-2 p-3">
													<li>
														<a href="javascript:void(0);" class="dropdown-item rounded-1">
															This Week
														</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item rounded-1">
															Last Week
														</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item rounded-1">
															Last Month
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="noti-content">
										<div class="d-flex flex-column">
											<div class="border-bottom mb-3 pb-3">
												<a href="#">
													<div class="d-flex">
														<span class="avatar avatar-lg me-2 flex-shrink-0">
															<img src="#" alt="Profile">
														</span>
														<div class="flex-grow-1">
															<p class="mb-1"><span class="text-dark fw-semibold">Shawn</span>
																performance in Math is
																below the threshold.</p>
															<span>Just Now</span>
														</div>
													</div>
												</a>
											</div>
											<div class="border-bottom mb-3 pb-3">
												<a href="#" class="pb-0">
													<div class="d-flex">
														<span class="avatar avatar-lg me-2 flex-shrink-0">
															<img src="#" alt="Profile">
														</span>
														<div class="flex-grow-1">
															<p class="mb-1"><span
																	class="text-dark fw-semibold">Sylvia</span> added
																appointment on
																02:00 PM</p>
															<span>10 mins ago</span>
															<div
																class="d-flex justify-content-start align-items-center mt-1">
																<span class="btn btn-light btn-sm me-2">Deny</span>
																<span class="btn btn-primary btn-sm">Approve</span>
															</div>
														</div>
													</div>
												</a>
											</div>
											<div class="border-bottom mb-3 pb-3">
												<a href="#">
													<div class="d-flex">
														<span class="avatar avatar-lg me-2 flex-shrink-0">
															<img src="#" alt="Profile">
														</span>
														<div class="flex-grow-1">
															<p class="mb-1">New student record <span class="text-dark fw-semibold"> George</span> 
																is created by <span class="text-dark fw-semibold">Teressa</span>
															</p>
															<span>2 hrs ago</span>
														</div>
													</div>
												</a>
											</div>
											<div class="border-0 mb-3 pb-0">
												<a href="#">
													<div class="d-flex">
														<span class="avatar avatar-lg me-2 flex-shrink-0">
															<img src="#" alt="Profile">
														</span>
														<div class="flex-grow-1">
															<p class="mb-1">A new teacher record for <span
																	class="text-dark fw-semibold">Elisa</span>
															</p>
															<span>09:45 AM</span>
														</div>
													</div>
												</a>
											</div>
										</div>
									</div>
									<div class="d-flex p-0">
										<a href="#" class="btn btn-light w-100 me-2">Cancel</a>
										<a href="#" class="btn btn-primary w-100">View All</a>
									</div>
								</div>
							</div>
							<div class="dropdown profile-dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center"
									data-bs-toggle="dropdown" id="profile-section">
									<span class="avatar avatar-sm online">
										<img src="{{ asset('assets/img/unknown-img.png.jpg') }}" alt="Img" class="img-fluid rounded-circle">
									</span>
								</a>
								<div class="dropdown-menu shadow-none logout-section">
									<div class="card mb-0">

										<div class="card-header">
											<div class="d-flex align-items-center">
												<span class="avatar avatar-lg me-2 avatar-rounded">
													<img src="{{ asset('assets/img/unknown-img.png.jpg') }}" alt="img">
												</span>
												<div>
													<h5 class="mb-0">{{ $user->name }}</h5>
													<p class="fs-12 fw-medium mb-0">{{ $user->email }}</p>
												</div>
											</div>
										</div>


										<div class="card-body" style="display: none;">
											<a class="dropdown-item d-inline-flex align-items-center p-0 py-2" href="#">
												<i class="ti ti-user-circle me-1"></i>My Profile
											</a>
											<a class="dropdown-item d-inline-flex align-items-center p-0 py-2" href="#">
												<i class="ti ti-settings me-1"></i>Settings
											</a>

											<a class="dropdown-item d-inline-flex align-items-center p-0 py-2" href="#">
												<i class="ti ti-circle-arrow-up me-1"></i>My Account
											</a>
											<a class="dropdown-item d-inline-flex align-items-center p-0 py-2" href="#">
												<i class="ti ti-question-mark me-1"></i>Knowledge Base
											</a>
										</div>
										<div class="card-footer py-1">
											<a class="dropdown-item d-inline-flex align-items-center p-0 py-2" href="logout"><i
												class="ti ti-login me-2"></i>Logout</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-ellipsis-v"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="#">My Profile</a>
						<a class="dropdown-item" href="#">Settings</a>
						<a class="dropdown-item" href="#">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->

			</div>

		</div>
		<!-- /Header -->


		<!-- ✅ Load jQuery first -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<!-- ✅ Then Bootstrap (optional) -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

		<!-- ✅ Then DataTables -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
		<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>



		<!-- ready function innor click function -->
		<script>
			$(document).ready(function() {
			    // Your code here
				$('#profile-section').on('click', function() {
					if($('.logout-section').hasClass('show')) {
						$('.logout-section').removeClass('show');
					}else{
						$('.logout-section').addClass('show');
					}
				});
			});

	</script>
		<!-- ready function innor click function -->