<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Model\facture.php';

class FactureController
{
    private $model;

    public function __construct()
    {
        $this->model = new FactureModel();
    }

    public function addFacture(Facture $facture)
    {
        $this->model->add($facture);
    }

    public function getAllFactures(): array
    {
        return $this->model->getAll();
    }

    public function getFactureById(int $id): ?Facture
    {
        return $this->model->getById($id);
    }

    public function updateFacture(Facture $facture)
    {
        $this->model->update($facture);
    }

    public function deleteFacture(int $id)
    {
        $this->model->delete($id);
    }
    public function getAllFacturesTrier($order = 'asc'): array
    {
        return $this->model->getAllFactures($order);
    }
    
}
