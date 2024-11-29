<?php
include_once(__DIR__ . '/../config.php');

class ProduitController {
  
    public function listeProduit($id_categorie = null, $searchTerm = '') {
        $sql = "SELECT p.*, c.nom_categorie
                FROM gerer_p p
                LEFT JOIN gerer_categorie c ON p.categorie = c.id_categorie";
        
       
        $conditions = [];
        
      
        if ($id_categorie) {
            $conditions[] = "p.categorie = :id_categorie";
        }
    
      
        if ($searchTerm) {
            $conditions[] = "p.nom_produit LIKE :searchTerm";
        }
    
        
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }
    
       
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            
           
            if ($id_categorie) {
                $query->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);
            }
            if ($searchTerm) {
                $query->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);  
            }
    

            $query->execute();
            

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
  
            error_log("Erreur dans listeProduit : " . $e->getMessage());
            die("Erreur lors de la récupération des produits.");
        }
    }
    
    
    public function getAllCategories() {
        $sql = "SELECT * FROM gerer_categorie";
    
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des catégories : " . $e->getMessage());
            die("Erreur lors de la récupération des catégories.");
        }
    }

    public function ajouterProduit($produit) {
        $sql = "INSERT INTO gerer_p (nom_produit, image_produit, description_produit, prix, quantite_produit, stock_produit, categorie)
        VALUES (:nom_produit, :image_produit, :description_produit, :prix, :quantite_produit, :stock_produit, :categorie)";
        
        $db = config::getConnexion();
        
        try {
            $request = $db->prepare($sql);
            
            $request->execute([
                'nom_produit' => $produit->getNomProduit(),
                'image_produit' => $produit->getImageProduit(),
                'description_produit' => $produit->getDescriptionProduit(),
                'prix' => $produit->getPrix(),
                'quantite_produit' => $produit->getQuantiteProduit(),
                'stock_produit' => $produit->getStockProduit(),
                'categorie' => $produit->getCategorie() 
            ]);
            
          
            header('Location: listeProduit.php');
            exit;
            
        } catch (Exception $e) {
          
            echo "Erreur : " . $e->getMessage();
        }
    }


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
            'categorie' => $produit->getCategorie() 
        ]);
    }

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
