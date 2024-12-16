<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Core\config.php';

class Facture
{
    private ?int $id;
    private ?DateTime $date_facture;
    private ?float $montant;
    private ?int $fournisseur_id;

    public function __construct(?int $id = null, ?DateTime $date_facture = null, ?float $montant = null, ?int $fournisseur_id = null)
    {
        $this->id = $id;
        $this->date_facture = $date_facture;
        $this->montant = $montant;
        $this->fournisseur_id = $fournisseur_id;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getDateFacture(): ?DateTime { return $this->date_facture; }
    public function setDateFacture($date_facture): void
    {
        if (is_string($date_facture)) {
            $this->date_facture = new DateTime($date_facture);
        } elseif ($date_facture instanceof DateTime || $date_facture === null) {
            $this->date_facture = $date_facture;
        } else {
            throw new InvalidArgumentException("Type invalide pour date_facture.");
        }
    }

    public function getMontant(): ?float { return $this->montant; }
    public function setMontant(?float $montant): void { $this->montant = $montant; }

    public function getFournisseurId(): ?int { return $this->fournisseur_id; }
    public function setFournisseurId(?int $fournisseur_id): void { $this->fournisseur_id = $fournisseur_id; }
}

class FactureModel
{
    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }

    public function add(Facture $facture)
    {
        $sql = "INSERT INTO facture (date_facture, montant, fournisseur_id) 
                VALUES (:date_facture, :montant, :fournisseur_id)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'date_facture' => $facture->getDateFacture()->format('Y-m-d'),
            'montant' => $facture->getMontant(),
            'fournisseur_id' => $facture->getFournisseurId(),
        ]);
    }

    public function getAll(): array
    {
        $sql = "SELECT f.*, fr.nom AS fournisseur_nom 
                FROM facture f 
                JOIN fournisseur fr ON f.fournisseur_id = fr.id";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?Facture
    {
        $sql = "SELECT * FROM facture WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Facture(
                $data['id'],
                new DateTime($data['date_facture']),
                $data['montant'],
                $data['fournisseur_id']
            );
        }
        return null;
    }

    public function update(Facture $facture)
    {
        $sql = "UPDATE facture SET 
                    date_facture = :date_facture, 
                    montant = :montant, 
                    fournisseur_id = :fournisseur_id 
                WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'date_facture' => $facture->getDateFacture()->format('Y-m-d'),
            'montant' => $facture->getMontant(),
            'fournisseur_id' => $facture->getFournisseurId(),
            'id' => $facture->getId(),
        ]);
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM facture WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
    }
    public function getAllFactures($sort = 'asc'): array
    {
        $sql = "SELECT f.*, fr.nom AS fournisseur_nom 
                FROM facture f 
                JOIN fournisseur fr ON f.fournisseur_id = fr.id";
    
        // Clause pour trier les factures
        if ($sort === 'desc') {
            $sql .= " ORDER BY f.montant DESC";
        } else {
            $sql .= " ORDER BY f.montant ASC";
        }
    
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
