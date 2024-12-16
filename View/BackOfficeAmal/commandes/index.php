<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Commandes et Livraisons</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

    <style>
        /* Style de la page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fdf2e7;
            color: #1c5739;
        }

        header {
            background-color: #1c5739;
            color: #fdf2e7;
            padding: 20px;
            text-align: center;
            margin-left: 260px;
            /* Espace réservé pour la sidebar */
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
            margin-left: 260px;
            /* Espace réservé pour la sidebar */
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin-left: 260px;
            /* Espace réservé pour la sidebar */
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
            margin-left: 260px;
            /* Espace réservé pour la sidebar */
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
        }

        .stats {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .stat-card {
            background-color: #fff;
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
            width: 200px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            margin: 0;
            font-size: 1.2em;
        }

        .stat-card p {
            font-size: 1.5em;
            margin-top: 10px;
        }

        footer {
            background-color: #1c5739;
            color: #fdf2e7;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-left: 260px;
            /* Espace réservé pour la sidebar */
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .stats {
                flex-direction: column;
                align-items: center;
            }

            .stat-card {
                width: 80%;
                margin: 10px auto;
            }
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

    <header>
        <h1>Tableau de Bord - Gestion des Commandes et Livraisons</h1>
        <nav>

        </nav>
    </header>

    <main>
        <section class="overview">
            <h2>Vue d'ensemble</h2>
            <div class="stats">
                <div class="stat-card">
                    <h3>Total des Commandes</h3>
                    <p>120</p>
                </div>
                <div class="stat-card">
                    <h3>Total des Livraisons</h3>
                    <p>98</p>
                </div>
                <div class="stat-card">
                    <h3>Commandes en Traitement</h3>
                    <p>15</p>
                </div>
                <div class="stat-card">
                    <h3>Livraisons en Cours</h3>
                    <p>5</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 - Tableau de bord des commandes et livraisons</p>
    </footer>

</body>

</html>