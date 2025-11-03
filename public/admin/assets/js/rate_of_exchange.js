$(document).ready(function () {
    // $("#trans-menu").addClass('active');
    // $("#trans-menu ul li:eq(4)").addClass('active');
});

$(document).on('click', '#get-rates-api', function() { 
    
    $.ajax({
        url: $("#get-rates-api").attr('data-url'), // Replace with your endpoint
        method: 'GET',
        data: {action:'get_rates'}, // Serialize the form data
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
});