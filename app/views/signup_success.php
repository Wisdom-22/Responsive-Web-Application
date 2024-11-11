<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Inline CSS styling -->
    <style>
        .signin_button {
            color: black;
        }
    </style>
</head>
<body>
    <!-- Include header -->
    <?php include 'header.php'; ?>
    
    <!-- Success message section -->
    <div class="success-main">
        <!-- Heading for successful signup -->
        <h1 class="signup_heading">SignUp Successful</h1>
        <!-- Success message with a login button -->
        <p class="signup_message">
            You have successfully signed up.<br>
            <!-- Button to open the login popup -->
            <button onclick="openPopup('signin-popup')" id="signin-button" class="signin_button">Click here</button> to log in.
            <!-- Include signin form -->
            <?php include('signin_form.php'); ?>
        </p>
    </div>
    
    <!-- Include footer -->
    <?php include 'footer.php' ?>
    
    <!-- Include JavaScript file -->
    <script src="../../public/js/assignment_2.js" async defer></script>
</body>
</html>
