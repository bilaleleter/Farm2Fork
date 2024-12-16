<?php
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeAziz\fpdf\fpdf.php';
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\fournisseurController.php';
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\factureController.php';

// Récupérer les données de la facture
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de facture manquant');
}

$factureController = new FactureController();
$fournisseurController = new FournisseurController();

$factureId = (int)$_GET['id'];
$facture = $factureController->getFactureById($factureId);

if (!$facture) {
    die('Facture introuvable');
}

$fournisseur = $fournisseurController->getFournisseurById($facture->getFournisseurId());

//generer pdf de facture 
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Facture', 0, 1, 'C');
$pdf->Ln(10);

// Informations sur la facture
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'ID Facture :', 0, 0);
$pdf->Cell(50, 10, $facture->getId(), 0, 1);

$pdf->Cell(50, 10, 'Date :', 0, 0);
$pdf->Cell(50, 10, $facture->getDateFacture()->format('Y-m-d'), 0, 1);

$pdf->Cell(50, 10, 'Montant :', 0, 0);
$pdf->Cell(50, 10, number_format($facture->getMontant(), 2) . ' EUR', 0, 1);
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Fournisseur', 0, 1);
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Nom :', 0, 0);
$pdf->Cell(50, 10, $fournisseur->getNom(), 0, 1);

$pdf->Ln(20);
$pdf->Cell(0, 10, 'Merci pour votre collaboration.', 0, 1, 'C');

// Générer et afficher le PDF
$pdf->Output('I', 'facture_' . $facture->getId() . '.pdf');
?>
