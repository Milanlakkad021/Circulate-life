<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Please Register Here</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>
    <div class="login-container">
        <div class="request-box">
            <div class="login-left" id="login-left">
                <div class="logo">
                    <img src="../assets\images\img\Logo1.jpg" alt="Circulate Life Logo">
                </div>
                <h2>Request For Blood</h2>
                <form action="blood_request_data.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="name" id="name" placeholder="Patient Name" required>
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
                    <input type="text" name="reson" id="reson" placeholder="Reason For Blood" required>
                    <input type="text" id="wr" name="wr" placeholder="When Required" required>
                    <input type="number" name="unit" id="unit" placeholder="Unit of Blood" required>
                    <input type="text" name="hname" id="hname" placeholder="Hospital Name" required>
                    <input type="text" name="dname" id="dname" placeholder="Doctor Name" required>
                    <div>
                        <label>Gender:</label>
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Female</label>
                        <input type="radio" id="other" name="gender" value="other">
                        <label for="other">Other</label>
                    </div>
                    <textarea name="address" id="ADDRESS" rows="5" style="resize:none;" placeholder="Full Address"></textarea><br>
                    <div class="inline-fields">
                        <input type="number" name="pincode" id="PINCODE" placeholder="Pincode">
                        <input type="number" name="contact" id="CONTACT" placeholder="Contact No.">
                    </div>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <label>Upload Health Reports:</label><br>
                    <input type="file" name="file_upload" id="file_upload"><br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="js/script.js?v=<?php echo time(); ?>"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<!-- CREATE TABLE blood_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    user_type ENUM('admin', 'donor', 'recipient') NOT NULL,
    name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    blood_group VARCHAR(10) NOT NULL,
    reason_for_blood TEXT NOT NULL,
    when_required DATE NOT NULL,
    unit INT NOT NULL,
    hospital_name VARCHAR(255) NOT NULL,
    doctor_name VARCHAR(255) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    address TEXT NOT NULL,
    pincode VARCHAR(10) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    file_upload VARCHAR(255),
    status ENUM('Pending', 'Accept', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES admin(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (user_id) REFERENCES donor(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (user_id) REFERENCES recipient(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB; -->
