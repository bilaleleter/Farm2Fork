<?php
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\recetteControler.php';
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Model\recetteModel.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idr = $_POST['idr'];
    $nomr = $_POST['nomr'];
    $descriptionr = $_POST['descriptionr'];
    $tempsr = $_POST['tempsr'];
    $difficulte = $_POST['difficulte'];

    $recette = new recette($idr, $nomr, $descriptionr, $tempsr, $difficulte);

    $recetteController = new recettes();

    $recetteController->updaterecette($recette, $idr);

    header("Location: tables.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
