<?php

use Controller\LivraisonController;

// Inclure le fichier du contrôleur
include '../../../Controller/LivraisonController.php';

// Vérifier si l'ID est bien passé et s'il est valide
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance du contrôleur Livraison
    $livraisonController = new LivraisonController();

    // Appeler la méthode deleteLivraison pour supprimer la livraison
    $livraisonController->deleteLivraison($id);

    // Rediriger après suppression
    header("Location:livraison.php");
    exit; // Toujours appeler exit() après un header de redirection
} else {
    // Si l'ID est invalide ou absent, vous pouvez gérer l'erreur ici
    echo "ID invalide ou manquant.";
    exit;
}
