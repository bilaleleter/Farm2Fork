<?php
namespace Model;
class Produit{
    public $id_produit;
    public $nom_produit;
    public $prix_produit;
   
    public function __construct($id_produit, $nom_produit, $prix_produit) {    
        $this->id_produit = $id_produit;
        $this->nom_produit = $nom_produit;
        $this->prix_produit = $prix_produit;
   
    }
}