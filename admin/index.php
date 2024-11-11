<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize variables for invalid login
$is_invalid = false;
$invalid_user_message = "";

// Check if the request method is POST (form submission)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include database configuration file
    $mysqli = require dirname(__DIR__) . "/config/database.php";

    // Get the email from the POST request
    $email = $_POST["email"];

    // Check if the email is the admin email
    if ($email === 'admin@email.com') {
        // Prepare the SQL statement to fetch the user by email
        $em_sql = sprintf("SELECT * FROM users WHERE email = '%s'",
                $mysqli->real_escape_string($email));
        $em_result = $mysqli->query($em_sql);
        $record = $em_result->fetch_assoc();

        // Check if the user record is found
        if ($record) {
            // Verify the password
            if (password_verify($_POST["password"], $record["password_hash"])) {
                // Regenerate session ID for security
                session_start();
                session_regenerate_id();
                // Store user details in session
                $_SESSION["user_id"] = $record["id"];
                $_SESSION["userEmail"] = $record["email"];
                $_SESSION["userRole"] = 'admin'; // Set the user role to admin
                // Redirect to the dashboard
                header("Location: ./dashboard.php");
                exit;
            } else {
                // Invalid password
                $is_invalid = true;
                $invalid_user_message = "Invalid password.";
            }
        } else {
            // No user found with the provided email
            $is_invalid = true;
            $invalid_user_message = "No user found with this email.";
        }
    } else {
        // Access restricted to admin only
        $is_invalid = true;
        $invalid_user_message = "Access restricted to admin only.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/forms.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <h2>Sign Into Admin Portal</h2><br>
        <div class="col-md-6">
            <!-- Admin login form -->
            <form method="post">
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"/>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal for error messages -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= htmlspecialchars($invalid_user_message) ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Include the footer view -->
<?php
include('../app/views/footer.php');
?>

<!-- Show the error modal if there's an invalid login -->
<?php if ($is_invalid): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#errorModal').modal('show');
    });
</script>
<?php endif; ?>

<!-- Include necessary scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="../../public/js/assignment_2.js" async defer></script>
</body>
</html>
