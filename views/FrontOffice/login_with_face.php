<?php
include_once('C:\xampp\htdocs\Farm2Fork\gest_utilisateur\core\config.php');
include_once('C:\xampp\htdocs\Farm2Fork\gest_utilisateur\controllers\UserController.php');

$api_key = 'EGYeUcNwMWXyt1YYLi4c3Gmg9jTQwgNr';
$api_secret = 'aPAi53hLbQfUOa0ZmDibf9k51g6ZGPhZ';
$image_data = $_POST['image_data'];
$url = 'https://api-us.faceplusplus.com/facepp/v3/search';
$data = [
    'api_key' => $api_key,
    'api_secret' => $api_secret,
    'image_base64' => explode(',', $image_data)[1],
    'faceset_token' => '6599868f1faabcd5263dcc12b1d59659'
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    ]
];
$context = stream_context_create($options);
//error_log(http_build_query($data));  // Check how your data is being encoded

try {
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        $last_error = error_get_last();
        throw new Exception('HTTP request failed. Error: ' . $last_error['message']);
    }
    $response = json_decode($result, true);

    if (isset($response['results']) && $response['results'][0]['confidence'] > 80) {
        $face_token = $response['results'][0]['face_token'];
        $controller = new UserController();
        $user = $controller->getUserByFaceId($face_token);
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['logged_in'] = true;
            $redirectUrl = match ($user['role_id']) {
                1 => '../BackOffice/template/pages/agriculteur_profile.php',
                2 => '../BackOffice/template/pages/consomateur_profile.php',
                0 => '../BackOffice/template/pages/user_management.php',
                default => 'start_page.php',
            };
            echo json_encode(['success' => true, 'message' => 'Welcome!','redirect'=>$redirectUrl, 'face_id' => $face_token]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Face ID does not match any user.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No face detected or API error']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' .error_get_last()['message']
]);
}
?>
