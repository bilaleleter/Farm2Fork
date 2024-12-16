<?php

require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\recetteControler.php';
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Model\recetteModel.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $nomr = $_POST['nomr'];
    $descriptionr = $_POST['descriptionr'];
    $tempsr = $_POST['tempsr'];
    $difficulte = $_POST['difficulte'];

    // Create a new recette object
    $recette = new recette(null, $nomr, $descriptionr, $tempsr, $difficulte);

    // Instantiate the controller
    $controller = new recettes();

    try {
        // Add the recipe
        $controller->addrecette($recette);

        // Redirect back to tables.php with a success status
        header("Location: tables.php?status=success");
        exit;
    } catch (Exception $e) {
        // Redirect back to tables.php with an error status
        header("Location: tables.php?status=error&message=" . urlencode($e->getMessage()));
        exit;
    }
}
?>

