<?php
// Output a simple message for debugging
echo '<script>';
echo 'console.log("signin page debugging");'; // Output a simple message
echo '</script>';

$is_invalid = false;

// Check if the form has been submitted
if($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include the database connection
    // $mysqli = require "../config/database.php";
    $mysqli = require dirname(__DIR__) . "../../config/database.php";

    // SQL query to check if the username exists in the database
    $sql = sprintf("SELECT * FROM users WHERE username = '%s'",
        $mysqli->real_escape_string($_POST["username"]));

    // Execute the query
    $result = $mysqli->query($sql);
    // Fetch the user details
    $user = $result->fetch_assoc();

    // Verify the password if the user exists
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            // Start a session and set session variables
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["userUsername"] = $user["username"];
            // Redirect the user to the index page
            header("Location: ../../public/index.php");
            exit;
        }
    }
    // Set a flag to indicate invalid login attempt
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include CSS file -->
    <link rel="stylesheet" href="../../public/css/forms.css">
</head>
<body>
    <!-- Signin Form -->
    <div id="signin-popup" class="popup">
        <div class="popup-content">
            <!-- Close button for the popup -->
            <span class="close-btn" onclick="closePopup('signin-popup')">&times;</span>
            <h2>Sign In</h2>

            <!-- Display error message if login is invalid -->
            <?php if($is_invalid): ?>
                <em>Login Invalid</em>
            <?php endif;?>
            <!-- Signin form -->
            <form method="post">
                <!-- Input field for username -->
                <input type="text" name="username" placeholder="username"
                    value="<?=htmlspecialchars($_POST["username"] ?? "") ?>">
                <!-- Input field for password -->
                <input type="password" name="password" placeholder="Password" required>
                <!-- Submit button -->
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
    
    <!-- Include JavaScript file -->
    <script src="../../public/js/assignment_2.js" async defer></script>
</body>
</html>
