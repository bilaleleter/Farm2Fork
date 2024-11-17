<?php
namespace Model;

class Commande {
    public $id_commande;
    public $date_commande;
    public $etat;
    public $id_utilisateur;
    public $quantite;
    public $id_produit;
    public $id_livraison;

    // Constructeur
    public function __construct($id_commande, $date_commande, $etat, $quantite, $id_utilisateur, $id_produit,$id_livraison) {    
        $this->id_commande = $id_commande;
        $this->date_commande = $date_commande;
        $this->etat = $etat;
        $this->quantite = $quantite;
        $this->id_utilisateur = $id_utilisateur;  // Passer id_utilisateur via le constructeur
        $this->id_produit = $id_produit;  // Passer id_produit via le constructeur
        $this->id_livraison = $id_livraison;  
    }
}

