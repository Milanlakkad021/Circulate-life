# Circulate Life – Blood Bank Management System

## 📌 Overview

Circulate Life is a web-based application designed to manage blood bank operations efficiently. It provides features for user registration, login, email/username verification, and password recovery.

---

## 🗂️ Project Structure

| File                  | Description                                         |
| --------------------- | --------------------------------------------------- |
| `connection.php`      | Database connection script                          |
| `check_email.php`     | Validates email availability during registration    |
| `check_username.php`  | Validates username availability during registration |
| `forgot_password.php` | Handles password recovery process                   |

---

## ⚙️ Requirements

* **PHP**: 7.4 or higher
* **MySQL/MariaDB**: For storing user data and blood bank records
* **Web Server**: Apache or Nginx with PHP support

---

## 🚀 Installation & Setup

1. **Clone or Extract** the project files to your web server’s root directory.
2. **Create a Database** in MySQL (e.g., `circulate_life`).
3. **Import Database Schema** (if provided) into your database.
4. Open `connection.php` and configure your database credentials:

-> php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "circulate_life";
   ```
5. Start your local server (XAMPP).
6. Access the application in your browser:

   http://localhost/Circulate%20life/

---

💡 Functionality
1. Authentication & User Management
		Registration: Users can sign up by providing their details, email, and password.
		Login: Secure login with session handling.
		Email/Username Validation: Real-time checks prevent duplicate accounts.
		Forgot Password: Users can reset their password through email verification.

2.Donor & Recipient Management

		Add, edit, and remove blood donors with information such as name, blood group, contact, and last donation date.

		Maintain recipient records including requests and fulfilled donations.

3.Blood Inventory Tracking

		Monitor available blood units by type (A+, O-, etc.).
		Update stock after donation or transfusion.

4.Administrative Dashboard

		View key statistics (total donors, stock levels, pending requests).
		Manage users and blood bank records.

5.Additional Modules (optional / to verify)

		Appointment scheduling for donation.
		SMS/Email alerts for urgent requirements.
		Report generation for stock and donor activity.

---

## 🔐 Password 

 Admin
 Username = milanlakkad021@gmail.com
 Passord = Admin@123

 Donor
 Username = milanlakkadstdy@gmail.com
 Passord = Donor@123

 Recipient
 
 Username = milanlakkad025@gmail.com
 Passord = User@123
 
---

🌟 Features (Planned/Implemented)

User registration and login ✅

Forgot password / reset functionality ✅

Real-time email and username availability ✅

Donor and recipient management 🔄

Blood inventory management 🔄

Reporting and analytics (future enhancement) 📝


## 👥 Author

**Milan Lakkad**
Master of Computer Applications (MCA), R.B. Institute of Management Studies
