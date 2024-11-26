<?php
include_once('./../../Controller/ProduitController.php');
$produitcontroll=new ProduitController();
$produitcontroll->ajouterProduit($produit);
header("Location:listeProduit.php");
?>
