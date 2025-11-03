@include('admin.layouts.header')
<!-- Main Wrapper -->
		<div id="" class="sidebar-section">
			<div class="main-wrapper main-wrapper-1">
				@include('admin.layouts.sidebar')                
                    <div class="page-wrapper">
                        <div class="content">
                            <!-- Inner page breadcrumb section  -->
                            @include('admin.layouts.breadcrumb')
                            <!-- End Inner page breadcrumb section  -->

                            <div class="card">
                                @yield('content')
                            </div>
                           
                        </div>
                    </div>
			</div>
		</div>
<!-- /Main Wrapper -->

@include('admin.layouts.footer') 