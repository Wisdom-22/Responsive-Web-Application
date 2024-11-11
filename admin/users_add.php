<?php

// Start the session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration and functions
include '../config/database.php';
include 'message_function.php';

// Ensure the user is authenticated and authorized
secure();

// Include the header file for the HTML structure
include '../app/views/header.php';

// Handle form submission for adding a new user
if (isset($_POST['username'])) {

    // SQL query to insert a new user into the 'users' table
    $ad_sql = "INSERT INTO users (f_name, l_name, username, email, password_hash, active) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->stmt_init();

    // Hash the password for secure storage
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare the SQL statement
    if ($stmt->prepare($ad_sql)) {
       
        // Bind the parameters to the SQL query
        $stmt->bind_param('ssssss',
                        $_POST['f_name'],
                        $_POST['l_name'],
                        $_POST['username'],
                        $_POST['email'],
                        $password_hash,
                        $_POST['active']);
       
        // Execute the query
        $stmt->execute();
        
        // Set a success message and redirect to the users page
        set_message("A new user " . $_POST['username'] . " has been added");
        header('Location: users.php');
        exit;

    } else {
        // Output an error message if the statement could not be prepared
        echo 'Could not prepare statement for add user!';
    }
}
?>

<!-- HTML form for adding a new user -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Add user</h1>
       
            <!-- Form for user details -->
            <form method="post">
                <!-- First Name input -->
                <div class="form-outline mb-4">
                    <input type="text" id="f_name" name="f_name" class="form-control" />
                    <label class="form-label" for="f_name">First Name</label>
                </div>

                <!-- Last Name input -->
                <div class="form-outline mb-4">
                    <input type="text" id="l_name" name="l_name" class="form-control" />
                    <label class="form-label" for="l_name">Last Name</label>
                </div>

                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" />
                    <label class="form-label" for="username">Username</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password"  name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- Active select -->
                <div class="form-outline mb-4">
                    <select name="active" class="form-select" id="active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Add user</button>
            </form>
        </div>
    </div>
</div>

<?php
// Include the footer file for the HTML structure
include('../app/views/footer.php');
?>
