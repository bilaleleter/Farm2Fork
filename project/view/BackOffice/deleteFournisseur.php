<?php
include '../../controller/fournisseurController.php';
session_start();
if (isset($_GET['id'])) {
    $fournisseurController = new FournisseurController();
    $fournisseurController->deleteFournisseur($_GET['id']);
    $_SESSION['success_message'] = "Fournisseur Supprimé avec succès.";
    header('Location: fournisseurListe.php');
    exit();
} else {
    echo "ID non spécifié.";
}
