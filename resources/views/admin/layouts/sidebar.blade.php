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
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul class="menu">


						<!-- //$user -->
						 @if(isset($user) && $user->user_type === 'admin' || $user->user_type === 'super_admin')
							<li class="menu-item">
								<a href="{{ route('admin.users.index') }}" >
									<i class="ti ti-users" style="margin-right: 5px;"></i> 
									<span> User Management</span>
								</a>
							</li>

							<li class="menu-item">
								<a href="{{ route('admin.projects.index') }}">
									<i class="ti ti-briefcase" style="margin-right: 5px;"></i> 
									<span> Project Management</span>
								</a>
							</li>

							<li class="menu-item">
								<a href="{{ route('admin.timesheet.adminlist') }}">
									<i class="ti ti-clock" style="margin-right: 5px;"></i> 
									<span> Timesheet Log Hours</span>
								</a>
							</li>

							@elseif(isset($user) && $user->user_type === 'staff')

							<li class="menu-item">
								<a href="{{ route('admin.projects.index') }}">
									<i class="ti ti-briefcase" style="margin-right: 5px;"></i> 
									<span> Project Management</span>
								</a>
							</li>

							<li class="menu-item">
								<a href="{{ route('admin.timesheet.index') }}">
									<i class="ti ti-clock" style="margin-right: 5px;"></i> 
									<span> Timesheet Log Hours</span>
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
