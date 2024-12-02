<?php
require '../Controller/CommentaireC.php';

$pc=new CommentaireC();

$pc->deleteCommentaire($_GET["id"]);
header('Location:AfficherC.php');
?>