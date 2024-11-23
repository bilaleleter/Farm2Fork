<?php
require_once(__DIR__ . '/../config.php');

class CategorieController {
  
 public function afficheProduit($id_categorie) {
try {
    $pdo=config::getConnexion();
    $query = $pdo->prepare("SELECT * FROM gerer_p WHERE categorie = :id");
    $query->execute(['id' => $id_categorie]);
    return $query->fetchAll();
  } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }



  public function afficheCategorie(){
    try{
    $pdo=config::getConnexion();
    $query = $pdo->prepare("SELECT * FROM gerer_categorie");
    $query->execute();
    return $query->fetchAll();
    }catch(Exception $e){
      echo $e->getMessage();
  }
}

 
}

?>
