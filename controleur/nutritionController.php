<?php
// Include configuration and model
require_once "C:\\xampp\\htdocs\\dashboard\\recettenadine\\config.php";
require_once '../../../model/nutritionModel.php';
class nutritions {
    public function affichenutrition() {
        $sql = "SELECT * FROM nutrition";
        $conn = config::getConnexion();
        try {
            $liste = $conn->query($sql);  
            return $liste;
        } catch (Exception $e) {
            error_log("Error fetching recipes: " . $e->getMessage());
            throw new Exception("Error fetching recipes.");
        }
    }

    public function addNutrition($nutrition) {
        $conn = config::getConnexion();
    
        $sql = "INSERT INTO nutrition (idr, calories, proteines, carbohydrates) 
                VALUES (:idr, :calories, :proteines, :carbohydrates)";
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':idr' => $nutrition->getIdr(),
                ':calories' => $nutrition->getCalories(),
                ':proteines' => $nutrition->getProteines(),
                ':carbohydrates' => $nutrition->getCarbohydrates()
            ]);
            return true; 
        } catch (Exception $e) {
            error_log("Error adding nutrition for recipe ID {$nutrition->getIdr()}: " . $e->getMessage());
            throw new Exception("Error adding the nutrition.");
        }
    }
    
    
    public function deleteNutrition($idProduit) {
        $conn = config::getConnexion();
    
        $sql = "DELETE FROM nutrition WHERE idProduit = :idProduit";
        try {
            $query = $conn->prepare($sql);
            $query->bindValue(':idProduit', $idProduit);
            $query->execute();
            return true; 
        } catch (Exception $e) {
            error_log("Error deleting nutrition with ID $idProduit: " . $e->getMessage());
            throw new Exception("Error deleting the nutrition.");
        }
    }
    
    

    public function updateNutrition($nutrition) {
        $conn = config::getConnexion();
    
        $sql = "UPDATE nutrition SET 
                    calories = :calories, 
                    proteines = :proteines, 
                    carbohydrates = :carbohydrates 
                WHERE idProduit = :idProduit";
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':idProduit' => $nutrition->getIdProduit(),
                ':calories' => $nutrition->getCalories(),
                ':proteines' => $nutrition->getProteines(),
                ':carbohydrates' => $nutrition->getCarbohydrates()
            ]);
            return true; 
        } catch (Exception $e) {
            error_log("Error updating nutrition with ID {$nutrition->getIdProduit()}: " . $e->getMessage());
            throw new Exception("Error updating the nutrition.");
        }
    }
    public function getNutritionByRecetteId($idr) {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM nutrition WHERE idr = :idr";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([':idr' => $idr]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne une seule entrée
        } catch (Exception $e) {
            die("Erreur lors de la récupération des données : " . $e->getMessage());
        }
    }
    
    
}    
