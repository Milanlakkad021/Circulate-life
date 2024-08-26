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
            <div class="login-left" id="login-left">
                <div class="logo">
                    <img src="assets\images\img\Logo1.jpg" alt="Circulate Life Logo">
                </div>
                <h2>Register to your account</h2>
                <form action="member_register.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <input type="text" name="fullname" id="fullname" placeholder="Fullname" required>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="text" name="username" id="username" placeholder="Username" required>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <div class="become_donor">
                        <input type="checkbox" id="show-parent-info" onclick="toggleParentInfo()">
                        <label for="show-parent-info">Become Donor</label>
                    </div>
                    <div id="parent-info" class="hidden">
                        <div class="inline-fields">
                            <input type="number" name="body_weight" id="body_weight" placeholder="Body Weight(kg)">
                            <input type="number" name="body_height" id="body_height" placeholder="Body Height(ft)">
                        </div>
                        <div class="inline-fields">
                            <input type="number" name="age" id="age" placeholder="Age">
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
                        <input type="text" id="dob" name="dob" placeholder="Date of Birth(YYYY-MM-DD)"><br>
                        <textarea name="address" id="ADDRESS" rows="5" style="resize:none;"
                            placeholder="Full Address"></textarea><br>
                        <input type="number" name="pincode" id="PINCODE" placeholder="Pincode"><br>
                        <input type="number" name="contact" id="CONTACT" placeholder="Contact No."><br><br>
                        <label>Upload your Health Reports:</label><br>
                        <input type="file" name="file_upload" id="file_upload"><br>
                    </div>
                    <input type="hidden" name="usertype" id="usertype" value="recipient">
                    <button type="submit">REGISTER</button>
                </form>
                <div class="not-member">
                    <a href="login.php">A Member?</a>
                </div>
            </div>
            <div class="login-right" id="login-right">
                <h1>Welcome To Circulate Life</h1>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="js\script.js?v=<?php echo time(); ?>"></script>
    <script src="js/bootstrap.min.js"></script>
 <script>
    // const checkbox = document.getElementById('show-parent-info');

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
    //  if(checkbox.checked){
    //      console.log('usertype:donor');
    //  }else{
    //      console.log('usertype:recipient');
    //  }
}</script>
</body>

</html>