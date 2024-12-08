<?php

// Inclure les fichiers nécessaires
require_once '../../../model/nutritionModel.php';
require_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\nutritionController.php';

// Vérifiez si la requête est une requête POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    // Récupérer les données envoyées depuis le formulaire
    $idr = $_POST['idr'];
    $calories = $_POST['calories'];
    $proteines = $_POST['proteines'];
    $carbohydrates = $_POST['carbohydrates'];

    // Créer un nouvel objet Nutrition
    $nutrition = new nutrition(null, $idr, $calories, $proteines, $carbohydrates);

    // Initialiser le contrôleur de nutrition
    $controller = new nutritions();

    // Ajouter la nutrition en appelant la méthode du contrôleur
    $controller->addNutrition($nutrition);

    // Rediriger vers une autre page après l'ajout (par exemple : page des tables)
    header("Location: tables.php");
    exit();
}
?>
