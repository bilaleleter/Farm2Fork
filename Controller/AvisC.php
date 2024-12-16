<?php
include_once(__DIR__ . '/../Core/config.php');

class AvisC
{

    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }
    public function afficher()
    {
        $sql = "SELECT * FROM avis";
        try {
            $liste = $this->db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
        
    }

    public function deleteAvis($id){
        try{
            $req = $this->db->prepare('
                DELETE FROM avis where id=:id
            ');
            $req->execute([
               'id'=>$id
            ]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function addAvis($Avis)
    {
        $sql = "INSERT INTO avis
        VALUES (null, :note,:type_avis, :date_avis)";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
               
                'note' => $Avis->getnote(),
                'type_avis' => $Avis->gettype_avis(),
                'date_avis' => $Avis->getdate_avis()->format('Y/m/d'),
                
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
function updateAvis($Avis, $id)
{
    try {
        $query = $this->db->prepare(
            'UPDATE Avis SET 
                note = :note, 
                type_avis = :type_avis, 
                date_avis = :date_avis 
            WHERE id= :id'
        );
        $query->execute([
            'id'=>$id,
            'note' => $Avis->getnote(),
            'type_avis' => $Avis->gettype_avis(),
            'date_avis' => $Avis->getdate_avis()->format('Y/m/d')
            
        ]);
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        $e->getMessage();
    }
}
public function getAvisById($id)
{

    try{
        $query = $this->db->prepare("SELECT * FROM Avis WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getAvis($id)
{
    try{
        $req = $this->db->prepare('
           SELECT * FROM Avis  WHERE id =:id
        ');
        $req->execute([
            'id' =>$id
          
        ]);
        return $req->fetch();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

  }




    


   




   

    
}

?>