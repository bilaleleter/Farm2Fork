<?php
include_once '../../../Controller/CommandeController.php';
include_once '../../../Model/Commande.php';

use Controller\CommandeController;
use Model\Commande;

// Vérifiez que l'ID de la commande est présent dans l'URL
if (!isset($_GET['id_commande'])) {
    die("ID de commande non spécifié.");
}

$id_commande = (int)$_GET['id_commande'];
$commandeController = new CommandeController();

try {
    // Récupérer les détails de la commande existante
    $commandeExistante = $commandeController->getCommande($id_commande);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les nouvelles données du formulaire
        $nouvelle_quantite = (int)$_POST['quantite'];
        $nouvelle_etat = $_POST['etat'];

        // Créez un objet Commande avec toutes les valeurs nécessaires
        $commande = new Commande(
            $id_commande,
            $commandeExistante['date_commande'],
            $nouvelle_etat,
            $nouvelle_quantite,
            $commandeExistante['id_utilisateur'],
            $commandeExistante['id_produit'],
            $commandeExistante['id_livraison']
        );

        // Appeler la méthode updateCommande pour enregistrer les modifications
        $commandeController->updateCommande($commande);

        // Redirection avec message de succès
        header("Location: commande.php?message=modifie");
        exit;
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Commande - Tableau de Bord</title>
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

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .btn-update {
            background-color: #1c5739;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            width: 100%;
        }

        .btn-update:hover {
            background-color: #14572d;
        }
    </style>
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
            </ul>
        </div>
    </aside>
    <main>
        <section class="form-container">
            <h2>Modifier Commande</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="quantite">Quantité :</label>
                    <input type="number" name="quantite" id="quantite" value="<?= htmlspecialchars($commandeExistante['quantite']) ?>" required>
                    <select name="etat" id="etat">
                        <option value="en attente">En Attente</option>
                        <option value="en cours de traitement">En cours de traitement</option>
                        <option value="livré">Livré</option>
                    </select>
                </div>
                <button type="submit" class="btn-update">Mettre à Jour</button>
            </form>
        </section>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
