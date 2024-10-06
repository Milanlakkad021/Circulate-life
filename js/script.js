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
//  Change usertype autometicaly
function toggleParentInfo() {
    var parentInfo = document.getElementById("parent-info");
    var userType = document.getElementById("usertype");
    if (parentInfo.classList.contains("hidden")) {
        parentInfo.classList.remove("hidden");
        userType.value = "donor";
    } else {
        parentInfo.classList.add("hidden");
        userType.value = "recipient";
    }

}

//  Check username availability check
function checkUsername() {
    const username = document.getElementById('username').value;
    const usernameStatus = document.getElementById('usernameStatus');

    if (username.length >= 5) {
        fetch(`check_username.php?username=${username}`)
            .then(response => response.text())
            .then(data => {
                if (data === 'available') {
                    usernameStatus.innerHTML = '<span style="color: green;  display: block; margin-bottom: 20px; text-align: center;">Username is available!</span>';
                } else if (data === 'taken') {
                    usernameStatus.innerHTML = '<span style="color: red; display: block; margin-bottom: 20px; text-align: center;">Username is already taken!</span>';
                } else {
                    usernameStatus.innerHTML = '<span style="color: orange;  display: block; margin-bottom: 20px; text-align: center;">Error checking username.</span>';
                }
            });
    } else {
        usernameStatus.innerHTML = '<span style="color: red;  display: block; margin-bottom: 20px; text-align: center;">Username must be at least 5 characters.</span>';
    }
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
        dateFormat: 'yy-mm-dd'
    });

    // Initialize Datepicker for #wr
    $("#wr").datepicker({
        dateFormat: "yy-mm-dd", // Format of the date
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