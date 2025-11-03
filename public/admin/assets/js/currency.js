$(document).ready(function () {
    $("#master-menu").addClass('active');
    $("#master-menu ul li:eq(3)").addClass('active');

    $('#currency').validate({
        rules: {
            code: {
                required: true
            },
            currency_name: {
                required: true,
                minlength: 1
            },
            rate_type: {
                required: true
            },
            variation: {
                required: true,
                // only alloing decimal values
                // pattern: /^[0-9]+(\.[0-9]{1,2})?$/,
            },
            fc_code: {
                required: true
            },
            fc_name: {
                required: true,
                minlength: 1
            },
            code_raf: {
                required: true
            },
            code_raf_name: {
                required: true,
                minlength: 1
            },
            group_fcy: {
                required: true
            }
        },
        messages: {
            code: {
                required: 'Code is required.'
            },
            currency_name: {
                required: 'Currency Name is required.'
            },
            rate_type: {
                required: 'Rate Type is required.'
            },
            variation: {
                required: 'Variation is required.',
                pattern: 'Only decimal values are allowed.'
            },
            fc_code: {
                required: 'FC Code is required.'
            },
            fc_name: {
                required: 'FC Name is required.'
            },
            code_raf: {
                required: 'Code Raf is required.'
            },
            code_raf_name: {
                required: 'Code Raf Name is required.'
            },
            group_fcy: {
                required: 'Group FCY is required.'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: $(form).attr("action"), // Replace with your endpoint
                method: 'POST',
                data: $(form).serialize(), // Serialize the form data
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = response.route; // Redirect after clicking OK
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        title: "Failed!",
                        text: "An error occurred. Please try again.",
                        icon: "error",
                        timer: 3000, // Closes after 3 seconds
                        showConfirmButton: false
                    });
                }
            });
        }
    });
});

$(document).on('click', '.item-delete', function() { 

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            var table = $('#currency-table').DataTable();
            $.ajax({
                url: $(this).attr("data-url"), // Replace with your endpoint
                type: "GET",
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        table.ajax.reload(null, false);
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        title: "Failed!",
                        text: "An error occurred. Please try again.",
                        icon: "error",
                        timer: 3000, // Closes after 3 seconds
                        showConfirmButton: false
                    });
                },
            });
        }
    });
    
});
