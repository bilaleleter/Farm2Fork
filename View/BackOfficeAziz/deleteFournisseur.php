<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\fournisseurController.php';
session_start();
if (isset($_GET['id'])) {
    $fournisseurController = new FournisseurController();
    $fournisseurController->deleteFournisseur($_GET['id']);
    $_SESSION['success_message'] = "Fournisseur Supprimé avec succès.";
    header('Location: \Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\gestion_fournisseur.php');
    exit();
} else {
    echo "ID non spécifié.";
}
