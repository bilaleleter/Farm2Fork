<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\UserController.php';
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Model\UserModel.php';

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role_id'];  // Role must be passed as a hidden input or determined some other way

    $user = new UserModel();
    $user->setRoleId($role); // Set role ID appropriately based on your application's requirements
    $user->setEmail($_POST['email']);
    $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
    $user->setPhoneNumber($_POST['phone']);
    $user->setCountry($_POST['country']);
    $user->setCity($_POST['city']);
    $user->setAddress($_POST['address']);

    if ($role == 2) {
        $user->setNomConsomateur($_POST['firstName']);
        $user->setPrenomConsomateur($_POST['lastName']);
        $user->setGenre($_POST['gender']);
       // $user->setProfilePic($_FILES['profilePic']['name']); // Assuming file upload handling is elsewhere
    } else if ($role == 1) {
        $user->setFarmName($_POST['farmName']);
        $user->setFarmOwnerName($_POST['farmOwner']);
        $user->setFarmDescription($_POST['farmDescription']);
       // $user->setProfilePic($_FILES['farmProfilePic']['name']); // Assuming file upload handling is elsewhere
    }
    //echo var_dump($user);
    if ($userController->addUser($user)) {
        header('Location: template/pages/user_management.php?status=success');
    } else {
        header('Location: template/pages/user_management.php?status=error');
    }
}
?>
