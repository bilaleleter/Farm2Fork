<?php
include_once(__DIR__ . '/../../core/config.php');//badalhom
include(__DIR__ . '/../../controllers/UserController.php');//badalhom
session_start();
$controller = new UserController();
?>

<body>
    <form id="reset-password-form" method="POST" autocomplete="off" novalidate="true">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password">
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">
    </form>
    <button type="submit" class="nav-button">Reset Password</button>
</body>


<?php
$token = $_GET['token'];
$password = $_POST['password'];//badel name
$confirmPassword = $_POST['confirm_password'];//badel name
echo "token=".$token;
if (empty($_GET['token'])) {
    echo 'LOLOLOLOLO TOKEN FAMECH';
    exit();
}
if($password === $confirmPassword){
    $currentPasswordHash = $controller->getCurrentPasswordHashByToken($token);
    if(password_verify($password, $currentPasswordHash)){
        //dhaharlou erreur tkolou fehaa new pass cannot be the same as the old password
        echo"passwords cannot be the same";
        exit();
    }else{
        $resetStatus = $controller->resetPassword($token, $password);
        if ($resetStatus){
            echo "password updated successfully";
        } else {
            echo "reset erreur";
        }
    }
} else {
    echo "passwords do not match";
}
?>


<!--hedhouma hothom fel controller-->
<script>
    public function storePasswordResetToken($email, $token, $expires) {
        try {
            $sql = "INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, :expires_at)
                    ON DUPLICATE KEY UPDATE token = :token, expires_at = :expires_at";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expires_at', $expires);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function resetPassword($token, $newPassword) {
        try {
            $sql = "SELECT email FROM password_resets WHERE token = :token AND expires_at >= NOW()";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $userEmail = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($userEmail) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $sqlUpdate = "UPDATE Utilisateur SET password = :password WHERE email = :email";
                $stmtUpdate = $this->db->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':password', $hashedPassword);
                $stmtUpdate->bindParam(':email', $userEmail['email']);
                $stmtUpdate->execute();
                $sqlDelete = "DELETE FROM password_resets WHERE email = :email";
                $stmtDelete = $this->db->prepare($sqlDelete);
                $stmtDelete->bindParam(':email', $userEmail['email']);
                $stmtDelete->execute();
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Optionally, log this error
            return false;
        }
    }
    
    public function getCurrentPasswordHashByToken($token) {
        try{
            $stmt = $this->db->prepare("SELECT Utilisateur.password FROM Utilisateur JOIN password_resets ON Utilisateur.email = password_resets.email WHERE password_resets.token = ?");
            $stmt->execute([$token]);
            $result = $stmt->fetch();
            return $result ? $result['password'] : null;
        }catch(PDOException $e){
            error_log("Database error in getCurrentPasswordHashByToken: " . $e->getMessage());
            return null;  
        }
    }

</script>