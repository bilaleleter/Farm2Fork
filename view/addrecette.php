<?php
// Include the controller and model files
include_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\recetteControler.php';
include_once 'C:\xampp\htdocs\dashboard\recettenadine\model\recetteModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $idr = $_POST['idr'];
    $nomr = $_POST['nomr'];
    $descriptionr = $_POST['descriptionr'];
    $tempsr = $_POST['tempsr'];
    $difficulte = $_POST['difficulte'];

    // Create a new recette object
    $recette = new recette($idr, $nomr, $descriptionr, $tempsr, $difficulte);

    // Instantiate the controller
    $controller = new recettes();

    // Call the addrecette method
    $controller->addrecette($recette);

    // Redirect to a success page
    header("Location: recetteform.php");
}
?>
