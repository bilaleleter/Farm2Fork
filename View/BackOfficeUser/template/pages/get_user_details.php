<?php
// Assuming session_start() and necessary authentication are handled accordingly
include_once(__DIR__ . '/../../../../Core/config.php');
include_once(__DIR__ . '/../../../../Model/UserModel.php');
include_once(__DIR__ . '/../../../../Controller/UserController.php');

// Get user ID from query string
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_id === 0) {
    echo json_encode(['error' => 'Invalid user ID.']);
    exit;
}

$userController = new UserController();
$user = $userController->showUser($user_id);

if (!$user) {
    echo json_encode(['error' => 'No user found for the given ID.']);
} else {
    // Return user data as JSON
    echo json_encode($user);
}
?>