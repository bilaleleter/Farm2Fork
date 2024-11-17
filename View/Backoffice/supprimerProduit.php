<?php
include('./../../Controller/Farm2ForkController.php');
$produitcontroller=new Farm2ForkController();
$produitcontroller->supprimerProduit(($_GET['id_produit']));
header("Location:listeProduit.php");
?>