
<?php
include_once '../../controllers/UserController.php';
include_once '../../models/UserModel.php';

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $user = $userController->showUser($user_id);
    print_r($_POST);
    if (!$user) {
        die('User not found!');
    }

    $updatedUser = new UserModel();
    $updatedUser->setUserId($user_id);
    $updatedUser->setRoleId($_POST['role_id']);
    $updatedUser->setEmail($_POST['email']);
    if (!empty($_POST['password'])) {
        $updatedUser->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
    } else {
        $updatedUser->setPassword($user['password']);
    }
    $updatedUser->setPhoneNumber($_POST['phone_number']);
    $updatedUser->setCountry($_POST['country']);
    $updatedUser->setCity($_POST['city']);
    $updatedUser->setAddress($_POST['address']);

    if ($_POST['role_id'] == 2) {
        $updatedUser->setNomConsomateur($_POST['firstName']);
        $updatedUser->setPrenomConsomateur($_POST['lastName']);
        $updatedUser->setGenre($_POST['gender']);
        $updatedUser->setProfilePic($user['profile_pic']); 
        //null
        $updatedUser->setFarmName(null);
        $updatedUser->setFarmOwnerName(null);
        $updatedUser->setFarmDescription(null);
    } else if ($_POST['role_id'] == 1) { 
        $updatedUser->setFarmName($_POST['farmName']);
        $updatedUser->setFarmOwnerName($_POST['farmOwner']);
        $updatedUser->setFarmDescription($_POST['farmDescription']);
        $updatedUser->setProfilePic($user['profile_pic']); 

        //null
        $updatedUser->setNomConsomateur(null);
        $updatedUser->setPrenomConsomateur(null);
        $updatedUser->setGenre(null);
    }
    //echo var_dump($updatedUser);
    $result = $userController->updateUser($updatedUser, $user_id);

    if ($result) {
        header('Location: template/pages/user_management.php?status=success');
    } else {
        header('Location: template/pages/user_management.php?status=error');
    }
}
?>

