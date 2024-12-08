<?php
require_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\nutritionController.php';
require_once 'C:\xampp\htdocs\dashboard\recettenadine\model\nutritionModel.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les valeurs du formulaire
    $idProduit = $_POST['idProduit'];
    $idr = $_POST['idr'];
    $calories = $_POST['calories'];
    $proteines = $_POST['proteines'];
    $carbohydrates = $_POST['carbohydrates'];

    // Créer un objet Nutrition
    $nutrition = new Nutrition($idProduit, $idr, $calories, $proteines, $carbohydrates);

    // Initialiser le contrôleur
    $nutritionController = new nutritions();

    // Appeler la méthode pour mettre à jour la nutrition
    $nutritionController->updateNutrition($nutrition, $idProduit);

    // Rediriger après mise à jour
    header("Location: tables.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
