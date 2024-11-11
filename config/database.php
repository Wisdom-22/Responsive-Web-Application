<?php
// Database connection parameters
$host = "localhost"; // Database host
$dbname = "assignment_2"; // Database name
$username = "assignment_user"; // Database username
$password = "second_assignment"; // Database password

// Create a new MySQLi object for database connection
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check if there is a connection error
if ($mysqli->connect_errno) {
    // If there is a connection error, terminate the script and display the error message
    die("Connection error: " . $mysqli->connect_error);
}

// Alternative method for admin database connection using MySQLi procedural style
// This is not used in the script, but provided for reference
$connect = mysqli_connect('localhost', 'assignment_user', 'second_assignment','assignment_2');

// Return the $mysqli object for further use in other scripts
return $mysqli;
?>
