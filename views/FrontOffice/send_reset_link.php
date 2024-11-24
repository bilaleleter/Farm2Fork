<?php
include_once(__DIR__.'/../../../vendor\autoload.php');
include_once(__DIR__.'/../../core/config.php');
include(__DIR__.'/../../controllers/UserController.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database using UserController
    if ($controller->isEmailExists($email)) {
        $token = bin2hex(random_bytes(32)); // Generate a secure random token
        $expires = time() + 3600; // Token valid for 1 hour

        // Store the token in the database associated with the user
        if ($controller->storePasswordResetToken($email, $token, $expires)) {
            // Prepare PHPMailer to send the reset link
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->SMTPDebug = 2;
                $mail->Host = 'smtp.office365.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'farm2fork0@outlook.com';  // SMTP username
                $mail->Password = 'amiffdklsifcazov';           // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('no-reply@farm2fork.com', 'Farm2Fork');
                $mail->addAddress($email);     // Add a recipient

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Password Reset Request';
                $resetLink = "http://localhost/Farm2Fork/gest_utilisateur/views/FrontOffice/reset_password.php?token=" . $token;
                $mail->Body    = "Please click on the following link to reset your password: <a href='{$resetLink}'>Reset Password</a>";

                $mail->send();
                echo json_encode(['success' => true, 'message' => 'Check your email for the password reset link.']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => "Mailer Error: " . $mail->ErrorInfo]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to store reset token.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No account found with that email address.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
