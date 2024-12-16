<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
    <!-- Sidebar -->
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
                    <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\user_management.php">
                        <i class="material-symbols-rounded">receipt_long</i>
                        <span class="nav-link-text ms-1">Retourner au dashboard</span>
                    </a>
                </li>
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


    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Commandes</title>
    <style>
        /* Style global */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fdf2e7;
            color: #1c5739;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fdf2e7;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            padding: 30px;
            margin-left: 260px;
            /* Espace réservé pour la sidebar */
        }

        .overview {
            background-color: #ead885;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .overview h2 {
            margin-top: 0;
            font-size: 1.8em;
            text-align: center;
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

        .actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .actions button {
            background-color: #1c5739;
            color: #fdf2e7;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .actions button:hover {
            background-color: #3e7e57;
        }
    </style>
</head>

<body>
<main style="font-family: Arial, sans-serif; background-color: #fdf2e7; color: #1c5739; padding: 20px;">
    <section class="overview">
        <h2 style="text-align: center; color: #1c5739;">Liste des Commandes</h2>

        <?php
        // Importation des fichiers nécessaires
        include_once '../../../Controller/CommandeController.php';
        include_once '../../../Controller/ProduitControllerAmal.php';

        use Controller\CommandeController;
        use Controller\ProduitController;

        $commandeController = new CommandeController();
        $produitController = new ProduitController();

        // Configuration de la pagination
        $commandsPerPage = 3; // Nombre d'éléments par page
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $commandsPerPage;

        // Filtrer par produit sélectionné
        $selectedProduct = isset($_GET['produit']) ? $_GET['produit'] : '';

        // Récupération des commandes et gestion de la pagination
        $allCommandes = $commandeController->getAllCommands();
        $filteredCommandes = array_filter($allCommandes, function($commande) use ($selectedProduct, $produitController) {
            if ($selectedProduct === '') return true;

            $produitId = $commande['id_produit'];
            $produitNom = $produitController->getProduitbyId($produitId)['nom_produit'] ?? '';

            return $produitNom === $selectedProduct;
        });

        $totalCommands = count($filteredCommandes);
        $totalPages = ceil($totalCommands / $commandsPerPage);
        $commandes = array_slice($filteredCommandes, $start, $commandsPerPage);
        ?>

        <!-- Formulaire de filtrage par produit -->
        <form method="GET" action="" style="display: flex; gap: 10px; margin-bottom: 20px;">
            <label for="produit" style="font-weight: bold;">Filtrer par produit :</label>
            <select name="produit" id="produit" style="padding: 10px; border: 1px solid #1c5739; border-radius: 5px;">
                <option value="">Tous les produits</option>
                <?php foreach ($produitController->getAllProduits() as $produit): ?>
                    <option value="<?= htmlspecialchars($produit['nom_produit']) ?>" <?= ($produit['nom_produit'] === $selectedProduct) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($produit['nom_produit']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" style="padding: 10px 20px; background-color: #1c5739; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Filtrer</button>
        </form>

        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <thead style="background-color: #1c5739; color: #fdf2e7;">
                <tr>
                    <th style="padding: 10px; text-align: left;">ID Commande</th>
                    <th style="padding: 10px; text-align: left;">Date de Commande</th>
                    <th style="padding: 10px; text-align: left;">État</th>
                    <th style="padding: 10px; text-align: left;">Quantité</th>
                    <th style="padding: 10px; text-align: left;">Produit</th>
                    <th style="padding: 10px; text-align: left;">Référence</th>
                    <th style="padding: 10px; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <?php
                    $id_commande = $commande['ID_commande'] ?? 'Inconnu';
                    $date_commande = $commande['date_commande'] ?? 'Non spécifiée';
                    $etat = $commande['etat'] ?? 'Non spécifié';
                    $quantite = $commande['quantite'] ?? 'Non spécifiée';
                    $produit_nom = isset($commande['id_produit']) ? $produitController->getProduitbyId($commande['id_produit'])['nom_produit'] : 'Produit inconnu';
                    $ref_commande = $commande['ref_commande'] ?? 'Non spécifiée';
                    ?>
                    <tr style="background-color: #ead885;">
                        <td style="padding: 10px;"><?= htmlspecialchars($id_commande) ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($date_commande) ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($etat) ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($quantite) ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($produit_nom) ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($ref_commande) ?></td>
                        <td style="padding: 10px;">
                            <a href="modifier_commande.php?id_commande=<?= $id_commande ?>" style="background-color: #1c5739; color: #fdf2e7; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Modifier</a>
                            <a href="supprimer_commande.php?id_commande=<?= $id_commande ?>" style="background-color: #f54242; color: #fdf2e7; padding: 5px 10px; border-radius: 5px; text-decoration: none;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav style="text-align: center; margin-top: 20px;">
            <ul style="list-style-type: none; padding: 0; display: inline-flex;">
                <?php if ($page > 1): ?>
                    <li style="margin: 0 5px;">
                        <a href="?page=<?= $page - 1 ?>&produit=<?= urlencode($selectedProduct) ?>" style="text-decoration: none; background-color: #1c5739; color: #fdf2e7; padding: 8px 12px; border-radius: 5px;">Précédent</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li style="margin: 0 5px;">
                        <a href="?page=<?= $i ?>&produit=<?= urlencode($selectedProduct) ?>" style="text-decoration: none; <?= $i === $page ? 'background-color: #ead885; color: #1c5739;' : 'background-color: #1c5739; color: #fdf2e7;' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li style="margin: 0 5px;">
                        <a href="?page=<?= $page + 1 ?>&produit=<?= urlencode($selectedProduct) ?>" style="text-decoration: none; background-color: #1c5739; color: #fdf2e7; padding: 8px 12px; border-radius: 5px;">Suivant</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </section>
</main>

<script>
    function modifierCommande(idCommande) {
        const newQuantity = document.getElementById("quantity-" + idCommande).value;
        if (newQuantity > 0) {
            fetch('/modifier_commande', {
                    method: 'POST',
                    body: JSON.stringify({
                        idCommande: idCommande,
                        quantity: newQuantity
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Commande modifiée avec succès !");
                    } else {
                        alert("Erreur lors de la modification.");
                    }
                });
        } else {
            alert("Quantité invalide.");
        }
    }

    function annulerCommande(idCommande) {
        if (confirm("Êtes-vous sûr de vouloir annuler cette commande ?")) {
            fetch('/annuler_commande', {
                    method: 'POST',
                    body: JSON.stringify({
                        idCommande: idCommande
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Commande annulée.");
                        document.getElementById('row-' + idCommande).remove();
                    } else {
                        alert("Erreur lors de l'annulation.");
                    }
                });
        }
    }
</script>
</body>
</html>
