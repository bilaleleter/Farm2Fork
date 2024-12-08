<?php

class Nutrition {
    private $idProduit;    // Identifiant unique de la nutrition
    private $idr;          // Clé étrangère liée à la table recette
    private $calories;
    private $proteines;
    private $carbohydrates;

    public function __construct($idProduit, $idr, $calories, $proteines, $carbohydrates) {
        $this->idProduit = $idProduit;
        $this->idr = $idr;
        $this->calories = $calories;
        $this->proteines = $proteines;
        $this->carbohydrates = $carbohydrates;
    }

    // Getters et Setters pour idProduit
    public function getIdProduit() {
        return $this->idProduit;
    }

    public function setIdProduit($idProduit) {
        $this->idProduit = $idProduit;
        return $this;
    }

    // Getters et Setters pour idr
    public function getIdr() {
        return $this->idr;
    }

    public function setIdr($idr) {
        $this->idr = $idr;
        return $this;
    }

    // Getters et Setters pour calories
    public function getCalories() {
        return $this->calories;
    }

    public function setCalories($calories) {
        $this->calories = $calories;
        return $this;
    }

    // Getters et Setters pour proteines
    public function getProteines() {
        return $this->proteines;
    }

    public function setProteines($proteines) {
        $this->proteines = $proteines;
        return $this;
    }

    // Getters et Setters pour carbohydrates
    public function getCarbohydrates() {
        return $this->carbohydrates;
    }

    public function setCarbohydrates($carbohydrates) {
        $this->carbohydrates = $carbohydrates;
        return $this;
    }
}
?>
