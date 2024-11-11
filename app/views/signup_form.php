<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Link to CSS file -->
    <link rel="stylesheet" href="../../public/css/forms.css">
    
    <!-- Script for form validation -->
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
</head>
<body>
    <!-- Signup Form Popup -->
    <div id="signup-popup" class="popup">
        <div class="popup-content">
            <!-- Close button for the popup -->
            <span class="close-btn" onclick="closePopup('signup-popup')">&times;</span>
            <!-- Title of the form -->
            <h2>Sign Up</h2>
            <!-- Signup form -->
            <form action="../../app/views/signup.php" method="post" id="signup" novalidate>
                <!-- First Name input field -->
                <div>
                    <label for="f_name">First Name</label>
                    <input type="text" id="f_name" name="f_name">
                </div>
                <!-- Last Name input field -->
                <div>
                    <label for="l_name">Last Name</label>
                    <input type="text" id="l_name" name="l_name">
                </div>
                <!-- Username input field -->
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">
                </div>
                <!-- Email input field -->
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>
                <!-- Password input field -->
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <!-- Confirm Password input field -->
                <div>
                    <label for="confirm_password">Repeat password</label>
                    <input type="password" id="confirm_password" name="confirm_password">
                </div>
                <!-- Submit button -->
                <button>Sign Up</button>
            </form>
        </div>
    </div>

    <!-- Include JavaScript files -->
    <script src="../../public/js/assignment_2.js" async defer></script>
    <script src="../../public/js/form_validation.js" defer></script>
</body>
</html>
