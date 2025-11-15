 <!-- Inner page breadcrumb section  -->
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb">
	<div class="my-auto mb-2">
		<h2 class="mb-1">@yield('inner_page_title', 'Please add title - inner_page_title')</h2>
		<nav>
			<ol class="breadcrumb mb-0">
				<li class="breadcrumb-item">
					<a href="#">
						<i class="@yield('innerPageTitleIconClass', 'ti ti-smart-home')"></i>
					</a>
				</li>
				<li class="breadcrumb-item">
					@yield('inner_page_subtitle', 'Please add sub-title - inner_page_subtitle')
				</li>
				<li class="breadcrumb-item active" aria-current="page">
					@yield('inner_page_title2', 'Please add sub-title - inner_page_title2')
				</li>
			</ol>
		</nav>
	</div>

	@yield('inner_button_section','Add your button - inner_button_section')
</div>
<!-- End Inner page breadcrumb section  -->