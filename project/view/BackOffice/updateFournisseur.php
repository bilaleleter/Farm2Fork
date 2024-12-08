<?php
include '../../controller/fournisseurController.php';

$fournisseurController = new FournisseurController();
$fournisseur = null;

// Récupération des données du fournisseur pour pré-remplir le formulaire
if (isset($_GET['id'])) {
    $fournisseur = $fournisseurController->getFournisseurById($_GET['id']);
}

// Traitement de la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedFournisseur = new Fournisseur(
        $_POST['id'], 
        $_POST['nom'], 
        $_POST['adresse'], 
        $_POST['telephone'], 
        new DateTime($_POST['dateajout'])
    );

    $fournisseurController->updateFournisseur($updatedFournisseur);
    header('Location: fournisseurListe.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Fournisseur</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Modifier le Fournisseur</h1>
    <?php if ($fournisseur): ?>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= htmlspecialchars($fournisseur->getId()) ?>">

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($fournisseur->getNom()) ?>" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?= htmlspecialchars($fournisseur->getAdresse()) ?>" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($fournisseur->getTelephone()) ?>" required>
            </div>
            <div class="mb-3">
                <label for="dateajout" class="form-label">Date d'Ajout</label>
                <input type="date" class="form-control" id="dateajout" name="dateajout" value="<?= htmlspecialchars($fournisseur->getDateajout()->format('Y-m-d')) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    <?php else: ?>
        <p class="text-danger">Fournisseur introuvable.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
