<?php
include('./../../Controller/Farm2ForkController.php');
$produitcontroll=new Farm2ForkController();
$produitcontroll->ajouterProduit($produit);
header("Location:listeProduit.php");
?>
