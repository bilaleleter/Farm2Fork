<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Historique - Tableau de Bord</title>

    <!-- Fonts and icons -->
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
            /* Espace réservé pour la sidebar */
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
                <li class="nav-item">
                   <a class="nav-link text-dark" href="gestion_feedback.php">
                        <i class="material-symbols-rounded">comments</i>
                        <span class="nav-link-text ms-1">Feedbacks</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main content -->
    <main>
        <section class="overview">
            <h2>Suivi des Livraisons</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Livraison</th>
                        <th>ID Commande</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>L001</td>
                        <td>C001</td>
                        <td>En Cours</td>
                    </tr>
                    <tr>
                        <td>L002</td>
                        <td>C002</td>
                        <td>Livrée</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>