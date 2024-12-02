<?php
require '../controller/AvisC.php';

$pc=new AvisC();

$pc->deleteAvis($_GET["id"]);
header('Location:AfficherAvis.php');
?>