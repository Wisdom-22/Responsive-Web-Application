<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection
$mysqli = require_once __DIR__ . '/../../config/database.php';

// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    // Fetch user details
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    // Fetch user tier
    $tierSql = "SELECT u.*, t.*, c.*
                FROM users u
                JOIN tier t ON u.user_tier = t.tier_id
                LEFT JOIN tier_class tc ON t.tier_id = tc.tier_id
                LEFT JOIN class c ON tc.class_id = c.class_id
                WHERE u.id = {$_SESSION["user_id"]}";
    $userTierResult = $mysqli->query($tierSql);
    $userTier = $userTierResult->fetch_assoc();
}

// Include the header file which presumably contains the navigation menu and logo
include "header.php";
?>

<section class="classImageContainer">
    <div class="successStoriesMainImage">
        <!-- Main image for the boxing section -->
        <img src="../../public/images/boxingMainImage.jpeg"> 
        <div class="banner-text">
            <!-- Text overlay on the banner image -->
            <h1>BOXING</h1>
        </div>
    </div>
</section>

<section class="classContainer">
    <h1 class="classMainHeading">WHAT TO EXPECT IN A BOXING CLASS?</h1>
    <div class="classMainDescription">
        <h3>BOXING</h3>
        <?php if (!isset($user)): ?>
            <!-- Message for users who are not logged in -->
            <p style="font-weight: bold;">Please Log in to view the content!</p>
        <?php elseif ($userTier["tier_id"] == "3" || $userTier["tier_id"] == "4"): ?>
            <!-- Description for users with appropriate tier -->
            <p>
                This is a contact sport that involves two individuals. While you train with us, you will be coached by a trainer who happens to be 
                a former world heavy weight champion. You would also be provided with the equipment and gears you need during your time here. 
            </p>
        </div>
        <div class="classInstructions">
            <ul>
                <li>Bring a towel</li>
                <li>All welcome</li>
            </ul>
        </div>
        <?php else: ?>
            <!-- Message for users without appropriate tier -->
            <p style="font-weight: bold;">You do not have appropriate tier to view this content</p>
        <?php endif; ?>
</section>

<div class="joinCommunity">
    <h1>Join Community</h1>
    <form class="joinCommunityForm">
        <button type="button" class="joinToday">Join Today</button>
    </form>
    <!-- Image for the community joining section -->
    <img src="../../public/images/communityImage.jpeg"> 
</div>

<?php
// Include the footer file which presumably contains footer information and links
include "footer.php";
?>
