<?php
// Include configuration and model
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Core\config.php';
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Model\nutritionModel.php';
class nutritions {
    private $conn;

    public function __construct()
    {
        $this->conn = config::getConnexion();
    }
    public function affichenutrition() {
        $sql = "SELECT * FROM nutrition";
        try {
            $liste = $this->conn->query($sql);  
            return $liste;
        } catch (Exception $e) {
            error_log("Error fetching recipes: " . $e->getMessage());
            throw new Exception("Error fetching recipes.");
        }
    }

    public function addNutrition($nutrition) {
    
        $sql = "INSERT INTO nutrition (idr, calories, proteines, carbohydrates) 
                VALUES (:idr, :calories, :proteines, :carbohydrates)";
        try {
            $query = $this->conn->prepare($sql);
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
    
        $sql = "DELETE FROM nutrition WHERE idProduit = :idProduit";
        try {
            $query = $this->conn->prepare($sql);
            $query->bindValue(':idProduit', $idProduit);
            $query->execute();
            return true; 
        } catch (Exception $e) {
            error_log("Error deleting nutrition with ID $idProduit: " . $e->getMessage());
            throw new Exception("Error deleting the nutrition.");
        }
    }
    
    

    public function updateNutrition($nutrition) {
    
        $sql = "UPDATE nutrition SET 
                    calories = :calories, 
                    proteines = :proteines, 
                    carbohydrates = :carbohydrates 
                WHERE idProduit = :idProduit";
        try {
            $query = $this->conn->prepare($sql);
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
        $sql = "SELECT * FROM nutrition WHERE idr = :idr";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':idr' => $idr]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne une seule entrée
        } catch (Exception $e) {
            die("Erreur lors de la récupération des données : " . $e->getMessage());
        }
    }
    
    
}    
