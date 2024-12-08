<?php
include_once __DIR__ . '/../model/fournisseur.php';

class FournisseurController
{
    private $model;

    public function __construct()
    {
        $this->model = new FournisseurModel();
    }

    public function addFournisseur(Fournisseur $fournisseur)
    {
        $this->model->add($fournisseur);
    }

    public function getAllFournisseurs(): array
    {
        return $this->model->getAll();
    }

    public function getFournisseurById(int $id): ?Fournisseur
    {
        return $this->model->getById($id);
    }

    public function updateFournisseur(Fournisseur $fournisseur)
    {
        $this->model->update($fournisseur);
    }

    public function deleteFournisseur(int $id)
    {
        $this->model->delete($id);
    }

    public function getFacturesByFournisseur(int $fournisseurId): array
    {
        return $this->model->getFacturesByFournisseur($fournisseurId);
    }

}
