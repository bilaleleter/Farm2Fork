<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\AvisC.php';

$pc=new AvisC();

$pc->deleteAvis($_GET["id"]);
header('Location:AfficherAvis.php');
?>