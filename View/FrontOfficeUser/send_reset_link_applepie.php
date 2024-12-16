<?php 
include_once('C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\vendor\autoload.php');
include_once('C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Core\config.php');
include_once('C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\UserController.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$controller = new UserController();
?>

<body>
    <form id="forgot-password-form" method="post" autocomplete="off" novalidate="true">
        <h1>Forgot Your Password?</h1>
        <label for="email">Enter your email address:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" class="nav-button">Send Reset Link</button>
    </form>
</body>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database using UserController
    if($controller->isEmailExists($email)) {
        $token = bin2hex(random_bytes(32)); // Generate a secure random token
        $expires = time() + 3600; // Token valid for 1 hour
        $expires_at = date('Y-m-d H:i:s', $expires);

        // Store the token in the database associated with the user
        if ($controller->storePasswordResetToken($email, $token, $expires_at)) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->SMTPDebug = 1;
                $mail->Host = 'smtp.office365.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'mohamedislam.athmani@esprit.tn';  // SMTP username
                $mail->Password = 'tvmthvggvjbzvydt';           // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom('mohamedislam.athmani@esprit.tn', 'Farm2Fork');
                $mail->addAddress($email);     // Add a recipient

                $mail->isHTML(true);// Set email format to HTML
                $mail->Subject = 'Password Reset Request';
                $resetLink = "C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeUser\reset_password.php?token=".$token;//badel lien w THABET FIH!!!!!!!!!!!!!!!!!!!
                $mail->Body    = "
                Please click on the following link to reset your password: <a href='{$resetLink}'>Reset Password</a>
                ";

                $mail->send();
                echo "Check your email for the password reset link.";
            } catch (Exception $e) {
                echo 'Mailer Error: '.$mail->ErrorInfo;
            }
        } else {
            echo 'Failed to store reset token.';
        }
    } else {
        echo 'No account found with that email address.';
    }
} else {
    echo 'Invalid request.';
}
?>
