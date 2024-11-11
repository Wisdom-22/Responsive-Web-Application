<?php

// Enable error reporting for debugging purposes
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

    // Fetch user tier and related class details
    $tierSql = "SELECT u.*, t.*, c.*
                FROM users u
                JOIN tier t ON u.user_tier = t.tier_id
                LEFT JOIN tier_class tc ON t.tier_id = tc.tier_id
                LEFT JOIN class c ON tc.class_id = c.class_id
                WHERE u.id = {$_SESSION["user_id"]}";
    $userTierResult = $mysqli->query($tierSql);
    $userTier = $userTierResult->fetch_assoc();
}

// Include the header file
include "header.php";
?>
<!-- Main section displaying the class image and banner text -->
<section class="classImageContainer">
    <div class="successStoriesMainImage">
        <img src="../../public/images/heatedPolarImage.jpeg">
        <div class="banner-text">
            <h1>HEATED POLAR</h1>
        </div>
    </div>
</section>

<!-- Section for class details and description -->
<section class="classContainer">
    <h1 class="classMainHeading">WHAT TO EXPECT IN A HEATED POLAR CLASS?</h1>
    <div class="classMainDescription">
        <h3>HEATED POLAR</h3>
        <?php if (!isset($user)): ?>
            <!-- Prompt for login if user is not logged in -->
            <p style="font-weight: bold;">Please Log in to view the content!</p>
        <?php elseif ($userTier["tier_id"] == "4"): ?>
            <!-- Display class details if user has the appropriate tier -->
            <p>
                This class involves high intensive training. This class is performed in hot and frigid environments which has been proven to provide benefits for our bodies. This class will involve students 
                stepping into a sauna-like environment or a frigid environment for some period. This class will be taught by a specialist and will be performed in such a way that our students are
                safe and secure at all times.
            </p>
            <div class="classInstructions">
                <ul>
                    <li>Bring a towel</li>
                    <li>All welcome</li>
                </ul>
            </div>
        </div>
        <?php else: ?>
            <!-- Display message if user does not have the appropriate tier -->
            <p style="font-weight: bold;">You do not have appropriate tier to view this content</p>
        <?php endif; ?>
</section>

<!-- Section for joining the community -->
<div class="joinCommunity">
    <h1>Join Community</h1>
    <form class="joinCommunityForm">
        <button type="button" class="joinToday">Join Today</button>
    </form>
    <img src="../../public/images/communityImage.jpeg"> 
</div>

<!-- Include the footer file -->
<?php include "footer.php"; ?>
