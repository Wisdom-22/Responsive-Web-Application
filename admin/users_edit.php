<?php

// Start the session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the necessary files
include '../config/database.php';
include 'message_function.php';

// Secure the page to ensure only logged-in users can access it
secure();

// If the form has been submitted with a username
if (isset($_POST['username'])) {

    // Prepare an SQL statement to update the user information except password
    if ($stm = $connect->prepare('UPDATE users SET username = ?, email = ?, user_tier = ? WHERE id = ?')) {
        // Bind parameters to the SQL query
        $stm->bind_param('sssi', $_POST['username'], $_POST['email'], $_POST['user_tier'], $_GET['id']);
        // Execute the SQL query
        $stm->execute();
        // Close the statement
        $stm->close();

        // If the form has been submitted with a password
        if (isset($_POST['password']) && !empty($_POST['password'])) {
            // Prepare an SQL statement to update the user password
            if ($stm = $connect->prepare('UPDATE users SET password_hash = ? WHERE id = ?')) {
                // Hash the password
                $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                // Bind parameters to the SQL query
                $stm->bind_param('si', $password_hash, $_GET['id']);
                // Execute the SQL query
                $stm->execute();
                // Close the statement
                $stm->close();
            } else {
                // Error message if the password update statement couldn't be prepared
                echo 'Could not prepare password update statement!';
            }
        }

        // Set a success message and redirect to the users page
        set_message("User " . $_GET['id'] . " has been updated");
        header('Location: users.php');
        die();
    } else {
        // Error message if the user update statement couldn't be prepared
        echo 'Could not prepare user update statement!';
    }
}

// If a user ID is set in the URL
if (isset($_GET['id'])) {

    // Prepare an SQL statement to select the user details
    if ($stm = $connect->prepare('SELECT u.*, t.*, c.*
                                    FROM users u
                                    JOIN tier t ON u.user_tier = t.tier_id
                                    LEFT JOIN tier_class tc ON t.tier_id = tc.tier_id
                                    LEFT JOIN class c ON tc.class_id = c.class_id WHERE u.id = ?')) {
        // Bind the user ID parameter to the SQL query
        $stm->bind_param('i', $_GET['id']);
        // Execute the SQL query
        $stm->execute();
        // Get the result
        $result = $stm->get_result();
        // Fetch the user details
        $user = $result->fetch_assoc();

        // If user details are found, display the form pre-filled with the user details
        if ($user) {
            ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1 class="display-1">Edit user</h1>

                        <form method="post">
                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="username" name="username" class="form-control active"
                                    value="<?php echo htmlspecialchars($user['username']); ?>" />
                                <label class="form-label" for="username">Username</label>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control active"
                                    value="<?php echo htmlspecialchars($user['email']); ?>" />
                                <label class="form-label" for="email">Email address</label>
                            </div>

                            <!-- Password input (optional) -->
                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" />
                                <label class="form-label" for="password">Password (leave blank to keep current password)</label>
                            </div>

                            <!-- User tier select -->
                            <div class="form-outline mb-4">
                                <select name="user_tier" class="form-select" id="user_tier">
                                    <option value="1" <?php echo ($user['user_tier'] == 1) ? "selected" : ""; ?>>Free</option>
                                    <option value="2" <?php echo ($user['user_tier'] == 2) ? "selected" : ""; ?>>Beginner</option>
                                    <option value="3" <?php echo ($user['user_tier'] == 3) ? "selected" : ""; ?>>Intermediate</option>
                                    <option value="4" <?php echo ($user['user_tier'] == 4) ? "selected" : ""; ?>>Advanced</option>
                                </select>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block">Update user</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        // Close the statement
        $stm->close();
    } else {
        // Error message if the select user statement couldn't be prepared
        echo 'Could not prepare statement for editing!';
    }
} else {
    // Error message if no user ID is provided in the URL
    echo "No user selected";
    die();
}

// Include the footer
include('../app/views/footer.php');
?>
