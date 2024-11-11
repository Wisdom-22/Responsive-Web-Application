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

// Include the header view for the HTML structure
include '../app/views/header.php';

?>

<!-- HTML structure for the dashboard page -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Dashboard</h1>
            <!-- Link to the Users Management page -->
            <a href="users.php">Users management</a>
        </div>
    </div>
</div>

<?php
// Include the footer view for the HTML structure
include('../app/views/footer.php');
?>
