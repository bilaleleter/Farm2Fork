<?php
require '../Controller/CommentaireC.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$action = $data['action'];

$commentaireC = new CommentaireC();
$response = $commentaireC->likeDislikeCommentaire($id, $action);

header('Content-Type: application/json');
echo json_encode($response);
?>
