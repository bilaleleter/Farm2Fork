<?php

class Commande {
    public $id_commande;
    public $date_commande;
    public $etat;

    public function __construct($id_commande, $date_commande, $etat) {
        $this->id_commande = $id_commande;
        $this->date_commande = $date_commande;
        $this->etat = $etat;
    }
}
