<?php

declare(strict_types=1);

namespace Controller;

use Config;
use Exception;
use Model\Commande;  // Importer la classe Commande du namespace Model

include_once __DIR__ . "/../Model/Commande.php";
include_once __DIR__ . "/../Config.php";

class CommandeController
{
    public function getCommande(int $id_commande): array
    {
        $req = "SELECT * FROM commande WHERE id_commande = :id_commande";
        $db = Config::getConnection();

        try {
            $query = $db->prepare($req);
            $query->execute(['id_commande' => $id_commande]);
            $commande = $query->fetch();

            if ($commande === false) {
                throw new Exception("Commande avec l'ID $id_commande introuvable.");
            }

            return $commande;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function getAllCommands(): array
    {
        $req = "SELECT * FROM commande";
        $db = Config::getConnection();

        try {
            $query = $db->prepare($req);
            $query->execute();
            $commandes = $query->fetchAll();

            if ($commandes === false) {
                throw new Exception("Aucune commande trouvée.");
            }

            return $commandes;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function getCommandesNotdilvered(): array
    {
        $req = "SELECT * FROM commande WHERE etat = 'en attente'";
        $db = Config::getConnection();

        try {
            $query = $db->prepare($req);
            $query->execute();
            $commandes = $query->fetchAll();

            if ($commandes === false) {
                throw new Exception("Aucune commande trouvée.");
            }

            return $commandes;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function addCommande(Commande $commande): void
{
    // Étape 1 : Insérer la commande sans la référence
    $req = "INSERT INTO commande (date_commande, etat, id_utilisateur, quantite, id_produit, idLivraison, ref_commande)
            VALUES (:date_commande, :etat, :id_utilisateur, :quantite, :id_produit, null, null)";
    $db = Config::getConnection();

    try {
        // Insertion de la commande sans la référence
        $query = $db->prepare($req);
        $query->execute([
            'date_commande' => $commande->date_commande,
            'etat' => $commande->etat,
            'id_utilisateur' => $commande->id_utilisateur,
            'quantite' => $commande->quantite,
            'id_produit' => $commande->id_produit
        ]);
        
        // Récupérer l'ID de la commande nouvellement insérée
        $idCommande = $db->lastInsertId();

        // Étape 2 : Générer la référence de la commande
        $commande->id_commande = $idCommande;  // Mettre à jour l'ID de la commande dans l'objet
        $refCommande = $commande->generateRefCommande();  // Générer la référence

        // Étape 3 : Mettre à jour la commande avec la référence générée
        $updateReq = "UPDATE commande SET ref_commande = :ref_commande WHERE id_commande = :id_commande";
        $updateQuery = $db->prepare($updateReq);
        $updateQuery->execute([
            'ref_commande' => $refCommande,
            'id_commande' => $idCommande
        ]);
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}

    public function livrerCommandes(int $id_livraison): void
    {
        $req = "UPDATE commande SET etat = 'livrée', idLivraison = :id_livraison WHERE etat = 'en attente'";
        $db = Config::getConnection();

        try {
            $query = $db->prepare($req);
            $query->execute(['id_livraison' => $id_livraison]);
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
        
    public function updateCommande(Commande $commande): void
    {
        $req = "UPDATE commande SET date_commande = :date_commande, etat = :etat, id_utilisateur = :id_utilisateur, quantite = :quantite WHERE id_commande = :id_commande";

        $db = Config::getConnection();

        try {
            $query = $db->prepare($req);
            $query->execute([
                'id_commande' => $commande->id_commande,
                'date_commande' => $commande->date_commande,
                'etat' => $commande->etat,
                'id_utilisateur' => $commande->id_utilisateur,
                'quantite' => $commande->quantite,
            ]);
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function deleteCommande(int $id_commande): void
    {
        $req = "DELETE FROM commande WHERE id_commande = :id_commande";
        $db = Config::getConnection();

        try {
            $query = $db->prepare($req);
            $query->execute(['id_commande' => $id_commande]);
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}
