<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Please Register Here</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-left"> 
                <div class="logo">
                <img src="assets/images/Circulate Life.png" alt="Criculate life Logo">
                </div>
                <h2 class="h2">Register to your account</h2>
                <form action="member_register.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <input type="text" name="fullname" id="fullname" placeholder="Fullname" onkeypress="return blockNumbers(event)" onblur="capitalizeFirstLetter('fullname')" required>
                    <input type="email" name="email" id="email" placeholder="Email" onkeyup="checkEmail()" required>
                    <span id="emailStatus"></span>
                    <input type="password" id="password" name="password" placeholder="Password (Min 8 chars, 1 uppercase, 1 special char)" required>
                    <div class="become_donor">
                        <input type="checkbox" id="show-parent-info" onclick="toggleParentInfo()">
                        <label for="show-parent-info">Become Donor</label>
                    </div>
                    <div id="parent-info" class="hidden">
                        <div class="inline-fields">
                        <input type="date" id="dob" name="dob" placeholder="Date of Birth(YYYY-MM-DD)"><br>
                        <input type="number" name="age" id="age" placeholder="Age" readonly>
                        </div>
                        <div class="inline-fields">
                            <input type="number" name="body_weight" id="body_weight" placeholder="Body Weight(kg)">
                            <select name="blood_group" id="blood_group">
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <div>
                            <label>Gender:</label>
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                            <input type="radio" id="other" name="gender" value="other">
                            <label for="other">Other</label>
                        </div>
                        <textarea name="address" id="ADDRESS" rows="5" style="resize:none;"
                            placeholder="Full Address"></textarea><br>
                        <input type="number" name="pincode" id="PINCODE" placeholder="Pincode"><br>
                        <input type="number" name="contact" id="CONTACT" placeholder="Contact No."><br><br>
                        <label>Upload your Health Reports:</label><br>
                        <input type="file" name="file_upload" id="file_upload"><br>
                    </div>
                    <input type="hidden" name="usertype" id="usertype" value="recipient" accept=".pdf">
                    <button type="submit">REGISTER</button>
                </form>
                <div class="not-member">
                    <p>Alredy have an account? <a href="login.php">Login now</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="js\script.js?v=<?php echo time(); ?>"></script>
    <script src="js/bootstrap.min.js"></script>
     <script>
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

}</script>
</body>

</html>