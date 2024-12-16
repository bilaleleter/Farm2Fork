<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\fournisseurController.php';
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\factureController.php';

$fournisseurController = new FournisseurController();
$factureController = new FactureController();


// Vérification du tri (par défaut 'asc')
$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
$factures = $factureController->getAllFacturesTrier($sortOrder);


$fournisseurs = $fournisseurController->getAllFournisseurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Fournisseurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="center">Liste des Fournisseurs</h1>

    <!-- Boutons de tri -->
    <div class="mb-3">
        <a href="?sort=desc" class="btn btn-primary">Trier par Montant (Descendant)</a>
        <a href="?sort=asc" class="btn btn-secondary">Trier par Montant (Ascendant)</a>
    </div>
    
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Factures Associées</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($fournisseurs as $fournisseur): ?>
            <tr>
                <td><?= $fournisseur->getId() ?></td>
                <td><?= $fournisseur->getNom() ?></td>
                <td>
                    <ul>
                        <?php
                        $facturesAssociees = array_filter($factures, function ($facture) use ($fournisseur) {
                            return $facture['fournisseur_id'] == $fournisseur->getId();
                        });
                        if (!empty($facturesAssociees)):
                            foreach ($facturesAssociees as $facture): ?>
                                <li>
                                    Date : <?= $facture['date_facture'] ?>, 
                                    Montant : <?= $facture['montant'] ?>
                                </li>
                            <?php endforeach;
                        else: ?>
                            <li>Aucune facture</li>
                        <?php endif; ?>
                    </ul>
                </td>
                <td>
                  <a href="updateFacture.php?id=<?= $facture['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="deleteFacture.php?id=<?= $facture['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    <a href="generatepdf.php?id=<?= $facture['id'] ?>" class="btn btn-primary btn-sm" target="_blank">Imprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <td>
    <a href="addFacture.php?id=<?= $fournisseur->getId() ?>" class="btn btn-success btn-sm">Ajouter</a>
    </td>
</div>
</body>
</html>
