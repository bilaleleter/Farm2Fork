<?php	
namespace Controller;
use Config;
use Exception;
use Model\Livraison;
include_once __DIR__ . "/../Model/Livraison.php";
include_once __DIR__ . "/../Config.php";
class LivraisonController
{
    public function getLivraison(int $id_livraison): array
    {
        $req = "SELECT * FROM livraison WHERE id_livraison = :id_livraison";
        $db = Config::getConnection();
        try {
            $query = $db->prepare($req);
            $query->execute(['id_livraison' => $id_livraison]);
            $livraison = $query->fetch();
            if ($livraison === false) {
                throw new Exception("Livraison avec l'ID $id_livraison introuvable.");
            }
            return $livraison;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function getAllLivraisons(): array
    {
        $req = "SELECT * FROM livraison";
        $db = Config::getConnection();
        try {
            $query = $db->prepare($req);
            $query->execute();
            $livraisons = $query->fetchAll();
            if ($livraisons === false) {
                throw new Exception("Aucune livraison trouvée.");
            }
            return $livraisons;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function addLivraison(Livraison $livraison): void
    {
        $req = "INSERT INTO livraison ( Adresse_de_Livraison, ville,codePostal, date_d_envoi, statut_de_livraison, Date_de_livraison_Estimee,idUser)
        VALUES ( :Adresse_de_Livraison, :ville, :codePostal, :date_d_envoi, :statut_de_livraison, :Date_de_livraison_Estimee,1)";
        $db = Config::getConnection();
        try {
            $query = $db->prepare($req);
            $query->execute([
              
                'ville' => $livraison->ville,
                'codePostal' => $livraison->codePostal,
                'Adresse_de_Livraison' => $livraison->Adresse,
                'date_d_envoi' => $livraison->date_d_envoi,
                'statut_de_livraison' => $livraison->statut_de_livraison,
                'Date_de_livraison_Estimee' => $livraison->date_de_livraison,
            ]);
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function updateLivraison(Livraison $livraison): void
    {
        $req = "UPDATE livraison SET id_commande = :id_commande,ville = :ville,codePostal = :codePostal, Adresse = :Adresse, date_d_envoi = :date_d_envoi, statut_de_livraison = :statut_de_livraison, date_de_livraison = :date_de_livraison WHERE id_livraison = :id_livraison";
        $db = Config::getConnection();
        try {
            $query = $db->prepare($req);
            $query->execute([
                'id_commande' => $livraison->id_commande,
                'ville' => $livraison->ville,
                'codePostal' => $livraison->codePostal,
                'Adresse' => $livraison->Adresse,
                'date_d_envoi' => $livraison->date_d_envoi,
                'statut_de_livraison' => $livraison->statut_de_livraison,
                'date_de_livraison' => $livraison->date_de_livraison,
                'id_livraison' => $livraison->id_livraison,
            ]);
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function deleteLivraison(int $id_livraison): void
    {
        $req = "DELETE FROM livraison WHERE id_livraison = :id_livraison";
        $db = Config::getConnection();
        try {
            $query = $db->prepare($req);
            $query->execute(['id_livraison' => $id_livraison]);
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function getLastInsertId()
{
    $db = Config::getConnection();
    try {
        // lastInsertId() retourne l'ID de la dernière insertion pour cette connexion
        $id = $db->lastInsertId();
        if (!$id) {
            throw new Exception("Aucune insertion récente trouvée.");
        }
        return (int)$id; // Forcer la conversion en entier
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}

}
?>
    