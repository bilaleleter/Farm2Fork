<?php
include('config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $db = config::getConnexion();
        $sql = "SELECT * FROM Utilisateurs WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            if (password_verify($password, $user['pwd'])) {
                session_start();//fi oudh manestaamlou cookie bech l user yokeed remembered fel session hedhika hata ken yhel paget okhrin
                $_SESSION['user_id'] = $user['user_id']; 
                $_SESSION['email'] = $user['email'];
                $_SESSION['role_id'] = $user['role_id'];
                if ($user['role_id'] == 1) {
                    echo "Bienvenu Agriculteur ";
                    //header("Location: agriculteur_dashboard.php");
                    exit();
                } elseif ($user['role_id'] == 2) {
                    echo "Bienvenu Consomateur";
                    //header("Location: consommateur_dashboard.php");
                    exit();
                }
                else if($user['role_id'] == 0){
                    echo "Bienvenu Admin";
                    //header("Location: admin_dashboard.php");
                    exit();
                }
            } else {
                echo "Email ou Mot de passe Incorrect. pwd check";
            }
        } else {
            echo "Email ou Mot de passe Incorrect. user check";
        }
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
?>