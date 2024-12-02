<?php
namespace Model;

class Livraison
{
    public $id_livraison;
    public $codePostal;
    public $ville;
    public $Adresse;
    public $idUser;

    public function __construct($id_livraison, $ville, $codePostal, $Adresse)
    {
        $this->id_livraison = $id_livraison;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
        $this->Adresse = $Adresse;
       
    }
}
?>