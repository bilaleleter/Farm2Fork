<?php

class Produit {
    private $id_produit;
    private $nom_produit;
    private $image_produit;
    private $description_produit;
    private $prix;
    private $quantite_produit;
    private $stock_produit;
    private $categorie; // ID de la catégorie

    public function __construct($id_produit, $nom_produit, $image_produit, $description_produit, $prix, $quantite_produit, $stock_produit, $categorie = null) {
        $this->id_produit = $id_produit;
        $this->nom_produit = $nom_produit;
        $this->image_produit = $image_produit;
        $this->description_produit = $description_produit;
        $this->prix = $prix;
        $this->quantite_produit = $quantite_produit;
        $this->stock_produit = $stock_produit;
        $this->categorie = $categorie; // Assignation de l'ID de la catégorie
    }
    public function getIdProduit() {
        return $this->id_produit;
    }

    public function getNomProduit() {
        return $this->nom_produit;
    }

    public function getImageProduit() {
        return $this->image_produit;
    }

    public function getDescriptionProduit() {
        return $this->description_produit;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getQuantiteProduit() {
        return $this->quantite_produit;
    }

    public function getStockProduit() {
        return $this->stock_produit;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function setNomProduit($nom_produit) {
        $this->nom_produit = $nom_produit;
    }

    public function setImageProduit($image_produit) {
        $this->image_produit = $image_produit;
    }

    public function setDescriptionProduit($description_produit) {
        $this->description_produit = $description_produit;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function setQuantiteProduit($quantite_produit) {
        $this->quantite_produit = $quantite_produit;
    }

    public function setStockProduit($stock_produit) {
        $this->stock_produit = $stock_produit;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    
}

?>
