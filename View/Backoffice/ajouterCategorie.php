<?php
include('./../../Controller/CategorieController.php');
$categoriecontroll=new CategorieController();
$categoriecontroll->ajouterCategorie($categorie);
header("Location:listeCategorie.php");
?>
