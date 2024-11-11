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

    // Fetch user tier and classes associated with the tier
    $tierSql = "SELECT u.*, t.*, c.*
                FROM users u
                JOIN tier t ON u.user_tier = t.tier_id
                LEFT JOIN tier_class tc ON t.tier_id = tc.tier_id
                LEFT JOIN class c ON tc.class_id = c.class_id
                WHERE u.id = {$_SESSION["user_id"]}";
    $userTierResult = $mysqli->query($tierSql);
    $userTier = $userTierResult->fetch_assoc();
}

// Include the header
include "header.php";
?>

<!-- Section for the class image and banner text -->
<section class="classImageContainer">
    <div class="successStoriesMainImage">
        <img src="../../public/images/pilatesImage.jpeg">
        <div class="banner-text">
            <h1>PILATES</h1>
        </div>
    </div>
</section>

<!-- Section for class content -->
<section class="classContainer">
    <h1 class="classMainHeading">WHAT TO EXPECT IN A PILATES CLASS?</h1>
    <div class="classMainDescription">
        <h3>PILATES</h3>
        <?php if (!isset($user)): ?>
            <!-- Message shown if the user is not logged in -->
            <p style="font-weight: bold;">Please Log in to view the content!</p>
        <?php elseif ($userTier["tier_id"] == "2" || $userTier["tier_id"] == "3" || $userTier["tier_id"] == "4"): ?>
            <!-- Content for users with appropriate tier access -->
            <p>
                The pilates class will be taught by one of our instructors and it would involve all students in the same area. There would be videos shown to the students, the instructor would
                also show each student how to make certain movements. All students would be carried along in this class and the gear for this class would be provided to students.
            </p>
        </div>

        <div class="classInstructions">
            <ul>
                <li>Bring a towel</li>
                <li>All welcome</li>
            </ul>
        </div>
        <?php else: ?>
            <!-- Message shown if the user does not have appropriate tier access -->
            <p style="font-weight: bold;">You do not have appropriate tier to view this content</p>
            
            <?php echo $userTier["tier_id"];?>
        <?php endif; ?>
</section>

<!-- Section for joining the community -->
<div class="joinCommunity">
    <h1>Join Community</h1>
    <form class="joinCommunityForm">
        <button type="button" class="joinToday">Join Today</button>
    </form>
    <img src="../../public/images/background2.jpeg">
</div>

<!-- Include the footer -->
<?php include "footer.php"; ?>
