<?php

class Commentaire
{
    private ?int $id; 
    private string $contenu; 
    private DateTime $datec; 
    private int $idAvis; 

   
    public function __construct(?int $id, string $contenu, DateTime $datec, int $idAvis)
    {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->datec = $datec;
        $this->idAvis = $idAvis;
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): void
    {
        $this->contenu = $contenu;
    }

    public function getDate(): DateTime
    {
        return $this->datec;
    }

    public function setDate(DateTime $datec): void
    {
        $this->datec = $datec;
    }

    public function getIdAvis(): int
    {
        return $this->idAvis;
    }

    public function setIdAvis(int $idAvis): void
    {
        $this->idAvis = $idAvis;
    }
}

?>
