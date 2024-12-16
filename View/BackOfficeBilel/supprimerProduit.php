<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\ProduitController.php';
$produitcontroller=new ProduitController();
$produitcontroller->supprimerProduit(($_GET['id_produit']));
header("Location:listeProduit.php");
?>