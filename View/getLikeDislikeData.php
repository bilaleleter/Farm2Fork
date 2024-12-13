<?php
require '../Controller/CommentaireC.php';

$commentaireC = new CommentaireC();
$listeCommentaires = $commentaireC->afficherCommentaires();

$labels = [];
$likes = [];
$dislikes = [];

foreach ($listeCommentaires as $commentaire) {
    $labels[] = 'Commentaire ' . $commentaire['id'];
    $likes[] = $commentaire['likee'];
    $dislikes[] = $commentaire['dislike'];
}

header('Content-Type: application/json');
echo json_encode([
    'labels' => $labels,
    'likes' => $likes,
    'dislikes' => $dislikes
]);
?>
