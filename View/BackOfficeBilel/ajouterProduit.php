<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\ProduitController.php';

$produitcontroll=new ProduitController();
$produitcontroll->ajouterProduit($produit);
header("Location:listeProduit.php");
?>
