		@php
			use Illuminate\Support\Facades\Auth;
			$user = Auth::user();
		@endphp
		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<!-- Logo -->
			<div class="sidebar-logo">
				<a href="#" class="logo logo-normal">
					
					<img src="{{ asset('assets/img/logo.webp') }}" alt="Logo"  style="width: 60%;margin-left: 15%;">
				</a>
				<a href="#" class="logo-small">
					<img src="{{ asset('assets/img/logo.webp') }}" alt="Logo">
				</a>
				<a href="#" class="dark-logo">
					<img src="{{ asset('assets/img/logo.webp') }}" alt="Logo">
				</a>
			</div>
			<!-- /Logo -->
			<div class="modern-profile p-3 pb-0">
				<div class="text-center rounded bg-light p-3 mb-4 user-profile">
					<div class="avatar avatar-lg online mb-3">
						<img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="Img" class="img-fluid rounded-circle">
					</div>
					<h6 class="fs-12 fw-normal mb-1">Adrian Herman</h6>
					<p class="fs-10">System Admin</p>
				</div>
				<div class="sidebar-nav mb-3">
					<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent"
						role="tablist">
						<li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
						<li class="nav-item"><a class="nav-link border-0" href="#">Chats</a></li>
						<li class="nav-item"><a class="nav-link border-0" href="#">Inbox</a></li>
					</ul>
				</div>
			</div>
			<div class="sidebar-header p-3 pb-0 pt-2">
				<div class="text-center rounded bg-light p-2 mb-4 sidebar-profile d-flex align-items-center">
					<div class="avatar avatar-md online">
						<img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="Img" class="img-fluid rounded-circle">
					</div>
					<div class="text-start sidebar-profile-info ms-2">
						<h6 class="fs-12 fw-normal mb-1">Adrian Herman</h6>
						<p class="fs-10">System Admin</p>
					</div>
				</div>
				<div class="input-group input-group-flat d-inline-flex mb-4">
					<span class="input-icon-addon">
						<i class="ti ti-search"></i>
					</span>
					<input type="text" class="form-control" placeholder="Search in HRMS">
					<span class="input-group-text">
						<kbd>CTRL + / </kbd>
					</span>
				</div>
				<div class="d-flex align-items-center justify-content-between menu-item mb-3">
					<div class="me-3">
						<a href="#" class="btn btn-menubar">
							<i class="ti ti-layout-grid-remove"></i>
						</a>
					</div>
					<div class="me-3">
						<a href="#" class="btn btn-menubar position-relative">
							<i class="ti ti-brand-hipchat"></i>
							<span class="badge bg-info rounded-pill d-flex align-items-center justify-content-center header-badge">5</span>
						</a>
					</div>
					<div class="me-3 notification-item">
						<a href="#" class="btn btn-menubar position-relative me-1">
							<i class="ti ti-bell"></i>
							<span class="notification-status-dot"></span>
						</a>
					</div>
					<div class="me-0">
						<a href="#" class="btn btn-menubar">
							<i class="ti ti-message"></i>
						</a>
					</div>
				</div>
			</div>


			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul class="menu">


						<!-- //$user -->
						 @if(isset($user) && $user->user_type === 'admin' || $user->user_type === 'super_admin')
							<li class="menu-item">
								<a href="{{ route('admin.users.index') }}" >
									<i class="ti ti-users" style="margin-right: 5px;"></i> 
									<span> Users - Management</span>
								</a>
							</li>

							<li class="menu-item">
								<a href="{{ route('admin.projects.index') }}">
									<i class="ti ti-briefcase" style="margin-right: 5px;"></i> 
									<span> Project - Management</span>
								</a>
							</li>

							@elseif(isset($user) && $user->user_type === 'staff')

							<li class="menu-item">
								<a href="{{ route('admin.projects.index') }}">
									<i class="ti ti-briefcase" style="margin-right: 5px;"></i> 
									<span> Project - Management</span>
								</a>
							</li>

							<li class="menu-item">
								<a href="{{ route('admin.timesheet.index') }}">
									<i class="ti ti-clock" style="margin-right: 5px;"></i> 
									<span> Timesheet </span>
								</a>
							</li>
						@endif




						<!-- <li class="menu-title"><span>MAIN MENU</span></li> -->
						<!-- <li> -->
							<!-- <ul>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-smart-home"></i><span>Dashboard</span><span
											class="badge badge-danger fs-10 fw-medium text-white p-1">Hot</span><span
											class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="#"><i class="ti ti-smart-home"></i> <span>Admin Dashboard</span></a></li>
										<li><a href="#"><i class="ti ti-user"></i> <span>Employee Dashboard</span></a></li>
										<li><a href="#"><i class="ti ti-briefcase"></i> <span>Deals Dashboard</span></a></li>
										<li><a href="#"><i class="ti ti-lead-pencil"></i> <span>Leads Dashboard</span></a></li>
									</ul>
								</li>
								
							</ul> -->
						<!-- </li> -->
					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->
		 <!-- header closing div -->
	</div>
	<!-- /Main Wrapper -->
