<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="sign_in.css"> <!-- Assuming your CSS file is named style.css -->
</head>

<body>

    <form action="reset_password_server.php" id="reset-password-form" method="POST" autocomplete="off" novalidate="true">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password">
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <button type="submit" class="nav-button">Reset Password</button>
    </form>
</body>
<script src="forgot_password.js"></script>

</html>
