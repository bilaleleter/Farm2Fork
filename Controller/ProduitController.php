<?php
include_once(__DIR__ . '/../config.php');

class ProduitController {
  
    // Récupérer tous les produits ou filtrer par catégorie
    public function listeProduit($categorieId = null) {
        // Si une catégorie est sélectionnée, filtrer par cette catégorie
        if ($categorieId) {
            $sql = "SELECT p.*, c.nom_categorie
                    FROM gerer_p p
                    LEFT JOIN gerer_categorie c ON p.categorie = c.id_categorie
                    WHERE p.categorie = :categorieId"; // Filtrer par catégorie
        } else {
            // Si aucune catégorie n'est sélectionnée, récupérer tous les produits
            $sql = "SELECT p.*, c.nom_categorie
                    FROM gerer_p p
                    LEFT JOIN gerer_categorie c ON p.categorie = c.id_categorie"; // Récupérer tous les produits
        }

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            if ($categorieId) {
                $query->bindValue(':categorieId', $categorieId, PDO::PARAM_INT); // Bind l'ID de la catégorie si applicable
            }
            $query->execute();
            return $query->fetchAll(); // Retourne tous les produits avec leur catégorie
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Ajouter un produit
    public function ajouterProduit($produit) {
        // Assurez-vous que la requête d'insertion est correcte
        $sql = "INSERT INTO gerer_p (nom_produit, image_produit, description_produit, prix, quantite_produit, stock_produit, categorie)
                VALUES (:nom_produit, :image_produit, :description_produit, :prix, :quantite_produit, :stock_produit, :categorie)";
        
        $db = config::getConnexion();
        
        try {
            // Préparation de la requête
            $request = $db->prepare($sql);
            
            // Exécution de la requête avec les données du produit, y compris la catégorie
            $request->execute([
                'nom_produit' => $produit->getNomProduit(),
                'image_produit' => $produit->getImageProduit(),
                'description_produit' => $produit->getDescriptionProduit(),
                'prix' => $produit->getPrix(),
                'quantite_produit' => $produit->getQuantiteProduit(),
                'stock_produit' => $produit->getStockProduit(),
                'categorie' => $produit->getCategorie()  // Assurez-vous que la catégorie est bien passée
            ]);
            
            // Redirection après ajout
            header('Location: listeProduit.php');
            exit;
            
        } catch (Exception $e) {
            // Afficher l'erreur si l'ajout échoue
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Supprimer un produit
    public function supprimerProduit($id_produit) {
        $sql = "DELETE FROM gerer_p WHERE id_produit = :id_produit";
        $db = config::getConnexion();
        try {
            $request = $db->prepare($sql);
            $request->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
            $request->execute();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Mettre à jour un produit
    function updateProduit($produit, $id_produit) {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE gerer_p SET 
                nom_produit = :nom_produit,
                image_produit = :image_produit,
                description_produit = :description_produit,
                prix = :prix,
                quantite_produit = :quantite_produit,
                stock_produit = :stock_produit,
                categorie = :categorie
            WHERE id_produit = :id_produit'
        );

        $query->execute([
            'id_produit' => $id_produit,
            'nom_produit' => $produit->getNomProduit(),
            'image_produit' => $produit->getImageProduit(),
            'description_produit' => $produit->getDescriptionProduit(),
            'prix' => $produit->getPrix(),
            'quantite_produit' => $produit->getQuantiteProduit(),
            'stock_produit' => $produit->getStockProduit(),
            'categorie' => $produit->getCategorie() // Mise à jour de la catégorie
        ]);
    }

    // Afficher un produit
    function showProduit($id_produit) {
        $sql = "SELECT * FROM gerer_p WHERE id_produit = :id_produit";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
            $query->execute();
            $produit = $query->fetch();
            return $produit;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>
