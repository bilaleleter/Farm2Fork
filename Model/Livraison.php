<?php
namespace Model;

class Livraison {
    public $id_livraison;
    public $id_commande;
    public $Adresse;
    public $date_d_envoi;
    public $statut_de_livraison;
    public $date_de_livraison;
    public function __construct($id_livraison, $id_commande, $Adresse, $date_d_envoi, $statut_de_livraison, $date_de_livraison) {    
        $this->id_livraison = $id_livraison;
        $this->id_commande = $id_commande;
        $this->Adresse = $Adresse;
        $this->date_d_envoi = $date_d_envoi;
        $this->statut_de_livraison = $statut_de_livraison;
        $this->date_de_livraison = $date_de_livraison;
    }

}

