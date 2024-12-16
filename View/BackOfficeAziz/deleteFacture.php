<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\factureController.php';
session_start();
if (isset($_GET['id'])) {
    $factureController = new FactureController();
    $factureController->deleteFacture((int)$_GET['id']);
    $_SESSION['success_message'] = "Fournisseur ajouté avec succès.";
    header('Location: \Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\gestion_factures.php');
    exit();
} else {
    echo "ID manquant pour la suppression.";
}
