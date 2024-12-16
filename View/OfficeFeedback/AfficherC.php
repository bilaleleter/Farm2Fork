<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\CommentaireC.php';

$commentaireC = new CommentaireC();
$listeCommentaires = $commentaireC->afficherCommentaires();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="apple-touch-icon" sizes="76x76"
        href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png"
        href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template/assets/img/favicon.png" />
    <title>Liste des commentaires</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\assets\css/cssnucleo-icons.css"
        rel="stylesheet" />
    <link href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\assets\css/cssnucleo-svg.css"
        rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle"
        href="/Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\assets\css/material-dashboard.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

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
<body class="g-sidenav-show bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand px-4 py-3 m-0" href="" target="_blank">
                <img src="../FrontOfficeUser/assets/img/farm2fork v1.png" class="navbar-brand-img"
                    alt="main_logo" />
                <span class="ms-1 text-sm text-dark">Farm2Fork</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0 mb-2" />
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active bg-gradient-dark text-white"
                    href="\Farm2Fork MAIN BRANCH\Integration\View\OfficeFeedback\AfficherAvis.php">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Retourner au avis</span>
                </a>
            </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\dashboard.php">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="\Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeBilel\index.php">
                        <i class="material-symbols-rounded opacity-5">receipt_long</i>
                        <span class="nav-link-text ms-1">Marketplace</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeBilel\pages\listeProduit.html">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Gestion des Produits</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeBilel\pages\listeCategorie.html">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Gestion des Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active bg-gradient-dark text-white"
                        href="\Farm2Fork MAIN BRANCH\Integration\View\OfficeFeedback\AfficherAvis.php">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Reponse au Avis</span>
                    </a>
                </li>
            </ul>
        </div>
        <form method="post" name="SignOutForm" id="SignOutForm"></form>
        <div class="sidenav-footer position-absolute w-100 bottom-0">
            <div class="mx-3">
                <button type="submit" class="btn bg-gradient-dark w-100" form="SignOutForm" name="logout">Sign
                    out</button>
            </div>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    </ol>
                </nav>

            </div>
        </nav>
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
    </main>
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
