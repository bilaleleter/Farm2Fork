<?php

// Inclure les fichiers nécessaires
include_once '../../../Controller/CommandeController.php';

use Controller\CommandeController;

// Vérifier si l'ID de la commande est passé via GET
if (isset($_GET['id_commande'])) {
    $id_commande = (int)$_GET['id_commande']; // Cast de sécurité
    $commandeController = new CommandeController();

    try {
        // Appeler la méthode de suppression
        $commandeController->deleteCommande($id_commande);

        // Ajouter un message de succès dans l'URL
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?message=supprime");
        exit;
    } catch (Exception $e) {
        // Ajouter un message d'erreur dans l'URL
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?message=erreur");
        exit;
    }
} else {
    // Ajouter un message d'erreur si aucun ID n'est fourni
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?message=erreur_id");
    exit;
}
