/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

$(document).ready(function () {
    // Initialize password form validation
    validatePasswordForm();
});

// Change password form validation
function validatePasswordForm() {

    $("#pwdForm").validate({
        ignore: [],
        rules: {
            cur: {
                required: true
            },
            newpwd: {
                required: true,
                minlength: 8
            },
            conf: {
                required: true,
                equalTo: "#newpwd"
            }
        },
        messages: {
            cur: {
                required: "Please enter your current password"
            },
            newpwd: {
                required: "Please enter a new password",
                minlength: "New password must be at least 8 characters long"
            },
            conf: {
                required: "Please confirm your new password",
                equalTo: "New password and confirmation do not match"
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

            var $submitBtn = $('#saveBtn');
            $submitBtn.prop('disabled', true)
                .html('<span class="spinner-border spinner-border-sm"></span> Updating...');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.status == 'success') {
                        toastr.success('Updated successfully');
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
