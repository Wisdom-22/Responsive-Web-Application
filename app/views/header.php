<?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Start the session only if it hasn't been started already
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is logged in
    if (isset($_SESSION["user_id"])) {
        // Include the database configuration file
        $mysqli = require __DIR__ . '/../../config/database.php';
        
        // SQL query to fetch user data based on session user ID
        $sql = "SELECT * FROM users
                WHERE id = {$_SESSION["user_id"]}";
                
        $result = $mysqli->query($sql);
        
        // Fetch the user data
        $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 3</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/forms.css">
    
    <!-- MDB UI Kit CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
    
    <!-- Bootstrap CSS for Modal -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery and Bootstrap JS for Modal -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- JustValidate JS library -->
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
</head>
<body>
    <header class="header">
        <!-- Logo and navigation menu -->
        <a href="<?php echo '../../public/index.php'; ?>"><img src="<?php echo '../../public/images/sewa-logo-img.png'; ?>" alt="SEWA logo" class="logo-img"></a>
        <nav class="navigation">
                <ul>
                    <!-- Navigation links -->
                    <li><a href="<?php echo '../../public/index.php'; ?>" class="home">Home</a></li>
                    <li><a href="<?php echo '../../app/views/aboutUs.php'; ?>" class="about">About</a></li>
                    <li><a href="<?php echo '../../app/views/gallery.php'; ?>">Gallery</a></li>
                    
                    <!-- User-specific links if the user is logged in -->
                    <?php if (isset($user)): ?>
                        <li><a href="<?php echo '../../app/views/profile.php'; ?>" class="username-index"><?php echo $user["username"]; ?></a></li>
                        <li><a href="<?php echo '../../app/views/logout.php'; ?>" class="logout">LogOut</a></li>
                    
                    <!-- Login and Register buttons if the user is not logged in -->
                    <?php else: ?>
                        <li><button onclick="openPopup('signin-popup')" class="signin_button">Login</button></li>
                        <li><button onclick="openPopup('signup-popup')" id="signup-button" class="signup_button">Register</button></li> 
                        
                        <!-- Include login and signup forms -->
                        <?php include('signin_form.php'); ?>
                        <?php include('signup_form.php'); ?>
                    <?php endif; ?>
                    
                    <!-- Horizontal line decoration -->
                    <span class="navLine"></span>
                </ul>
        </nav>  
    </header>

    <!-- Custom JS file -->
    <script src="../../public/js/assignment_2.js" async defer></script>
    
    <!-- MDB UI Kit JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
</body>
</html>
