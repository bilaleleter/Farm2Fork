<?php
include_once '../../controllers/UserController.php';

$userController = new UserController();
$type = $_GET['type'] ?? '';
$term = $_GET['term'] ?? '';

if (!$type || !$term) {
    echo json_encode(['error' => 'Invalid search parameters']);
    exit;
}

$results = $userController->searchUsers($type, $term);
if (count($results) === 0) {
    echo json_encode(['error' => 'No users found matching the criteria.']);
} else {
    echo json_encode($results);
}
?>
