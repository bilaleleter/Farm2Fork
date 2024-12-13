<?php
require '../config.php';

class CommentaireC
{
    public function afficherCommentaires()
    {
        $sql = "SELECT * FROM commentaire";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteCommentaire($id)
    {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('DELETE FROM commentaire WHERE id=:id');
            $req->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addCommentaire($Commentaire)
{
    $sql = "INSERT INTO commentaire (contenu, datec, idAvis, likee, dislike) VALUES (:contenu, :datec, :idAvis, :likee, :dislike)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'contenu' => $Commentaire->getContenu(),
            'datec' => $Commentaire->getDate()->format('Y/m/d'),
            'idAvis' => $Commentaire->getIdAvis(),
            'likee' => $Commentaire->getLike() ?? 0, // Assurez-vous qu'il y a une valeur
            'dislike' => $Commentaire->getDislike() ?? 0 // Assurez-vous qu'il y a une valeur
        ]);
        
        echo "Commentaire ajouté avec succès."; // Débogage
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage(); // Affiche l'erreur si l'insertion échoue
    }
}


    function updateCommentaire($Commentaire, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE commentaire SET
                    contenu = :contenu,
                    datec = :datec,
                    idAvis = :idAvis,
                    likee = likee + :like,
                    dislike = dislike + :dislike
                WHERE id= :id'
            );
            $query->execute([
                'id' => $id,
                'contenu' => $Commentaire->getContenu(),
                'datec' => $Commentaire->getDate()->format('Y/m/d'),
                'idAvis' => $Commentaire->getIdAvis(),
                'likee' => $Commentaire->getLike(),
                'dislike' => $Commentaire->getDislike()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function getCommentaire($id)
    {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("SELECT * FROM commentaire WHERE id = :id");
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function likeDislikeCommentaire($id, $action)
    {
        $db = config::getConnexion();
        try {
            $query = $db->prepare(
                'UPDATE commentaire SET
                    ' . $action . ' = ' . $action . ' + 1
                WHERE id = :id'
            );
            $query->execute(['id' => $id]);
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>