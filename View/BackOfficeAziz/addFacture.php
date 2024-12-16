<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\fournisseurController.php';
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\factureController.php';


$fournisseurController = new FournisseurController();
$factureController = new FactureController();
$fournisseurs = $fournisseurController->getAllFournisseurs();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facture = new Facture(
        null,
        new DateTime($_POST['date_facture']),
        (float) $_POST['montant'],
        (int) $_POST['fournisseur_id']
    );

    $factureController->addFacture($facture);
    header('Location: \Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\gestion_factures.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Facture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Ajouter une Facture</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="date_facture" class="form-label">Date de Facture</label>
            <input type="date" class="form-control" id="date_facture" name="date_facture" required>
        </div>
        <div class="mb-3">
            <label for="montant" class="form-label">Montant</label>
            <input type="number" class="form-control" id="montant" name="montant" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="fournisseur_id" class="form-label">Fournisseur</label>
            <select class="form-control" id="fournisseur_id" name="fournisseur_id" required>
                <?php foreach ($fournisseurs as $fournisseur): ?>
                    <option value="<?= $fournisseur->getId() ?>"><?= $fournisseur->getNom() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="factureListe.php" class="btn btn-secondary">Retour</a>
    </form>
</div>
</body>
</html>
