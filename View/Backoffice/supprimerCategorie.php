<?php
include './../../Controller/CategorieController.php';
$categoriecontroller = new CategorieController();
$categoriecontroller->supprimerCategorie($_GET['id_categorie']);
header("Location: listeCategorie.php");
?>
