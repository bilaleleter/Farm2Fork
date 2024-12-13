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
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Styles pour les icônes de like et dislike */
        .like-dislike .icon {
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .like-dislike .icon.like {
            color: #28a745;
        }

        .like-dislike .icon.dislike {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Liste des Commentaires</h1>
        <!-- Bouton Ajouter un commentaire -->
    
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    
                    <th>Contenu</th>
                    <th>Date du Commentaire</th>
                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listeCommentaires as $commentaire) : ?>
                    <tr>

                        <td><?= htmlspecialchars($commentaire['contenu']) ?></td>
                        <td><?= htmlspecialchars($commentaire['datec']) ?></td>
                        
                        <td>
                            <!-- Boutons d'action -->
                            <a href="updateC.php?id=<?= $commentaire['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="deleteC.php?id=<?= $commentaire['id'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">Supprimer</a>
                            <!-- Icônes de like et dislike -->
                            <div class="like-dislike d-flex justify-content-center gap-1 my-2">
                                <i class="fas fa-thumbs-up icon like" onclick="likeCommentaire(<?= $commentaire['id'] ?>)"></i>
                                <i class="fas fa-thumbs-down icon dislike" onclick="dislikeCommentaire(<?= $commentaire['id'] ?>)"></i>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Diagramme des likes et dislikes -->
        <h2 class="text-center mt-5">Diagramme des Likes et Dislikes</h2>
        <canvas id="likeDislikeChart" width="400" height="200"></canvas>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function likeCommentaire(id) {
            // Logique pour gérer le like du commentaire
            fetch('likeDislike.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id, action: 'likee' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Like ajouté avec succès !');
                    updateChart();
                } else {
                    alert('Erreur lors de l\'ajout du like.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function dislikeCommentaire(id) {
            // Logique pour gérer le dislike du commentaire
            fetch('likeDislike.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id, action: 'dislike' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Dislike ajouté avec succès !');
                    updateChart();
                } else {
                    alert('Erreur lors de l\'ajout du dislike.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function updateChart() {
            // Mettre à jour le diagramme avec les nouvelles données
            fetch('getLikeDislikeData.php')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('likeDislikeChart').getContext('2d');
                    const likeDislikeChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Likes',
                                data: data.likes,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }, {
                                label: 'Dislikes',
                                data: data.dislikes,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Initialiser le diagramme
        updateChart();
    </script>
</body>
</html>
