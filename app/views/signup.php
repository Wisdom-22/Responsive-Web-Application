<?php
// Check if first name is provided
if (empty($_POST["f_name"])) {
    die("Firstname is required");
}

// Check if last name is provided
if (empty($_POST["l_name"])) {
    die("Lastname is required");
}

// Check if username is provided
if (empty($_POST["username"])) {
    die("Username is required");
}

// Validate email format
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address");
}

// Validate password length
if (strlen(trim($_POST["password"])) < 8) {
    die("Password must be greater than 8 characters");
}

// Validate if password contains at least one alphabet
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one alphabet");
}

// Validate if password contains at least one number
if (!preg_match("/[0-9]/i", $_POST["password"])) {
    die("Password must contain at least one number");
}

// Validate password confirmation
if ($_POST["password"] !== $_POST["confirm_password"]) {
    die("Passwords must match");
}

// Establish database connection
$mysqli = require "../../config/database.php";

// SQL query to insert user data into the database
$sql = "INSERT INTO users (f_name, l_name, username, email, password_hash) VALUES (?, ?, ?, ?, ?)";

// Initialize prepared statement
$stmt = $mysqli->stmt_init();

// Check if the prepared statement is successfully initialized
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

// Hash the password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Bind parameters to the prepared statement
$stmt->bind_param("sssss", 
                    $_POST["f_name"],
                    $_POST["l_name"],
                    $_POST["username"],
                    $_POST["email"],
                    $password_hash);

// Execute the prepared statement
if ($stmt->execute()) {
    // Redirect to signup success page
    header("Location: signup_success.php");
    exit;
} else {
    // Handle errors
    if ($mysqli->errno === 1062) {
        die("Account with the provided email already exists !");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
?>
