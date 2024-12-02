<?php
require '../Controller/CommentaireC.php';

$commentaireC = new CommentaireC();
$listeCommentaires = $commentaireC->afficherCommentaires();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Commentaires</title>
    

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Liste des Commentaires</h1>
        <!-- Bouton Ajouter un avis -->
    <div class="text-end mb-3">
            <a href="AddC.php" class="btn btn-primary">Ajouter un Commentaire</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contenu</th>
                    <th>Date du Commentaire</th>
                    <th>ID Avis</th>
                    <th>Date de l'Avis</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listeCommentaires as $commentaire) : ?>
                    <tr>
                        <td><?= htmlspecialchars($commentaire['id']) ?></td>
                        <td><?= htmlspecialchars($commentaire['contenu']) ?></td>
                        <td><?= htmlspecialchars($commentaire['date_commentaire']) ?></td>
                        <td><?= htmlspecialchars($commentaire['idAvis']) ?></td>
                        <td><?= htmlspecialchars($commentaire['date_avis']) ?></td>
                        <td>
                                <!-- Boutons d'action -->
                                <a href="updateC.php?id=<?= $commentaire['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="deleteC.php?id=<?= $commentaire['id'] ?>" class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');">Supprimer</a>
                            </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
