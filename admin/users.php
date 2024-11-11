<?php

// Start the session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration and functions
include '../config/database.php';
include 'message_function.php';

// Ensure the user is authenticated and authorized
secure();

// Handle deletion request
if (isset($_GET['delete'])) {
    // First, retrieve the user's email by their ID
    if ($stm = $connect->prepare('SELECT email FROM users WHERE id = ?')) {
        $stm->bind_param('i', $_GET['delete']);
        $stm->execute();
        $result = $stm->get_result();
        $user = $result->fetch_assoc();
        
        // Check if the user exists and is not the admin
        if ($user && $user['email'] !== 'admin@email.com') {
            // Proceed to delete the user if the email is not 'admin@email.com'
            if ($stm_del = $connect->prepare('DELETE FROM users WHERE id = ?')) {
                $stm_del->bind_param('i', $_GET['delete']);
                $stm_del->execute();
                set_message("User " . $_GET['delete'] . " has been deleted");
                header('Location: users.php');
                $stm_del->close();
                die();
            } else {
                echo 'Could not prepare statement for deletion!';
            }
        } else {
            // Set delete error when trying to delete the admin user
            $_SESSION['delete_error'] = "Cannot delete admin user";
            header('Location: users.php');
            die();
        }
        $stm->close();
    } else {
        echo 'Could not prepare statement!';
    }
}

// Check for delete_error session variable
if (isset($_SESSION['delete_error'])) {
    $delete_error = $_SESSION['delete_error'];
    unset($_SESSION['delete_error']);
} else {
    $delete_error = '';
}

// Prepare and execute SQL query to fetch all users
if ($stm = $connect->prepare('SELECT * FROM users')) {
    $stm->execute();
    $result = $stm->get_result();

    // Check if any users are found
    if ($result->num_rows > 0) {

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Users Management</h1>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Tier</th>
                    <th>Edit | Delete</th>
                </tr>

                <!-- Loop through each user and display their details in the table -->
                <?php while($record = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $record['id']; ?></td>
                    <td><?php echo $record['username']; ?></td>
                    <td><?php echo $record['email']; ?></td>
                    <td><?php echo $record['user_tier']; ?></td>
                    <td>
                        <a href="users_edit.php?id=<?php echo $record['id']; ?>">Edit</a> | 
                        <a href="users.php?delete=<?php echo $record['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>

            <a href="users_add.php">Add new user</a>
        </div>
    </div>
</div>

<!-- Modal for error messages -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= htmlspecialchars($delete_error) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    // Show the error modal if delete_error is set
    <?php if (!empty($delete_error)): ?>
    $(document).ready(function() {
        $('#errorModal').modal('show');
    });
    <?php endif; ?>
</script>
</body>
</html>

<?php
    } else {
        echo 'No users found';
    }

    $stm->close();

} else {
    echo 'Could not prepare statement for users.php!';
}

// Include the footer file for the HTML structure
include('../app/views/footer.php');
?>
