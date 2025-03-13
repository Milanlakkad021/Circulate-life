// validation for Email Address ......................
function validateForm() {
    var email = document.getElementById('email').value;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    var password = document.getElementById('password').value;
    var uppercasePattern = /[A-Z]/;
    var specialCharPattern = /[!@#$%^&*]/;

    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    if (!uppercasePattern.test(password)) {
        alert("Password must contain at least one uppercase letter.");
        return false;
    }

    if (!specialCharPattern.test(password)) {
        alert("Password must contain at least one special character.");
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

// validetion for Full name 
function blockNumbers(event) {
    var charCode = event.which || event.keyCode;
    // Allow only letters (A-Z, a-z) and space (char code 32)
    if ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode === 32) {
        return true;
    } else {
        return false; // Block number and other characters
    }
}

// capitalization for first letter start
function capitalizeFirstLetter(id) {
    var inputField = document.getElementById(id);
    var value = inputField.value.trim();
    if (value) {
        // Capitalize the first letter and make the rest lowercase
        inputField.value = value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();
    }
}

// Call this function for each input field where you want this behavior
function applyCapitalization() {
    capitalizeFirstLetter('fullname');
    capitalizeFirstLetter('hname');
    capitalizeFirstLetter('dname');
    capitalizeFirstLetter('name');
}
// capitalization for first letter end

function limitInputLength(id, maxLength) {
    var inputField = document.getElementById(id);
    var value = inputField.value;

     // Ensure only the specified max number of digits can be entered
     if (inputField.value.length > maxLength) {
        inputField.value = inputField.value.slice(0, maxLength);  // Trim to the specified maxLength
    }

    // Ensure the value is a positive number if a minimum is specified
    if (parseInt(inputField.value) < minValue) {
        inputField.value = "";  // Clear the input if it's not valid
    }
}

function limitInputLengthAndPositive(id, maxLength) {
    var inputField = document.getElementById(id);
    var value = inputField.value;

    // Ensure only the specified max number of digits can be entered
    if (value.length > maxLength) {
        inputField.value = value.slice(0, maxLength);  // Trim to the specified maxLength
    }

    // Ensure the value is positive and at least 1
    if (value < 1) {
        inputField.value = "";  // Clear the input if it's not valid
    }
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

function checkEmail() {
    const email = document.getElementById('email').value;
    const emailStatus = document.getElementById('emailStatus');
    
    // Simple email format validation (optional)
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        emailStatus.innerHTML = '<span style="color: red; display: block; margin-bottom: 20px; text-align: center;">Please enter a valid email address.</span>';
        return;
    }

    fetch(`check_email.php?email=${email}`)
        .then(response => response.text())
        .then(data => {
            if (data === 'available') {
                emailStatus.innerHTML = '<span style="color: green; display: block; margin-bottom: 20px; text-align: center;">Email is available!</span>';
            } else if (data === 'taken') {
                emailStatus.innerHTML = '<span style="color: red; display: block; margin-bottom: 20px; text-align: center;">Email is already in use!</span>';
            } else {
                emailStatus.innerHTML = '<span style="color: orange; display: block; margin-bottom: 20px; text-align: center;">Error checking email.</span>';
            }
        });
}


// function checkUsername() {
//     const username = document.getElementById('username').value;
//     const usernameStatus = document.getElementById('usernameStatus');

//     if (username.length >= 5) {
//         fetch(`check_username.php?username=${username}`)
//             .then(response => response.text())
//             .then(data => {
//                 if (data === 'available') {
//                     usernameStatus.innerHTML = '<span style="color: green;  display: block; margin-bottom: 20px; text-align: center;">Username is available!</span>';
//                 } else if (data === 'taken') {
//                     usernameStatus.innerHTML = '<span style="color: red; display: block; margin-bottom: 20px; text-align: center;">Username is already in use!</span>';
//                 } else {
//                     usernameStatus.innerHTML = '<span style="color: orange;  display: block; margin-bottom: 20px; text-align: center;">Error checking username.</span>';
//                 }
//             });
//     } else {
//         usernameStatus.innerHTML = '<span style="color: red;  display: block; margin-bottom: 20px; text-align: center;">Username must be at least 5 characters.</span>';
//     }
// }


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
        dateFormat: 'yy-mm-dd',
        yearRange: "-100:-18", // Allows selection of birth dates up to 100 years ago
        maxDate: "-18Y", // Restricts date selection to 18+ years old
        onSelect: function() {
            calculateAge();
        }
    });
    // Initialize Datepicker for #wr
    $("#wr").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd", // Format of the date
        minDate: 0 // Restrict to select dates from today onwards
    });
});

function calculateAge() {
    let dob = $("#dob").val();
    if (dob) {
        let dobDate = new Date(dob);
        let today = new Date();
        let age = today.getFullYear() - dobDate.getFullYear();
        let monthDiff = today.getMonth() - dobDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
            age--;
        }

        $("#age").val(age);
    }
}




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
