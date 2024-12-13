<?php
class Commentaire
{
    private ?int $id;
    private string $contenu;
    private DateTime $datec;
    private int $idAvis;
    private ?int $likee = null;
    private ?int $dislike = null;

    public function __construct(?int $id, string $contenu, DateTime $datec, int $idAvis, $likee = 0, $dislike = 0)
    {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->datec = $datec;
        $this->idAvis = $idAvis;
        $this->likee = $likee;
        $this->dislike = $dislike;
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

    public function getLike(): ?int
    {
        return $this->likee;
    }

    public function getDislike(): ?int
    {
        return $this->dislike;
    }

    public function setLike(?int $like): void
    {
        $this->like = $likee;
    }

    public function setDislike(?int $dislike): void
    {
        $this->dislike = $dislike;
    }
}
?>
