<?php

// Include the database configuration
$mysqli = require '../../config/database.php';

// Check if the email parameter is set in the GET request
if (isset($_GET["email"])) {
    // Prepare an SQL statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    // Bind the email parameter to the SQL statement
    $stmt->bind_param("s", $_GET["email"]);
    // Execute the SQL statement
    $stmt->execute();
    // Get the result of the query
    $result = $stmt->get_result();

    // Check if the email is available (i.e., not found in the database)
    $is_available = $result->num_rows === 0;

    // Set the response header to return JSON
    header("Content-Type: application/json");

    // Return the availability status as a JSON response
    echo json_encode(["available" => $is_available]);

    // Close the statement
    $stmt->close();
} else {
    // If the email parameter is not set, return an error message
    header("Content-Type: application/json");
    echo json_encode(["error" => "Email parameter is required"]);
}

// Close the database connection
$mysqli->close();
?>
