<html>
<body>
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="sign_in.css"> <!-- Assuming your CSS file is named style.css -->
    </head>
    <form action="reset_password.php" id="reset-password-form" method="post" autocomplete="off" novalidate="true">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <button type="submit" class="nav-button">Reset Password</button>
    </form>
<script src="forgot_password.js"></script>
</body>
</html>

<?php
include_once(__DIR__.'../../core/config.php');
include(__DIR__.'/../../controllers/UserController.php');
session_start();
$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'], $_POST['password'], $_POST['confirm_password'])) {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password === $confirmPassword) {
        $resetStatus = $controller->resetPassword($token, $password);

        if ($resetStatus['success']) {
            echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => $resetStatus['message']]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
