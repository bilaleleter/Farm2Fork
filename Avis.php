<?php
class Avis
{
    private ?int $id = null;
    private ?string $note = null;
    private ?string $type_avis = null;
    private ?DateTime $date_avis = null;
   

   
    public function __construct($id=null,$n,$type_avis,$date_avis)
    {
        $this->id = $id;
        $this->note = $n;
        $this->type_avis = $type_avis;
        $this->date_avis = $date_avis;
       
    }

    
    public function getidE()
    {
        return $this->id;
    }
    public function getnote()
    {
        return $this->note;
    }
    public function gettype_avis()
    {
        return $this->type_avis;
    }
    public function getdate_avis()
    {
        return $this->date_avis;
    }


    public function setidE($id)
    {
        $this->id = $id;

        return $this;
    }
    public function setnote($note)
    {
        $this->note= $note;

        return $this;
    }
    public function settype_avis($type_avis)
    {
        $this->type_avis= $type_avis;

        return $this;
    }public function setdate_avis($date_avis)
    {
        $this->date_avis= $date_avis;

        return $this;
    }
    
    
    
    
    
    
}
?>