<?php
require '../controller/AvisC.php';

// Récupérer les avis depuis le contrôleur
$ec = new AvisC();
$tab = $ec->afficher();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Avis</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Liste des Avis</h1>
        
        <!-- Bouton Ajouter un avis -->
        <div class="text-end mb-3">
            <a href="AddAvis.php" class="btn btn-primary">Ajouter un Avis</a>
        </div>

        <!-- Tableau des avis -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    
                    <th>Note</th>
                    <th>Avis</th>
                    <th>Date</th>
                    <th>commenter</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tab)) : ?>
                    <?php foreach ($tab as $avis) : ?>
                        <tr>
                           
                            <td><?= htmlspecialchars($avis['note']) ?></td>
                            <td><?= htmlspecialchars($avis['type_avis']) ?></td>
                            <td><?= htmlspecialchars($avis['date_avis']) ?></td>
                            <td>
                                <!-- Boutons d'action -->
                                <a href="AddC.php?id=<?= $avis['id'] ?>" class="btn btn-warning btn-sm">Commenter</a>
                                <a href="DeleteAvis.php?id=<?= $avis['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            
                            
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucun avis trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
