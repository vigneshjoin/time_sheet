	
	@include('admin.auth.change-password')
	
	<!-- ✅ jQuery must load FIRST -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- jQuery -->
	<script data-cfasync="false" src="https://smarthr.co.in/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://smarthr.co.in/demo/html/template/assets/js/jquery-3.7.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

	<!-- Feather Icon JS -->
	<script src="{{ asset('admin/assets/js/feather.min.js') }}"></script>

	<!-- Slimscroll JS -->
	<script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}"></script>

	<!-- Color Picker JS -->
	<script src="{{ asset('admin/assets/js/pickr.es5.min.js') }}"></script>

	<!-- Daterangepikcer JS -->
	<script src="{{ asset('admin/assets/js/moment.min.js') }}"></script>
	<!-- <script src="{{ asset('admin/assets/plugins/daterangepicker/daterangepicker.js') }}"></script> -->
	<script src="{{ asset('admin/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

	<!-- Toastr Notification -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
	
	<!-- Select2 JS -->
	<script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>

	<!-- Summernote JS -->
	<script src="{{ asset('admin/assets/js/summernote-lite.min.js') }}"></script>

	<!-- Bootstrap Tagsinput JS -->
    <script src="{{ asset('admin/assets/js/bootstrap-tagsinput.js') }}"></script>

	<!-- Custom JS -->
	<script src="{{ asset('admin/assets/js/theme-colorpicker.js') }}"></script>
	<script src="{{ asset('admin/assets/js/script.js') }}"></script>
	<script src="{{ asset('admin/assets/js/custom.js') }}"></script>
	@yield('scripts')

	<script>
		// Page-specific DataTable init - initialize only if not already initialized
			document.addEventListener('DOMContentLoaded', function () {
    var selector = '.datatable';

    if (typeof $.fn.dataTable !== 'undefined' && $(selector).length) {
        var $table = $(selector).first();
        var tableId = $table.attr('id');

        // Check if table has <thead> and at least one <th>
        var hasHeader = $table.find('thead th').length > 0;
        // Count header columns
        var headerCount = $table.find('thead th').length;
        // Count columns in the first body row (if exists)
        var bodyCount = $table.find('tbody tr:first td').length;

        // Initialize only if structure is valid
        if (
            tableId &&
            hasHeader &&
            (bodyCount === 0 || bodyCount === headerCount) &&
            !$.fn.dataTable.isDataTable('#' + tableId)
        ) {
            $('#' + tableId).DataTable({
                processing: true,
                pageLength: 25,
                lengthChange: true,
                searching: true,
                ordering: true,
                responsive: true,
                language: {
                    emptyTable: "No records found",
                    paginate: {
                        previous: "<i class='ti ti-chevron-left'></i>",
                        next: "<i class='ti ti-chevron-right'></i>"
                    }
                }
            });
        } else if (bodyCount !== headerCount && bodyCount > 0) {
            console.warn(
                `Skipping DataTable init for #${tableId} — column mismatch (${headerCount} headers vs ${bodyCount} cells).`
            );
        }
    }
});


	</script>

</body>

</html>