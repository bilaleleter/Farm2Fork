<?php
declare(strict_types=1);

include_once __DIR__ . "/CommandeController.php";
include_once __DIR__ . "/../Model/Commande.php";
include_once __DIR__ . "/../Config.php";

use Controller\CommandeController;
use Model\Commande;

try {
    $commandeController = new CommandeController();

    // Créer une commande fictive
    $newCommande = new Commande(
        0,                      // id_commande (sera généré automatiquement par la base de données)
        date('Y-m-d H:i:s'),    // date_commande
        'en attente',           // etat
        7,                      // quantite
        1,                      // id_utilisateur
        1                       // id_produit
    );
    

    echo "Ajout de la commande...<br>";
    $commandeController->addCommande($newCommande);
    echo "Commande ajoutée avec succès.<br>";

    // Tester la récupération d'une commande
    $id_commande = 1; // Remplacez par un ID valide dans votre base de données
    echo "Récupération de la commande avec l'ID $id_commande...<br>";
    $commande = $commandeController->getCommande(6);

    echo "Commande récupérée : <br>";
    echo "<pre>" . print_r($commande, true) . "</pre>";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
