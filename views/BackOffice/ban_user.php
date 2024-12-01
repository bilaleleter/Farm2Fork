<?php
session_start();

include_once(__DIR__ . '/../../controllers/UserController.php');
$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $ban_until = $_POST['ban_until'];
    echo "ban until posted: ".$ban_until;
    // Call function to ban the user
    $result = $userController->banUser($user_id, $ban_until);

    if ($result) {
        header('Location: template/pages/user_management.php?status=success&message=User banned until ' . $ban_until);
    } else {
        header('Location: template/pages/user_management.php?status=error&message=Failed to ban user');
    }
} else {
    header('Location: template/pages/user_management.php?status=error&message=Invalid request');
}
?>
