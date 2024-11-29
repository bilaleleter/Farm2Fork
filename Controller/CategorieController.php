<?php
include_once(__DIR__ . '/../config.php');
include_once(__DIR__ . '/../Model/Categorie.php');
class CategorieController {

    public function ajouterCategorie($categorie) {
        $sql = "INSERT INTO gerer_categorie (nom_categorie) VALUES (:nom_categorie)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':nom_categorie', $categorie->getNomCategorie());
            $query->execute();
        } catch (Exception $e) {
            die("Erreur lors de l'ajout de la catégorie : " . $e->getMessage());
        }
    }

    public function supprimerCategorie($id_categorie) {
        $sql = "DELETE FROM gerer_categorie WHERE id_categorie = :id_categorie";
        $db = config::getConnexion();
        try {
            $request = $db->prepare($sql);
            $request->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);
            $request->execute();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    function updateCategorie($categorie,$id_categorie) {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE gerer_categorie SET 
                nom_categorie = :nom_categorie
            WHERE id_categorie = :id_categorie'
        );
     $query->execute([
            'id_categorie' => $id_categorie,
            'nom_categorie' => $categorie->getNomCategorie()
              ]);
    }

    public function afficherCategories() {
        $sql = "SELECT * FROM gerer_categorie";
        $pdo = config::getConnexion();
        try {
            $query = $pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(); 
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function showCategorie($id_categorie) {
        $sql = "SELECT * FROM gerer_categorie WHERE id_categorie = :id_categorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die("Erreur lors de la récupération de la catégorie : " . $e->getMessage());
        }
    }
    
}
?>
