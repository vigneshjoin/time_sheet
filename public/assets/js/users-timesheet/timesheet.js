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
                        required: true
                    },
                    user_id: {
                        required: true,
                        digits: true
                    },
                    entry_date: {
                        required: true,
                        date: true
                    },
                    hours_spent: {
                        required: true,
                        number: true,
                        min: 0.1
                    },
                    notes: {
                        maxlength: 1000
                    },
                    status: {
                        required: true
                    }
                },
                messages: {
                    project_code: {
                        required: "Please enter a project ID"
                    },
                    staff_id: {
                        required: "Please select a user",
                        digits: "User ID must be a valid number"
                    },
                    entry_date: {
                        required: "Please select the entry date",
                        date: "Please enter a valid date"
                    },
                    hours_spent: {
                        required: "Please enter hours spent",
                        number: "Please enter a valid number (e.g., 1.5 for 1½ hours)",
                        min: "Hours spent must be 0 or more"
                    },
                    notes: {
                        maxlength: "Notes cannot exceed 1000 characters"
                    },
                    status: {
                        required: "Please select status (Active or Inactive)"
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

        setTimeout(function(){ 
            let entryDate = document.getElementById("entry_date");
            if (entryDate) {
                let today = new Date();
                let yyyy = today.getFullYear();
                let mm = String(today.getMonth() + 1).padStart(2, '0');
                let dd = String(today.getDate()).padStart(2, '0');
                entryDate.value = `${yyyy}-${mm}-${dd}`;
            }
        }, 3000);

    });

    
   
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
            url: 'timesheet/' + Id + '/edit',
            type: 'GET',
            success: function(response) {
                console.info('details retrieved:', response);
                // Populate the modal with user details
                
                $('#project_code').val(response.data.project_id);
                $('input[name="staff_id"]').val(response.data.staff_id);
                
                $('#hours_spent').val(response.data.hours_spent);
                $('#notes').val(response.data.notes);
                $('#status').val(response.data.status);
                let parts = response.data.entry_date.split('-'); // ["03", "12", "2026"]
                let formattedDate = `${parts[2]}-${parts[1]}-${parts[0]}`; // 2026-12-03
                $("#entry_date").val(formattedDate);
                $('#edit_timesheet_id').val(response.data.id);

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
            url: $("#edit_action_url").val().replace(':id', $('#edit_timesheet_id').val()),
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


