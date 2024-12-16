<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\CategorieController.php';
$categoriecontroller = new CategorieController();
$categoriecontroller->supprimerCategorie($_GET['id_categorie']);
header("Location: listeCategorie.php");
?>
