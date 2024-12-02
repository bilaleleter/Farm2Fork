<?php
// Inclure le contrôleur
include_once __DIR__ . "/../../../Controller/CommandeController.php";

$commandeController = new Controller\CommandeController();

// Vérifier si l'ID de la commande est passé dans l'URL
if (isset($_GET['id_commande']) && is_numeric($_GET['id_commande'])) {
    // Récupérer l'ID de la commande
    $id_commande = (int)$_GET['id_commande'];

    // Appeler la méthode de suppression
    $commandeController->deleteCommande($id_commande);
    
    // Rediriger vers la page précédente après la suppression
    header("Location: " . $_SERVER['HTTP_REFERER']); // Redirige vers la page précédente
    exit(); // Arrêter l'exécution du script
} else {
    // Si l'ID est invalide ou manquant, rediriger vers la page de liste
    header("Location: index.php"); // Remplacez par l'URL correcte
    exit();
}
?>
