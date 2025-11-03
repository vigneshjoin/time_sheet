$(document).ready(function () {
    $("#master-menu").addClass('active');
    $("#master-menu ul li:eq(2)").addClass('active');
   
    // Initialize jQuery Validator
    $('#walk-in-customers').validate({
        rules: {
            customer_name: {
                required: true,
                minlength: 1
            },
            employer: {
                required: false,
                minlength: 1
            },
            // natinality:{
            //     required: true,
            // },
            id_issue_date:{
                required: true
            },
            // country :{
            //     required: true
            // },
            email:{
                required: false,
                email: true 
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 7,
                maxlength: 15
            },
            // tel: {
            //     required: true,
            //     digits: true,
            //     minlength: 7,
            //     maxlength: 10
            // },
            // personal_no: {
            //     required: true,
            //     digits: true,
            //     minlength: 7,
            //     maxlength: 10
            // },
            id_type: {
                required: true
            },
            id_no: {
                required: true
            },
            id_validity: {
                required: true
            },
            // country: {
            //     required: true
            // },
            // state: {
            //     required: true
            // },
            account: {
                required: true,
                minlength: 1,
                // digits:true
            }
        },
        messages: {
            email:{
                required: 'Email is required.',
                email: 'Email is invalid.', 
            },
            natinality:{
                required: 'Natinality is required.',
            },
            customer_name: {
                required: 'Customer Name is required.'
            },
            employer: {
                required: 'Employer is required.'
            },
            mobile: {
                required: 'Mobile is required.',
                digits: 'Mobile is invalid.'
            },
            tel: {
                required: 'Telephone is required.',
                digits: 'Mobile is invalid.'
            },
            personal_no: {
                required: 'Personal Number is required.',
                digits: 'Mobile is invalid.'                
            },
            id_type: {
                required: 'ID Type is required.'
            },
            id_no: {
                required: 'ID Number is required.'
            },
            id_validity: {
                required: 'ID Validity is required.'
            },
            country: {
                required: 'Country is required.'
            },
            state: {
                required: 'State is required.'
            },
            account: {
                required: 'Account is required.',
                digits  : 'Account is invalid.'
            },
            id_issue_date:{
                required: 'ID Issue Date is required.'
            }
        },
        submitHandler: function (form) {
            // Submit the form via AJAX if no errors
            console.info('ajax triggered...');
            
            $.ajax({
                url: $('#walk-in-customers').attr("action"), // Replace with your endpoint
                method: 'POST',
                data: $('#walk-in-customers').serialize(), // Serialize the form data
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
                },
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
            var table = $('#walk-in-customer-table').DataTable();
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