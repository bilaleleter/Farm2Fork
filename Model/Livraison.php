<?php
namespace Model;

class Livraison {
    public $id_livraison;
    public $codePostal;
    public $ville;
    public $Adresse;
    public $date_d_envoi;
    public $statut_de_livraison;
    public $date_de_livraison;
    public $idUser;
    public function __construct($id_livraison, $ville, $codePostal, $Adresse, $date_d_envoi, $statut_de_livraison, $date_de_livraison) {    
        $this->id_livraison = $id_livraison;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
    
        $this->Adresse = $Adresse;
        $this->date_d_envoi = $date_d_envoi;
        $this->statut_de_livraison = $statut_de_livraison;
        $this->date_de_livraison = $date_de_livraison;
      
    }

}

