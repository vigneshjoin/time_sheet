$(document).ready(function () {

    $("#master-menu").addClass('active');
    $(".party-ledger").addClass('active');
    $(".party-ledger ul li:eq(1)").addClass('active');


    $('#contact-party-ledger').validate({
        rules: {
            company_name: {
                required: true,
                minlength: 2,
                maxlength: 100
            },
            address: {
                required: true
            },
            tel_1: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            tel_2: {
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            fax: {
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            email: {
                required: true,
                email: true
            },
            contact_no: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            designation: {
                required: true
            },
            nationality: {
                required: true
            },
            entity: {
                required: true
            },
            vat_trn: {
                required: true
            },
            id_type: {
                required: true
            },
            id_no: {
                required: true
            },
            issue_date: {
                required: true,
                date: true
            },
            issue_expiry: {
                required: true,
                date: true
            },
            issue_place: {
                required: true
            },
            pdf_pwd: {
                required: true
            }
        },
        messages: {
            company_name: {
                required: 'Company Name is required.',
                minlength: 'Company Name must be at least 2 characters.',
                maxlength: 'Company Name must not exceed 100 characters.'
            },
            address: {
                required: 'Address is required.'
            },
            tel_1: {
                required: 'Telephone 1 is required.',
                digits: 'Please enter a valid telephone number.',
                minlength: 'Telephone number must be at least 10 digits.',
                maxlength: 'Telephone number must not exceed 15 digits.'
            },
            tel_2: {
                digits: 'Please enter a valid telephone number.',
                minlength: 'Telephone number must be at least 10 digits.',
                maxlength: 'Telephone number must not exceed 15 digits.'
            },
            fax: {
                digits: 'Please enter a valid fax number.',
                minlength: 'Fax number must be at least 10 digits.',
                maxlength: 'Fax number must not exceed 15 digits.'
            },
            mobile: {
                required: 'Mobile is required.',
                digits: 'Please enter a valid mobile number.',
                minlength: 'Mobile number must be at least 10 digits.',
                maxlength: 'Mobile number must not exceed 15 digits.'
            },
            email: {
                required: 'Email is required.',
                email: 'Please enter a valid email address.'
            },
            contact_no: {
                required: 'Contact Number is required.',
                digits: 'Please enter a valid contact number.',
                minlength: 'Contact number must be at least 10 digits.',
                maxlength: 'Contact number must not exceed 15 digits.'
            },
            designation: {
                required: 'Designation is required.'
            },
            nationality: {
                required: 'Nationality is required.'
            },
            entity: {
                required: 'Entity is required.'
            },
            vat_trn: {
                required: 'VAT TRN is required.'
            },
            id_type: {
                required: 'ID Type is required.'
            },
            id_no: {
                required: 'ID Number is required.'
            },
            issue_date: {
                required: 'Issue Date is required.',
                date: 'Please enter a valid date.'
            },
            issue_expiry: {
                required: 'Issue Expiry Date is required.',
                date: 'Please enter a valid date.'
            },
            issue_place: {
                required: 'Issue Place is required.'
            },
            pdf_pwd: {
                required: 'PDF Password is required.'
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
            var table = $('#contact').DataTable();
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
