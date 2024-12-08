<?php
include_once '../../controller/factureController.php';
session_start();
if (isset($_GET['id'])) {
    $factureController = new FactureController();
    $factureController->deleteFacture((int)$_GET['id']);
    $_SESSION['success_message'] = "Fournisseur ajouté avec succès.";
    header('Location: factureListe.php');
    exit();
} else {
    echo "ID manquant pour la suppression.";
}
