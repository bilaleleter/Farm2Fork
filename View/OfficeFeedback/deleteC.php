<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\CommentaireC.php';

$pc=new CommentaireC();

$pc->deleteCommentaire($_GET["id"]);
header('Location:AfficherC.php');
?>