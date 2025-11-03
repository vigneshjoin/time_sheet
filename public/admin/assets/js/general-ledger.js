$(document).ready(function () {
    $("#master-menu").addClass('active');
    $("#master-menu ul li:first").addClass('active');


    $("#general-ledger").validate({
        rules: {
            classification: {
                required: true
            },
            account_code:{
                required:true
                // validCustomPattern: true
            },
            type: {
                required: true
            },
            account: {
                required: true,
                minlength: 1,
                digits: true // Only allows numbers
            },
            sub_class: {
                required: true
            },
            title: {
                required: true,
                minlength: 1
            },
            persian_title: {
                // required: true,
                minlength: 1
            },
            full_name: {
                // required: true,
                minlength: 1
            },
            // cb_group: {
            //     required: true
            // },
            // defaultfcy: {
            //     required: true
            // },
            comment: {
                // required: true,
                minlength: 1
            }
        },
        messages: {
            classification: {
                required: "Classification is required."
            },

            account_code: {
                required: "Account code is required."
                // evenDigitsOnly: "Invalid Account Code."
            },

            type: {
                required: "Type is required."
            },
            status: {
                required: "Account status is required."
            },
            account: {
                required: "Account is required.",
                minlength: "Account must be at least 1 character.",
                digits: "Account must be a number."
            },
            sub_class: {
                required: "Sub Class is required."
            },
            title: {
                required: "Title is required.",
                minlength: "Title must be at least 1 character."
            },
            persian_title: {
                required: "Persian Title is required.",
                minlength: "Persian Title must be at least 1 character."
            },
            full_name: {
                required: "Full Name is required.",
                minlength: "Full Name must be at least 1 character."
            },
            cb_group: {
                required: "CB Group is required."
            },
            defaultfcy: {
                required: "Default FCy is required."
            },
            comment: {
                required: "Comments are required.",
                minlength: "Comments must be at least 1 character."
            }
        },
        submitHandler: function(form) {
            // form.submit(); // If valid, submit form
            $.ajax({
                url: $('#general-ledger').attr("action"), // Replace with your endpoint
                method: 'POST',
                data: $('#general-ledger').serialize(), // Serialize the form data
                success: function (response) {

                    if(response.status == 'success'){

                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = response.route; // Redirect after clicking OK
                        });

                    }else{
                        Swal.fire({
                            title: "Failed!",
                            text: response.message,
                            icon: "error",
                            timer: 3000, // Closes after 3 seconds
                            showConfirmButton: false
                        });
                    }
                    
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
            var table = $('#generalledger-table').DataTable();
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



$(document).on('change', '#sub_class', function() { 
    if( $(this).val() == 8){
        $(".bank-section").show();
        $('.select2').select2();
    }else{
        $(".bank-section").hide();
    }
});

$(document).on('change keyup', 'input[name=account_code]', function() { 

    // var frmValidation = $("#general-ledger").valid();

    // console.info(frmValidation);
    // return ;

    $("#sub_class").val($(this).val().charAt(0));
    $(".classification_box").val($(this).val().charAt(0));

    $(this).removeClass('error');
    // $("#parent_id_check_status").val('1');
    var endPoint = $("#home_url").val() + '/general-ledger/checkParentId'; // Replace with your endpoint
    var methord = 'GET';
    var data = {
        account_code: $(this).val(),
        action : 'check_account_code'
    };
    
    // var frmValidation = $("#general-ledger").valid();

    // console.info(frmValidation);
    // if(!frmValidation)
    //     return false;
    // else{
        $("#create-btn").prop("disabled",true);
        $.ajax({
            url: endPoint, // Replace with your endpoint
            type: methord,
            data: data,
            dataType: "json",
            success: function (result) {
                // console.info('result*****', result.status	);
                if(result.ledger == 0){
                    $("#account_code-error").hide();
                    $("#account_code-error").html('');
                    $(this).addClass('error');
                    $("#create-btn").prop("disabled", false);

                }else{
                    $("#create-btn").prop("disabled", true);
                    $("#account_code-error").show();
                    $("#account_code-error").html(result.message);
                    // Swal.fire({
                    //     title: "Warning",
                    //     text: result.message,
                    //     icon: "error",
                    //     timer: 3000, // Closes after 3 seconds
                    //     showConfirmButton: false
                    // });
                }
            },
            error: function (xhr) {
                console.debug('ERROR', xhr);
                // return xhr;               
            },
        });
    // }
        
});


