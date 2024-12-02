<?php
require '../config.php';


class CommentaireC
{ 
    public function afficherCommentaires()
    {
        $sql = "SELECT c.id, c.contenu, c.datec AS date_commentaire, c.idAvis, a.date_avis AS date_avis 
        FROM Commentaire c
        JOIN Avis a ON c.idAvis = a.id";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function deleteCommentaire($id){
        $db = config::getConnexion();
        try{
            $req = $db->prepare('
                DELETE FROM commentaire where id=:id
            ');
            $req->execute([
               'id'=>$id
            ]);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    function addC($com)
    {
        
        $sql = "INSERT INTO commentaire
        VALUES (null, :contenu,:datec, :idAvis)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
               
                'contenu' => $com->getContenu(),
                'datec' => $com->getDate()->format('Y/m/d'),
                'idAvis'=>$com->getIdAvis()
               
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateC($com, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE commentaire SET 
                    contenu = :contenu, 
                    datec = :datec, 
                    idAvis = :idAvis 
                    
                WHERE id= :id'
            );
            $query->execute([
                'id'=>$id,
                'contenu' => $com->getContenu(),
                'datec' => $com->getDate()->format('Y/m/d'),
                'idAvis'=>$com->getIdAvis()
                
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function getCommentaire($id){
        $db = config::getConnexion();
        try{
            $req = $db->prepare('
               SELECT * FROM commentaire  WHERE id =:id
            ');
            $req->execute([
                'id' =>$id
              
            ]);
            return $req->fetch();
        }  catch (PDOException $e) {
            $e->getMessage();
        }
      }

}