<?php
session_start();
include_once('C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\UserController.php');
$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Call function to unban the user
    $result = $userController->unbanUser($user_id);

    if ($result) {
        header('Location: template/pages/user_management.php?status=success&message=User unbanned');
    } else {
        header('Location: template/pages/user_management.php?status=error&message=Failed to unban user');
    }
} else {
    header('Location: template/pages/user_management.php?status=error&message=Invalid request');
}
?>
