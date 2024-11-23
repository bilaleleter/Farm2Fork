<?php
include('./../../Controller/ProduitController.php');
$produitcontroller=new ProduitController();
$produitcontroller->supprimerProduit(($_GET['id_produit']));
header("Location:listeProduit.php");
?>