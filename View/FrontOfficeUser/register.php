<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Core\config.php');
include_once('C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\UserController.php');

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
    $profile_pic = $_FILES[$role == '1' ? 'profile_pic_agri':'profile_pic_cons'];
    if($role == '1' && isset($_POST['face_id_agri']) && !empty($_POST['face_id_agri'])){
        $faceId = $_POST['face_id_agri'];

    }

    if(isset($_POST['face_id']) && !empty($_POST['face_id'])){
        $faceId = $_POST['face_id'];
    }
    else if($role == '2' && isset($_POST['face_id_cons']) && !empty($_POST['face_id_cons'])){
        $faceId = $_POST['face_id_cons'];
    }
    else{
        $faceId = null;//mahouch obligatoire
    }
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
    if (isset($profile_pic) && $profile_pic['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'assets\profile_pics/';
        $tmpName = $profile_pic['tmp_name'];
        $fileName = basename($profile_pic['name']);
        $pathParts = pathinfo($fileName);
        $ext = strtolower($pathParts['extension']);
        // Validate file extension
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($ext, $allowedExts)) {
            $newFileName = md5(uniqid(rand(), true)) . '.' . $ext; // Create a unique name for the file
            $finalPath = $uploadDir . $newFileName;

            if (move_uploaded_file($tmpName, $finalPath)) {
                $profile_pic = $finalPath;
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to save file.']);
            exit();

            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid file type.']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No file uploaded or file too large']);
        exit();

    }

    $userModel = new UserModel(
        null,
        $role,
        $nom_consomateur,
        $prenom_consomateur,
        $phone_number,
        $email,
        $password,
        $country,
        $city,
        $address,
        $profile_pic,
        $ban_until,
        $genre,
        $farm_pics,
        $farm_vids,
        $farm_name,
        $farm_description,
        farm_owner_name: $farm_owner_name,
        faceId: $faceId
        
    );
    $result = $controller->addUser($userModel);
    if ($result == true) {
        //zid face id lel face set
        if ($faceId != null) {

            $addFaceUrl = 'https://api-us.faceplusplus.com/facepp/v3/faceset/addface';
            $addFaceData = [
                'api_key' => "EGYeUcNwMWXyt1YYLi4c3Gmg9jTQwgNr",
                'api_secret' => "aPAi53hLbQfUOa0ZmDibf9k51g6ZGPhZ",
                'faceset_token' => "6599868f1faabcd5263dcc12b1d59659",
                'face_tokens' => $faceId
            ];

            $options = [
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($addFaceData)
                ]
            ];
            $context = stream_context_create($options);
            $addFaceResult = file_get_contents($addFaceUrl, false, $context);

            if ($addFaceResult === FALSE) {
                echo json_encode(['success' => false, 'message' => 'Failed to add face to FaceSet.']);
            }
        }
        $_SESSION['user_id'] = $controller->getLastInsertId();
        $_SESSION['role'] = $role;
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;
        
        $redirectUrl = match ($role) {
            '1' => '../BackOfficeUser/template/pages/agriculteur_profile.php',
            '2' => '../BackOfficeUser/template/pages/consomateur_profile.php',
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