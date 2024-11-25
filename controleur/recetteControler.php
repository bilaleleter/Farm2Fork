<?php
// Include configuration and model
require_once "C:\\xampp\\htdocs\\dashboard\\recettenadine\\config.php";
require_once "C:\\xampp\\htdocs\\dashboard\\recettenadine\\model\\recetteModel.php";

class recettes {
    // Fetch all recipes
    public function afficherecette() {
        $sql = "SELECT * FROM recette";
        $conn = config::getConnexion();
        try {
            $liste = $conn->query($sql);  
            return $liste;
        } catch (Exception $e) {
            // Log the error and rethrow it for handling
            error_log("Error fetching recipes: " . $e->getMessage());
            throw new Exception("Error fetching recipes.");
        }
    }

    // Add a new recipe
    public function addrecette($recette) {
        $conn = config::getConnexion();

        $sql = "INSERT INTO recette (idr, nomr, descriptionr, tempsr, difficulte) 
                VALUES (:idr, :nomr, :descriptionr, :tempsr, :difficulte)";
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':idr' => $recette->getIdr(),
                ':nomr' => $recette->getNomr(),
                ':descriptionr' => $recette->getDescriptionr(),
                ':tempsr' => $recette->getTempsr(),
                ':difficulte' => $recette->getDifficulte()
            ]);
            return true; 
        } catch (Exception $e) {
            // Log the error and rethrow it
            error_log("Error adding recipe: " . $e->getMessage());
            throw new Exception("Error adding the recipe.");
        }
    }

    // Delete a recipe by ID
    public function deleterecette($idr) {
        $sql = "DELETE FROM recette WHERE idr = :idr";
        $conn = config::getConnexion();
        try {
            $req = $conn->prepare($sql);
            $req->bindValue(':idr', $idr);
            $req->execute();
        } catch (Exception $e) {
            // Log the error and rethrow it
            error_log("Error deleting recipe with ID $idr: " . $e->getMessage());
            throw new Exception("Error deleting the recipe.");
        }
    }

    // Update an existing recipe
    public function updaterecette($recette, $idr) {
        $sql = "UPDATE recette SET 
                nomr = :nomr, 
                descriptionr = :descriptionr,
                tempsr = :tempsr,
                difficulte = :difficulte
                WHERE idr = :idr";
    
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->bindValue(':idr', $idr);
            $query->bindValue(':nomr', $recette->getNomr());
            $query->bindValue(':descriptionr', $recette->getDescriptionr());
            $query->bindValue(':tempsr', $recette->getTempsr());
            $query->bindValue(':difficulte', $recette->getDifficulte());
            $query->execute();
        } catch (PDOException $e) {
            // Log the error and rethrow it
            error_log("Error updating recipe with ID $idr: " . $e->getMessage());
            throw new Exception("Error updating the recipe.");
        }
    }
}
?>
