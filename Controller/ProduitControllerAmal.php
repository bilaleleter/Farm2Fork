<?php   
namespace Controller;
use Config;
use Exception;
use Model\Produit;
include_once __DIR__ . "/../Model/Produit.php";
include_once __DIR__ . "/../Core/config.php";
class ProduitController
{

    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }
    public function getAllProduits(): array
    {
        $req = "SELECT * FROM gerer_p";
        try {
            $query = $this->db->prepare($req);
            $query->execute();
            $produits = $query->fetchAll();
            if ($produits === false) {
                throw new Exception("Aucun produit trouvé.");
            }
            return $produits;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function getProduitbyId(int $id_produit): array
    {
        $req = "SELECT * FROM gerer_p WHERE id_produit = :id_produit";
        try {
            $query = $this->db->prepare($req);
            $query->execute(['id_produit' => $id_produit]);
            $produit = $query->fetch();
            if ($produit === false) {
                throw new Exception("Produit avec l'ID $id_produit introuvable.");
            }
            return $produit;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }	
}