<?php
// Start or resume a session
session_start();

// Include the database configuration file and user model/controller
include_once('C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Core\config.php');
include_once('C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Model\UserModel.php');
include_once('C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\UserController.php');

// Create an instance of UserController
$userController = new UserController();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id is present
    if (!empty($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        // Perform the deletion
        $result = $userController->deleteUser($user_id);

        // Check the result and redirect or output an error message
        if ($result) {
            // Redirect to user management page with a success message
            header('Location: template/pages/user_management.php?status=success&message=User deleted successfully');
        } else {
            // Redirect or output an error message
            header('Location: template/pages/user_management.php?status=error&message=Unable to delete user');
        }
    } else {
        // Error message if no user_id
        header('Location: template/pages/user_management.php?status=error&message=User ID is missing');
    }
} else {
    // Not a POST request
    header('Location: template/pages/user_management.php?status=error&message=Invalid request');
}
exit();
?>
