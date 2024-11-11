<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    
    // Include the database connection
    $mysqli = require __DIR__ . '/../../config/database.php';

    // Fetch user details from the database
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    // Fetch user tier and associated classes
    $tierSql = "SELECT u.*, t.*, c.*
                FROM users u
                JOIN tier t ON u.user_tier = t.tier_id
                LEFT JOIN tier_class tc ON t.tier_id = tc.tier_id
                LEFT JOIN class c ON tc.class_id = c.class_id
                WHERE u.id = {$_SESSION["user_id"]}";
    $userTierResult = $mysqli->query($tierSql);
    $userTier = $userTierResult->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include CSS file -->
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<?php
    // Include the header
    include "header.php";
?>

<section class="profile">
    <div class="profile-bg">
        <div class="wrapper">
            <div class="profile-info">
                <div class="profile-info-img">
                    <!-- Display username and provide link to profile settings -->
                    <p class="profile-info-username">
                        <?php echo $user["username"]; ?>
                    </p>
                    <a href="profile_setting.php" class="follow-button">PROFILE SETTING</a>
                </div>
                <div class="profile-info-about">
                    <h3>ABOUT</h3>
                    <!-- Display user email -->
                    <p>Email : <?php echo $user["email"]; ?></p>
                </div>
            </div>
            <div class="profile-content">
                <div class="profile-intro">
                    <h3>TITLE HERE</h3>
                    <!-- Display introductory text -->
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti reprehenderit dignissimos assumenda ducimus ex aliquam voluptas suscipit nostrum?
                    <br><br>
                    Impedit suscipit odio cumque esse officia sint ullam consequuntur fuga, atque laudantium.</p>
                </div>
                <div class="tier-info">
                    <h3>TIER: <br>
                        <?php echo $userTier["tier_name"]; ?>
                    </h3>
                    <h3>AVAILABLE CLASSES: <br>
                        <?php echo $userTier["class_name"]; ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
    // Include the footer
    include "footer.php";
?>
</html>
