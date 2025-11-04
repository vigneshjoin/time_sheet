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
	
    // Form validation
    $(document).on('click', '.create-mode', function() { 
        console.info('create mode clicked');
         if($("#userCreateForm").length > 0) {
        
            $("#userCreateForm").validate({
                ignore: [],
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    // user_name: {
                    //     required: true,
                    //     minlength: 3
                    // },
                    company_name: {
                        required: true
                    },
                    staff_id: {
                        required: true
                    },
                    hourly_charges: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#userPassword"
                    },
                    status: {
                        required: true
                    },
                    user_type: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter name",
                        minlength: "Name must be at least 3 characters"
                    },
                    email: {
                        required: "Please enter email",
                        email: "Please enter valid email"
                    },
                    // user_name: {
                    //     required: "Please enter username",
                    //     minlength: "Username must be at least 3 characters"
                    // },
                    company_name: "Please enter company name",
                    staff_id: "Please enter staff ID",
                    hourly_charges: {
                        required: "Please enter hourly charges",
                        number: "Please enter valid number",
                        min: "Charges must be greater than 0"
                    },
                    password: {
                        required: "Please enter password",
                        minlength: "Password must be at least 8 characters"
                    },
                    password_confirmation: {
                        required: "Please confirm password",
                        equalTo: "Passwords do not match"
                    },
                    status: "Please select status",
                    user_type: "Please select role"
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.mb-3').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                submitHandler: function(form) {
                    // debug log to confirm handler runs
                    console.debug('userCreateForm submitHandler invoked');
                    
                    // jQuery Validate prevents the native submit automatically,
                    // so do not call event.preventDefault() here.

                    var $submitBtn = $('#UserSubmitBtn');
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
                                toastr.success('User created successfully');
                                form.reset();
                                // refresh page 
                                window.location.reload();
                            }else{
                                toastr.error('Something went wrong!');
                                        //                 return response()->json([
                                        //     'status' => 'error',
                                        //     'message' => 'Something went wrong.',
                                        //     'error' => $e->getMessage(),
                                        // ], 500);    this is my response in controller add code need to show error message in ajax
                                
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
        $("#UserSubmitBtn").addClass('create-mode');
        $("#UserSubmitBtn").removeClass('edit-mode');
       document.getElementById("userCreateForm").reset();
       $('#UserSubmitBtn').empty().html('Create User');
       $('.modal-title').empty().html('Create User');
    //    $('#_is_edit').val('0');
       clearValidationErrors('#userCreateForm');
    });

    $(document).on('click', '.view-btn', function() {
        $('.modal-title').empty().html('View User');
    });
   
    //userId when model will be open i need to trigger get users by user id ajax 
    $(document).on('click', '.edit-Id', function() { 
        $("#UserSubmitBtn").removeClass('create-mode');
        $("#UserSubmitBtn").addClass('edit-mode');
        var userId = $(this).data('user-id');
        // $('#_is_edit').val('1');
        $(".password-field").hide();
        $('#UserSubmitBtn').empty().html('Update User');
        $('.modal-title').empty().html('Update User');
        clearValidationErrors('#userCreateForm');
        // Trigger AJAX request to get user details
        $.ajax({
            url: 'users/' + userId + '/edit',
            type: 'GET',
            success: function(response) {
                console.info('User details retrieved:', response);
                // Populate the modal with user details
                $('#Name').val(response.data.name);
                $('#userEmail').val(response.data.email);
                // $('#username').val(response.data.user_name);
                $('#companyName').val(response.data.company_name);
                $('#staffId').val(response.data.staff_id);
                $('#hourlyCharges').val(response.data.hourly_charges);
                $('#userStatus').val(response.data.status);
                $('#userRole').val(response.data.user_type);
                $('#edit_user_id').val(response.data.id);

                // $('.preview-image').src($('#image_folder').val() + '/' + response.data.avatar);
                // $('.preview-image').attr('src', $('#image_folder').val() + '/' + response.data.avatar);

                //preview-image
                // var $previewImage = 
                // if ($previewImage.length && response.data.avatar) {
                //     var avatarUrl = response.data.avatar.startsWith('http') 
                //         ? response.data.avatar 
                //         : '/storage/avatars/' + response.data.avatar;
                //     $previewImage.attr('src', avatarUrl).show();
                // } else {
                //     $('.preview-image').hide();
                // }
            },
            error: function(xhr) {
                toastr.error('Failed to retrieve user details.');
            }
        });
    }); 


     $(document).on('click', '.edit-mode', function() { 
        // if($('#_is_edit').val() == '0'){
        //     $("#userCreateForm").validate().form();
        //     return false;
        // }else{
        //     // $("#userCreateForm") this form error msg need to clear before submit
        //     $("#userCreateForm").validate().resetForm();
            
        // }
        // e.preventDefault();
        console.info('Edit mode clicked');
        var $submitBtn = $('#UserSubmitBtn');
        $submitBtn.prop('disabled', true)
            .html('<span class="spinner-border spinner-border-sm"></span> Updating...');

        var formEl = document.getElementById('userCreateForm');
        var formData = new FormData(formEl);

        // Method spoofing: send POST with _method=PUT so Laravel accepts it and CSRF is enforced
        formData.set('_method', 'PUT');
        // ensure _token exists in FormData (in case it's missing)
        if (!formData.has('_token')) {
            var metaToken = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val();
            if (metaToken) formData.set('_token', metaToken);
        }

        $.ajax({
            url: $("#edit_action_url").val().replace(':id', $('#edit_user_id').val()),
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

