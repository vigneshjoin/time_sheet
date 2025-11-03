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
                    project_users: {
                        required: true
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
       $('.modal-title').empty().html('Create');
       clearValidationErrors('#CreateForm');
    });

    // Initialize select2 when modal opens
    

    //userId when model will be open i need to trigger get users by user id ajax 
    $(document).on('click', '.edit-Id', function() { 
        $("#SubmitBtn").removeClass('create-mode');
        $("#SubmitBtn").addClass('edit-mode');
        var Id = $(this).data('user-id');
        $(".password-field").hide();
        $('#SubmitBtn').empty().html('Update');
        $('.modal-title').empty().html('Update');
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
                $('#project_users').val(response.data.users).trigger('change');
                var dateString = response.data.start_date;
                var start_date = dateString ? dateString.split("T")[0] : "";
                $("#start_date").val(start_date);

                var dueDate = response.data.due_date;
                var toDate = dueDate ? dueDate.split("T")[0] : "";
                $("#due_date").val(toDate);

                $('#status').val(response.data.status);
                $('#edit_project_id').val(response.data.id);
            },
            error: function(xhr) {
                toastr.error('Failed to retrieve details.');
            }
        });
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
});



function clearValidationErrors(id) {
    $('span.error-text').text('');
    $(id).find('.is-invalid').removeClass('is-invalid');
}

