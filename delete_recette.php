<?php
require_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\recetteControler.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idr = $_POST['idr'];

    $recetteController = new recettes();

    $recetteController->deleterecette($idr);

    header("Location: tables.php");
    exit;
}
?>
