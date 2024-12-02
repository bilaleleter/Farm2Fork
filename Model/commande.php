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
    public $ref_commande;  // Ajout de la propriété pour la référence


    // Constructeur
    public function __construct($id_commande, $date_commande, $etat, $quantite, $id_utilisateur, $id_produit,$id_livraison, $ref_commande = null) {    
        $this->id_commande = $id_commande;
        $this->date_commande = $date_commande;
        $this->etat = $etat;
        $this->quantite = $quantite;
        $this->id_utilisateur = $id_utilisateur;  // Passer id_utilisateur via le constructeur
        $this->id_produit = $id_produit;  // Passer id_produit via le constructeur
        $this->id_livraison = $id_livraison;  
        $this->ref_commande = $ref_commande;  // Optionnel, sera généré après l'insertion
    }
    // Méthode pour générer la référence de la commande
    public function generateRefCommande(): string
    {
        return 'REF' . str_pad($this->id_commande, 4, '0', STR_PAD_LEFT);
    }
}


