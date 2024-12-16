<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\CategorieController.php';

$categoriecontroll=new CategorieController();
$categoriecontroll->ajouterCategorie($categorie);
header("Location:listeCategorie.php");
?>
