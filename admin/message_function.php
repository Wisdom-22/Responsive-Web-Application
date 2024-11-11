<?php 

/**
 * Function to secure a page by checking if the user is logged in.
 * If the user is not logged in, it sets a message and redirects to the login page.
 */
function secure() {
    // Check if the user is not logged in
    if(!isset($_SESSION['user_id'])){
        // Set a message for the user
        set_message("Please login first to view this page.");
        // Redirect to the login page
        header('Location: /');
        // Stop further execution of the script
        die();
    }
}

/**
 * Function to set a message in the session.
 * 
 * @param string $message The message to be set.
 */
function set_message($message){
    // Store the message in the session
    $_SESSION['message'] = $message;
}

/**
 * Function to get and display the message from the session.
 * It also unsets the message from the session after displaying it.
 */
function get_message(){
    // Check if there is a message set in the session
    if(isset($_SESSION['message'])){
        // Display the message using a JavaScript toast notification
        echo "<script type='text/javascript'> showToast('" . $_SESSION['message'] . "','top right' , 'success') </script>";
        // Remove the message from the session
        unset($_SESSION['message']);
    }
}
?>
