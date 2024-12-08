<?php
include_once __DIR__ . '/../config.php';

// Classe Fournisseur (Entité)
class Fournisseur
{
    private ?int $id;
    private ?string $nom;
    private ?string $adresse;
    private ?string $telephone;
    private ?DateTime $dateajout;

    public function __construct(?int $id = null, ?string $nom = null, ?string $adresse = null, ?string $telephone = null, ?DateTime $dateajout = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->dateajout = $dateajout;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(?string $nom): void { $this->nom = $nom; }

    public function getAdresse(): ?string { return $this->adresse; }
    public function setAdresse(?string $adresse): void { $this->adresse = $adresse; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(?string $telephone): void { $this->telephone = $telephone; }

    public function getDateajout(): ?DateTime { return $this->dateajout; }
    public function setDateajout($dateajout): void
    {
        if (is_string($dateajout)) {
            $this->dateajout = new DateTime($dateajout);
        } elseif ($dateajout instanceof DateTime || $dateajout === null) {
            $this->dateajout = $dateajout;
        } else {
            throw new InvalidArgumentException("Invalid date format.");
        }
    }
}

// Classe FournisseurModel (Modèle pour les opérations CRUD)
class FournisseurModel
{
    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }

    public function add(Fournisseur $fournisseur)
    {
        $sql = "INSERT INTO fournisseur (nom, adresse, telephone, dateajout) 
                VALUES (:nom, :adresse, :telephone, :dateajout)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'nom' => $fournisseur->getNom(),
            'adresse' => $fournisseur->getAdresse(),
            'telephone' => $fournisseur->getTelephone(),
            'dateajout' => $fournisseur->getDateajout()->format('Y-m-d'),
        ]);
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM fournisseur";
        $query = $this->db->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $fournisseurs = [];
        foreach ($results as $data) {
            $fournisseurs[] = new Fournisseur(
                $data['id'],
                $data['nom'],
                $data['adresse'],
                $data['telephone'],
                new DateTime($data['dateajout'])
            );
        }
        return $fournisseurs;
    }

    public function getById(int $id): ?Fournisseur
    {
        $sql = "SELECT * FROM fournisseur WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Fournisseur(
                $data['id'],
                $data['nom'],
                $data['adresse'],
                $data['telephone'],
                new DateTime($data['dateajout'])
            );
        }
        return null;
    }

    public function update(Fournisseur $fournisseur)
    {
        $sql = "UPDATE fournisseur SET 
                    nom = :nom, 
                    adresse = :adresse, 
                    telephone = :telephone, 
                    dateajout = :dateajout 
                WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'nom' => $fournisseur->getNom(),
            'adresse' => $fournisseur->getAdresse(),
            'telephone' => $fournisseur->getTelephone(),
            'dateajout' => $fournisseur->getDateajout()->format('Y-m-d'),
            'id' => $fournisseur->getId(),
        ]);
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM fournisseur WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
    }

    public function getFacturesByFournisseur(int $fournisseurId): array
{
    $sql = "SELECT f.* 
            FROM facture f 
            WHERE f.fournisseur_id = :fournisseur_id";
    $query = $this->db->prepare($sql);
    $query->execute(['fournisseur_id' => $fournisseurId]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

}
