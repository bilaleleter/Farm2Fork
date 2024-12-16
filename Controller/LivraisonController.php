<?php

namespace Controller;

use Config;
use Exception;
use Model\Livraison;

include_once __DIR__ . "/../Model/Livraison.php";
include_once __DIR__ . "/../Core/config.php";
class LivraisonController
{
    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }



    public function getLivraison(int $id_livraison): array
    {
        $req = "SELECT * FROM livraison WHERE id_livraison = :id_livraison";
        try {
            $query = $this->db->prepare($req);
            $query->execute(['id_livraison' => $id_livraison]);
            $livraison = $query->fetch();
            if ($livraison === false) {
                throw new Exception("Livraison avec l'ID $id_livraison introuvable.");
            }
            return $livraison;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function getAllLivraisons(): array
    {
        $req = "SELECT * FROM livraison";
        try {
            $query = $this->db->prepare($req);
            $query->execute();
            $livraisons = $query->fetchAll();
            if ($livraisons === false) {
                throw new Exception("Aucune livraison trouvée.");
            }
            return $livraisons;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function addLivraison(Livraison $livraison): void
    {
        $req = "INSERT INTO livraison (Adresse_de_Livraison, ville, codePostal, idUser, ref_commande)
                VALUES (:Adresse_de_Livraison, :ville, :codePostal, 1, :ref_commande)";
        try {
            // Récupération des commandes sélectionnées depuis le formulaire
            if (isset($_POST['referencesCommandes']) && is_array($_POST['referencesCommandes'])) {
                $referencesCommandes = $_POST['referencesCommandes'];  // Récupérer les références des commandes sélectionnées
            } else {
                $referencesCommandes = [];  // Si aucune commande n'est sélectionnée
            }
    
            // Imploser les références des commandes dans une seule chaîne de caractères
            $refCommandes = implode(', ', $referencesCommandes);
    
            // Exécution de la requête avec les données de la livraison et les références de commandes
            $query = $this->db->prepare($req);
            $query->execute([
                'ville' => $livraison->ville,
                'codePostal' => $livraison->codePostal,
                'Adresse_de_Livraison' => $livraison->Adresse,
                'ref_commande' => $refCommandes, // Ajouter les références des commandes ici
            ]);
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
    public function updateLivraison(Livraison $livraison): void
    {
        // Requête SQL corrigée pour mettre à jour la livraison
        $req = "UPDATE livraison 
            SET ville = :ville, 
                codePostal = :codePostal, 
                Adresse_de_Livraison = :Adresse 
            WHERE ID_livraison = :id_livraison";

        // Connexion à la base de données

        try {
            // Préparer la requête et l'exécuter avec les paramètres
            $query = $this->db->prepare($req);
            $query->execute([
                'ville' => $livraison->ville,
                'codePostal' => $livraison->codePostal,
                'Adresse' => $livraison->Adresse,
                'id_livraison' => $livraison->id_livraison // L'ID de la livraison pour cibler la ligne
            ]);
        } catch (Exception $e) {
            // En cas d'erreur, afficher un message d'erreur
            die("Erreur : " . $e->getMessage());
        }
    }


    public function deleteLivraison(int $id_livraison): void
    {
        $req = "DELETE FROM livraison WHERE id_livraison = :id_livraison";
        try {
            $query = $this->db->prepare($req);
            $query->execute(['id_livraison' => $id_livraison]);
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function getLastInsertId()
    {
        try {
            // lastInsertId() retourne l'ID de la dernière insertion pour cette connexion
            $id = $this->db->lastInsertId();
            if (!$id) {
                throw new Exception("Aucune insertion récente trouvée.");
            }
            return (int)$id; // Forcer la conversion en entier
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}
