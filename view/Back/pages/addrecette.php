<?php

include_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\recetteControler.php';
include_once 'C:\xampp\htdocs\dashboard\recettenadine\model\recetteModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $idr = $_POST['idr'];
    $nomr = $_POST['nomr'];
    $descriptionr = $_POST['descriptionr'];
    $tempsr = $_POST['tempsr'];
    $difficulte = $_POST['difficulte'];


    $recette = new recette($idr, $nomr, $descriptionr, $tempsr, $difficulte);

    $controller = new recettes();


    $controller->addrecette($recette);

    header("Location: tables.php");
}
?>
