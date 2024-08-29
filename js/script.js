// validation for Email Address ......................
function validateForm() {
    var email = document.getElementById('email').value;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    var password = document.getElementById('password').value;
    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    var bodyWeight = document.getElementById('body_weight').value;
    var age = document.getElementById('age').value;
    var contact = document.getElementById('CONTACT').value;
    var pincode = document.getElementById('PINCODE').value;

    if (bodyWeight && bodyWeight < 50) {
        alert("Body weight must be 50 kg or more.");
        return false;
    }

    if (age && age < 18) {
        alert("Age must be 18 years or older.");
        return false;
    }

    if (pincode && (pincode.length !== 6 || isNaN(pincode))) {
        alert("Please enter a valid 6-digit Pincode.");
        return false;
    }

    if (contact && (contact.length !== 10 || isNaN(contact))) {
        alert("Please enter a valid Contact number.");
        return false;
    }

    return true;
}


// be come doner ..................
// Function to toggle the visibility of the parent information section
$('#show-parent-info').change(function () {
    if (this.checked) {
        $('#parent-info').show();
        $('#login-right').hide();
        $('#login-left').addClass('centered');
    } else {
        $('#parent-info').hide();
        $('#login-right').show();
        $('#login-left').removeClass('centered');
    }
});

// jQuery code to initialize the datepicker for the DOB field

$(document).ready(function () {
    // Initialize Datepicker for #dob
    $("#dob").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
    });

    // Initialize Datepicker for #wr
    $("#wr").datepicker({
        dateFormat: "dd-mm-yy", // Format of the date
        minDate: 0 // Restrict to select dates from today onwards
    });
});


// slide bar toggle

function toggleSidebar() {
    var sidebar = document.getElementById('sidebar-nav');
    var main = document.querySelector('.main');
    if (sidebar.classList.contains('sidebar-hidden')) {
        sidebar.classList.remove('sidebar-hidden');
        main.classList.remove('main-collapsed');
        main.classList.add('main-expanded');
    } else {
        sidebar.classList.add('sidebar-hidden');
        main.classList.remove('main-expanded');
        main.classList.add('main-collapsed');
    }
}