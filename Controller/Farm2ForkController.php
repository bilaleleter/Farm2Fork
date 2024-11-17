<?php
include(__DIR__ . '/../config.php');

class Farm2ForkController {
  
  public function listeProduit(){
    $sql="SELECT * FROM gerer_p";
    $db=config::getConnexion();
    try{
      $liste=$db->query($sql);
      return $liste;

    }
    catch(Exception $e){
      echo "Error ".$e->getMessage();
  }
}
public function ajouterProduit($produit) {
  $sql = "INSERT INTO gerer_p (nom_produit, image_produit, description_produit, prix, quantite_produit, stock_produit) 
          VALUES (:nom_produit, :image_produit, :description_produit, :prix, :quantite_produit, :stock_produit)";
  $db = config::getConnexion();

  try {
      $request = $db->prepare($sql);
      $request->execute([
          "nom_produit" => $produit->getNomProduit(),
          "image_produit" => $produit->getImageProduit(),
          "description_produit" => $produit->getDescriptionProduit(),
          "prix" => $produit->getPrix(),
          "quantite_produit" => $produit->getQuantiteProduit(),
          "stock_produit" => $produit->getStockProduit(),
      ]);
      header('Location: listeProduit.php');  
      exit;  
  } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
  }
}


    public function supprimerProduit($id_produit) {
      $sql = "DELETE FROM gerer_p WHERE id_produit = :id_produit";
      $db = config::getConnexion();
      
      try {
          $request = $db->prepare($sql);
          $request->bindValue(':id_produit', $id_produit);
          $request->execute();
      } catch (Exception $e) {
          echo "Error: " . $e->getMessage();
      }
  }
  
  function updateProduit($produit, $id_produit) {
    $db = config::getConnexion();
    $query = $db->prepare(
        'UPDATE gerer_p SET 
            nom_produit = :nom_produit,
            image_produit = :image_produit,
            description_produit = :description_produit,
            prix = :prix,
            quantite_produit = :quantite_produit,
            stock_produit = :stock_produit
        WHERE id_produit = :id_produit'
    );

    $query->execute([
        'id_produit' => $id_produit,
        'nom_produit' => $produit->getNomProduit(),
        'image_produit' => $produit->getImageProduit(), 
        'description_produit' => $produit->getDescriptionProduit(),
        'prix' => $produit->getPrix(),
        'quantite_produit' => $produit->getQuantiteProduit(),
        'stock_produit' => $produit->getStockProduit()
    ]);
}
  
    
    function showProduit($id_produit)
        {
            $sql = "SELECT * from gerer_p where id_produit = $id_produit";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->execute();
    
                $produit = $query->fetch();
                return $produit;
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }
    }



?>
