$(document).ready(function () {
    
    var url = window.location.href; // Get full URL
    var segments = url.split("/"); // Split by "/"
    var MenuSlug = segments.pop() || segments.pop(); // Get last non-empty part
    var MainMenuSlug = segments[segments.length -1]; 


    if(MainMenuSlug == "transactions"){
        $("#master-menu ul").hide();
        $("#trans-menu").addClass('active');

        switch (MenuSlug) {
            case "journal-entry":
                $("#trans-menu ul li:eq(0)").addClass('active');
                break;
            case "receipt-payments":
                $("#trans-menu ul li:eq(1)").addClass('active');
                break;
            case "account-to-account-entry":
                $("#trans-menu ul li:eq(2)").addClass('active');
                break;
            case "bank-transactions":   
                $("#trans-menu ul li:eq(3)").addClass('active');
                break;
            case "suspense-voucher":
                $("#trans-menu ul li:eq(4)").addClass('active');
                break;
            case "remittance":
                $("#trans-menu ul li:eq(5)").addClass('active');
                break;
            case "rate-of-exchange":
                $("#trans-menu ul li:eq(6)").addClass('active');
                break;
            default:
                console.log("Unknown menu item");
        }
    }
    
});