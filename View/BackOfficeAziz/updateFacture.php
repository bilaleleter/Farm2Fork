<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\fournisseurController.php';
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\factureController.php';

$factureController = new FactureController();
$fournisseurController = new FournisseurController();

if (isset($_GET['id'])) {
    $facture = $factureController->getFactureById((int)$_GET['id']);
    $fournisseurs = $fournisseurController->getAllFournisseurs();

    if (!$facture) {
        die('Facture introuvable.');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facture->setDateFacture(new DateTime($_POST['date_facture']));
    $facture->setMontant((float)$_POST['montant']);
    $facture->setFournisseurId((int)$_POST['fournisseur_id']);

    $factureController->updateFacture($facture);

    header('Location: factureListe.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Facture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Modifier une Facture</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="date_facture" class="form-label">Date de Facture</label>
            <input type="date" class="form-control" id="date_facture" name="date_facture" value="<?= $facture->getDateFacture()->format('Y-m-d') ?>" required>
        </div>
        <div class="mb-3">
            <label for="montant" class="form-label">Montant</label>
            <input type="number" class="form-control" id="montant" name="montant" step="0.01" value="<?= $facture->getMontant() ?>" required>
        </div>
        <div class="mb-3">
            <label for="fournisseur_id" class="form-label">Fournisseur</label>
            <select class="form-control" id="fournisseur_id" name="fournisseur_id" required>
                <?php foreach ($fournisseurs as $fournisseur): ?>
                    <option value="<?= $fournisseur->getId() ?>" <?= $facture->getFournisseurId() === $fournisseur->getId() ? 'selected' : '' ?>>
                        <?= $fournisseur->getNom() ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <a href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\gestion_factures.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
