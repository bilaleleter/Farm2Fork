<?php

/*echo 'Request Method: ' . $_SERVER['REQUEST_METHOD'];
print_r($_POST);
die();*/
include_once(__DIR__ . '/../../core/config.php');
include(__DIR__ . '/../../controllers/UserController.php');
session_start();
$controller = new UserController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    if (empty($_POST['token'])) {
        echo json_encode(['success' => false, 'message' => 'Token is missing.']);
        exit();
    }
    if ($password === $confirmPassword) {
        $currentPasswordHash = $controller->getCurrentPasswordHashByToken($token);
        if (password_verify($password, $currentPasswordHash)) {
            echo json_encode(['success' => false, 'message' => 'New password cannot be the same as the old password.']);
        } else {
            $resetStatus = $controller->resetPassword($token, $password);

            if ($resetStatus['success']) {
                echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => $resetStatus['message']]);
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>