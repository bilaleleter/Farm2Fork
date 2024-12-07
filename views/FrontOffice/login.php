<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('C:\xampp\htdocs\Farm2Fork\gest_utilisateur\core\config.php');
include_once('C:\xampp\htdocs\Farm2Fork\gest_utilisateur\controllers\UserController.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $controller = new UserController();

    // Check if email exists and validate password
    if (!$controller->isEmailExists($email)) {
        echo json_encode(['success' => false, 'message' => 'Email does not exist.', 'field' => 'email']);
        exit();
    } else {
        $user = $controller->getUserByEmail($email);
        $user_password = $user['password'];
        if (password_verify($password, $user_password)) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['logged_in'] = true;
            $user_role  = $user['role_id'];
            $redirectUrl = match ($user_role) {
                1 => '../BackOffice/template/pages/agriculteur_profile.php',
                2 => '../BackOffice/template/pages/consomateur_profile.php',
                0 => '../BackOffice/template/pages/user_management.php',
                default => 'start_page.php',
            };
            echo json_encode(['success' => true, 'redirect' => $redirectUrl]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password.', 'field'=> 'password']);
        }
        exit();
    }
}
?>
