$(function() {
    // Ensure CSRF token is sent with every AJAX request (read from meta tag)
    (function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val();
        if (csrfToken) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        } else {
            console.warn('CSRF token not found in meta tag or hidden input.');
        }
    })();

    


    $(document).on('click', '#updateSubmitBtn', function() {
        console.info('Update button clicked');
        $(this).prop('disabled', true)
            .html('<span class="spinner-border spinner-border-sm"></span> Updating...');

        $.ajax({
            url: $("#home_url").val() + '/projects/status_update/' + $('#edit_project_id').val() ,
            type: 'PUT',
            data: {
                status: $('#status').val(),
                project_id: $('#project_id').val(),
                _token: $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val()
            },
            success: function(response) {
                if(response.status == 'success') {
                    toastr.success('Updated successfully');
                    $(".btn-close").click();
                    window.location.reload();
                }else{
                    toastr.error('Something went wrong!');
                    toastr.error('Please check the form for errors and try again.',toastr.error);
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('Something went wrong!');
                }
            },
            complete: function() {
                $(this).prop('disabled', false).html('Updated');
            }
        });


    });
    // Form validation  SubmitBtn
    $(document).on('click', '.create-mode', function() { 
        console.info('create mode clicked');
        if ($("#CreateForm").length > 0) {

            $("#CreateForm").validate({
                ignore: [],
                rules: {
                    project_id: {
                        required: true,
                        minlength: 3
                    },
                    // for multiple select named project_users[] use exact name
                    'project_users[]': {
                        required: true,
                        minlength: 1
                    },
                    project_name: {
                        required: true,
                        minlength: 3
                    },
                    description: {
                        maxlength: 500
                    },
                    start_date: {
                        required: true,
                        date: true
                    },
                    due_date: {
                        required: true,
                        date: true
                    },
                    status: {
                        required: true
                    }
                },
                messages: {
                    project_id: {
                        required: "Please enter project ID",
                        minlength: "Project ID must be at least 3 characters"
                    },
                    'project_users[]': "Please select at least one user",
                    project_name: {
                        required: "Please enter project name",
                        minlength: "Project name must be at least 3 characters"
                    },
                    description: {
                        maxlength: "Description cannot exceed 500 characters"
                    },
                    start_date: {
                        required: "Please select a start date",
                        date: "Please enter a valid date"
                    },
                    due_date: {
                        required: "Please select a due date",
                        date: "Please enter a valid date"
                    },
                    status: {
                        required: "Please select a project status"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.mb-3').append(error);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                submitHandler: function (form) {

                    var $submitBtn = $('#SubmitBtn');
                    $submitBtn.prop('disabled', true)
                        .html('<span class="spinner-border spinner-border-sm"></span> Creating...');

                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if(response.status == 'success') {
                                toastr.success('Created successfully');
                                form.reset();
                                // refresh page 
                                window.location.reload();
                            }else{
                                toastr.error('Something went wrong!');
                                toastr.error('Please check the form for errors and try again.',toastr.error);
                            }
                        },
                        error: function(xhr) {
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    toastr.error(value[0]);
                                });
                            } else {
                                toastr.error('Something went wrong!');
                            }
                        },
                        complete: function() {
                            $submitBtn.prop('disabled', false).html('Create User');
                        }
                    });
                }
            });
        }
    });

    $(document).on('click', '.create-btn', function() { 
        $("#SubmitBtn").addClass('create-mode');
        $("#SubmitBtn").removeClass('edit-mode');
       document.getElementById("CreateForm").reset();
       $('#SubmitBtn').empty().html('Create');
       $('.modal-title').empty().html('Create Project');
       clearValidationErrors('#CreateForm');
    });

    // Initialize select2 when modal opens
    // Ensure select2 is initialized when modal opens and selection changes propagate
//     $('#model_item').on('shown.bs.modal', function () {
// 	// init select2 if available
// 	if ($.fn.select2 && !$('#project_users').data('select2')) {
// 		$('#project_users').select2({
// 			dropdownParent: $('#model_item'),
// 			placeholder: 'Select users',
// 			allowClear: true,
// 			width: '100%'
// 		});
// 	}
// 	// propagate change to update UI (use select2-specific event if present)
// 	$('#project_users').trigger('change');
// });

    //userId when model will be open i need to trigger get users by user id ajax 
    $(document).on('click', '.edit-Id', function() { 
        $("#SubmitBtn").removeClass('create-mode');
        $("#SubmitBtn").addClass('edit-mode');
        var Id = $(this).data('user-id');
        $(".password-field").hide();
        $('#SubmitBtn').empty().html('Update');
        $('.modal-title').empty().html('Update Project');
        clearValidationErrors('#CreateForm');
        // Trigger AJAX request to get user details
        $.ajax({
            url: 'projects/' + Id + '/edit',
            type: 'GET',
            success: function(response) {
                console.info('details retrieved:', response);
                $('#project_id').val(response.data.project_id);
                $('#project_name').val(response.data.project_name);
                $('#description').val(response.data.description);
                // Robustly bind project_users (handles array or JSON-string)
                var ids = [];
                if (Array.isArray(response.data.user_ids)) {
                    ids = response.data.user_ids;
                } else if (Array.isArray(response.data.users)) {
                    ids = response.data.users;
                } else if (typeof response.data.user_ids === 'string' && response.data.user_ids.trim() !== '') {
                    try {
                        var parsed = JSON.parse(response.data.user_ids);
                        if (Array.isArray(parsed)) ids = parsed;
                    } catch (e) {
                        ids = response.data.user_ids.replace(/[\[\]\s"']/g, '').split(',').filter(Boolean);
                    }
                }
                // normalize to strings (option values may be strings)
                ids = ids.map(function(v){ return String(v); });
                // set the select values
                $('#project_users').val(ids);
                // ensure DOM options are selected (some browsers/plugins require this)
                $('#project_users option').each(function() {
                    $(this).prop('selected', ids.indexOf(String($(this).val())) !== -1);
                });
                // trigger change so UI (and select2 if present) updates
                $('#project_users').trigger('change');

                var dateString = response.data.start_date; // "01-11-2025, 12:00 AM"
                if (dateString) {
                    var parts = dateString.split(",")[0].split("-"); // ["01","11","2025"]
                    var formattedDate = parts[2] + "-" + parts[1] + "-" + parts[0]; // "2025-11-01"
                    $("#start_date").val(formattedDate);
                }

                var dueDate = response.data.due_date; // "05-11-2025, 12:00 AM"
                if (dueDate) {
                    var parts2 = dueDate.split(",")[0].split("-");
                    var formattedDue = parts2[2] + "-" + parts2[1] + "-" + parts2[0];
                    $("#due_date").val(formattedDue);
                }


                $('#status').val(response.data.status);
                $('#edit_project_id').val(response.data.id);
            },
            error: function(xhr) {
                toastr.error('Failed to retrieve details.');
            }
        });
    }); 

    $(document).on('click', '.view-btn', function() {
        $('.modal-title').empty().html('View Project');
    });
     $(document).on('click', '.edit-mode', function() { 
        
        console.info('Edit mode clicked');
        var $submitBtn = $('#SubmitBtn');
        $submitBtn.prop('disabled', true)
            .html('<span class="spinner-border spinner-border-sm"></span> Updating...');

        var formEl = document.getElementById('CreateForm');
        var formData = new FormData(formEl);

        // Method spoofing: send POST with _method=PUT so Laravel accepts it and CSRF is enforced
        formData.set('_method', 'PUT');
        // ensure _token exists in FormData (in case it's missing)
        if (!formData.has('_token')) {
            var metaToken = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val();
            if (metaToken) formData.set('_token', metaToken);
        }

        $.ajax({
            url: $("#edit_action_url").val().replace(':id', $('#edit_project_id').val()),
            type: 'POST', // use POST with _method=PUT (method spoofing)
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success('User updated successfully');
                    formEl.reset();
                    window.location.reload();
                } else {
                    toastr.error('Please check the form for errors and try again.');
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('Something went wrong!');
                }
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html('Create User');
            }
        });
    });


    $(document).on('click', '#reset_filters_btn', function() {
        $('#filter_project').val('');
        $('#filter_start_date').val('');
        $('#filter_due_date').val('');
        $('#filter_status').val('');
        window.location.href = $("#home_url").val() + '/projects';
    });

    $(document).on('click', '#filter_projects_btn', function() {
        var project = $('#filter_project').val();
        var start_date = $('#filter_start_date').val();
        var due_date = $('#filter_due_date').val();
        var status = $('#filter_status').val();
        var queryParams = [];
        if (project) {
            queryParams.push('filter_project=' + encodeURIComponent(project));
        }
        if (start_date) {
            queryParams.push('filter_start_date=' + encodeURIComponent(start_date));
        }
        if (due_date) {
            queryParams.push('filter_due_date=' + encodeURIComponent(due_date));
        }
        if (status) {
            queryParams.push('filter_status=' + encodeURIComponent(status));
        }
        var queryString = queryParams.length > 0 ? '?action=filter&' + queryParams.join('&') : '';
        window.location.href = $("#home_url").val() + '/projects' + queryString;
    });
});



function clearValidationErrors(id) {
    $('span.error-text').text('');
    $(id).find('.is-invalid').removeClass('is-invalid');
}

