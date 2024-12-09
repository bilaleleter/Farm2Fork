<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraisons - Tableau de Bord</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fdf2e7;
            color: #1c5739;
        }

        main {
            padding: 30px;
            margin-left: 260px;
        }

        .overview {
            background-color: #ead885;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #1c5739;
            color: #fdf2e7;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
        <div class="sidenav-header">
            <a class="navbar-brand px-4 py-3 m-0" href="index.php">
                <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="logo">
                <span class="ms-1 text-sm text-dark">Gestion des Commandes</span>
            </a>
        </div>
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="commande.php">
                        <i class="material-symbols-rounded">receipt_long</i>
                        <span class="nav-link-text ms-1">Commandes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="livraison.php">
                        <i class="material-symbols-rounded">local_shipping</i>
                        <span class="nav-link-text ms-1">Livraisons</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="suivi-livraison.php">
                        <i class="material-symbols-rounded">track_changes</i>
                        <span class="nav-link-text ms-1">Suivi Livraison</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="historique.php">
                        <i class="material-symbols-rounded">dashboard</i>
                        <span class="nav-link-text ms-1">Historique</span>
                    </a>
                </li>
                <li class="nav-item">
                   <a class="nav-link text-dark" href="gestion_feedback.php">
                        <i class="material-symbols-rounded">comments</i>
                        <span class="nav-link-text ms-1">Feedbacks</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main>
        <section class="overview">
            <h2 style="text-align: center; color: #1c5739;">Liste des Livraisons</h2>

            <?php
            // Charger les livraisons
            include_once '../../../Controller/LivraisonController.php';
            use Controller\LivraisonController;

            $livraisonController = new LivraisonController();
            $allLivraisons = $livraisonController->getAllLivraisons();

            // Récupérer la ville sélectionnée pour filtrer
            $selectedCity = isset($_GET['ville']) ? $_GET['ville'] : '';

            // Filtrer les livraisons par ville
            $filteredLivraisons = array_filter($allLivraisons, function ($livraison) use ($selectedCity) {
                return $selectedCity === '' || $livraison['ville'] === $selectedCity;
            });

            // Configuration de la pagination
            $livraisonsPerPage = 3; // Nombre d'éléments par page
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $livraisonsPerPage;

            // Pagination sur les livraisons filtrées
            $totalLivraisons = count($filteredLivraisons);
            $totalPages = ceil($totalLivraisons / $livraisonsPerPage);
            $livraisons = array_slice($filteredLivraisons, $start, $livraisonsPerPage);
            ?>

            <!-- Formulaire de filtre par ville -->
            <form method="GET" action="" style="display: flex; gap: 10px; margin-bottom: 20px;">
                <label for="ville" style="font-weight: bold;">Filtrer par ville :</label>
                <select name="ville" id="ville" style="padding: 10px; border: 1px solid #1c5739; border-radius: 5px;">
                    <option value="">Toutes les villes</option>
                    <?php foreach (array_unique(array_column($allLivraisons, 'ville')) as $ville): ?>
                        <option value="<?= htmlspecialchars($ville) ?>" <?= ($ville === $selectedCity) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($ville) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" style="padding: 10px 20px; background-color: #1c5739; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Filtrer</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>ID Livraison</th>
                        <th>Ville</th>
                        <th>Code Postal</th>
                        <th>Adresse</th>
                        <th>Référence Commande</th>
                        <th>ID Utilisateur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livraisons as $livraison): ?>
                        <tr>
                            <td><?= htmlspecialchars($livraison['ID_livraison']) ?></td>
                            <td><?= htmlspecialchars($livraison['ville']) ?></td>
                            <td><?= htmlspecialchars($livraison['codePostal']) ?></td>
                            <td><?= htmlspecialchars($livraison['Adresse_de_Livraison']) ?></td>
                            <td><?= htmlspecialchars($livraison['ref_commande']) ?></td>
                            <td><?= htmlspecialchars($livraison['idUser']) ?></td>
                            <td>
                                <a href="editlivraison.php?id=<?= $livraison['ID_livraison'] ?>" style="background-color: #1c5739; color: #fdf2e7; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Modifier</a>
                                <a href="deletelivraison.php?id=<?= $livraison['ID_livraison'] ?>" style="background-color: #f54242; color: #fdf2e7; padding: 5px 10px; border-radius: 5px; text-decoration: none;" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette livraison ?')">Annuler</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav style="text-align: center; margin-top: 20px;">
                <ul style="list-style-type: none; padding: 0; display: inline-flex;">
                    <?php if ($page > 1): ?>
                        <li><a href="?page=<?= $page - 1 ?>&ville=<?= urlencode($selectedCity) ?>" style="text-decoration: none; background-color: #1c5739; color: #fdf2e7; padding: 8px 12px; border-radius: 5px;">Précédent</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li>
                            <a href="?page=<?= $i ?>&ville=<?= urlencode($selectedCity) ?>" style="text-decoration: none; padding: 8px 12px; border-radius: 5px; <?= $i === $page ? 'background-color: #ead885; color: #1c5739;' : 'background-color: #1c5739; color: #fdf2e7;' ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li><a href="?page=<?= $page + 1 ?>&ville=<?= urlencode($selectedCity) ?>" style="text-decoration: none; background-color: #1c5739; color: #fdf2e7; padding: 8px 12px; border-radius: 5px;">Suivant</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </section>
    </main>
</body>

</html>
