<?php
require_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\nutritionController.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idProduit = $_POST['idProduit'];

    $nutritionController = new nutritions();

    $nutritionController->deleteNutrition($idProduit);

    header("Location: tables.php");
    exit;
}
?>
