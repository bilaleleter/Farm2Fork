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

    public function addCommande(Commande $commande): void
    {
        $req = "INSERT INTO commande (date_commande, etat, id_utilisateur, quantite, id_produit)
        VALUES (:date_commande, :etat, :id_utilisateur, :quantite, :id_produit)";
        $db = Config::getConnection();

        try {
            $query = $db->prepare($req);
            $query->execute([
                'date_commande' => $commande->date_commande,
                'etat' => $commande->etat,
                'id_utilisateur' => $commande->id_utilisateur,
                'quantite' => $commande->quantite,
                'id_produit' => $commande->id_produit,
            ]);
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
