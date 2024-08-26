<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>
<!-- CREATE TABLE member (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    usertype ENUM('user', 'admin', 'donor') DEFAULT 'user',
    body_weight DECIMAL(5, 2),
    body_height DECIMAL(5, 2),
    age INT,
    blood_group VARCHAR(10),
    gender ENUM('Male', 'Female', 'Other'),
    dob DATE,
    address TEXT,
    pincode VARCHAR(10),
    contact VARCHAR(15),
    file_upload VARCHAR(255)
); -->



