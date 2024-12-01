<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('C:\xampp\htdocs\Farm2Fork\gest_utilisateur\core\config.php');
include_once('C:\xampp\htdocs\Farm2Fork\gest_utilisateur\controllers\UserController.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new UserController();

    $role = $_POST['role'];
    $email = $_POST[$role == '1' ? 'email_agri' : 'email_cons'];

    // Check if email exists
    if ($controller->isEmailExists($email)) {
        echo json_encode(['success' => false, 'message' => 'Email already exists.']);
        exit();
    }

    $password = $_POST[$role == '1' ? 'mdp_agri' : 'password_cons'];
    $phone_number = $_POST[$role == '1' ? 'phone_agri' : 'phone_cons'];
    $country = $_POST[$role == '1' ? 'country_agri' : 'country_cons'];
    $city = $_POST[$role == '1' ? 'city_agri' : 'city_cons'];
    $address = $_POST[$role == '1' ? 'address_agri' : 'address_cons'];

    if ($role == '1') { 
        $farm_name = $_POST['nom_ferme_agri'];
        $farm_owner_name = $_POST['nom_prop_agri'];
        $farm_description = NULL;
        $nom_consomateur = NULL;
        $prenom_consomateur = NULL;
        $genre = NULL;
    } else {
        $nom_consomateur = $_POST['nom_cons'];
        $prenom_consomateur = $_POST['prenom_cons'];
        $genre = $_POST['gender_cons'];
        $farm_name = NULL;
        $farm_description = NULL;
        $farm_owner_name = NULL;
    }

    $ban_until = NULL;
    $farm_pics = NULL;
    $farm_vids = NULL;
    $profile_pic = NULL;
    $userModel = new UserModel(
        null, $role, $nom_consomateur, $prenom_consomateur,
        $phone_number, $email, $password, $country,
        $city, $address, $profile_pic, $ban_until,
        $genre, $farm_pics, $farm_vids, $farm_name,
        $farm_description, farm_owner_name: $farm_owner_name
    );
    $result = $controller->addUser($userModel);
    if ($result == true) {
        $_SESSION['user_id'] = $controller->getLastInsertId();
        $_SESSION['role'] = $role;
        $_SESSION['email'] = $user['email'];
        $_SESSION['logged_in'] = true;

        $redirectUrl = match ($role) {
            '1' => '..\BackOffice\agriculteur_dashboard.php',
            '2' => '../BackOffice\template/pages/consomateur_profile.php',
            default => 'start_page.php',
        };

        echo json_encode(['success' => true, 'redirect' => $redirectUrl]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Registration failed.']);
        exit();
    }
}
?>

