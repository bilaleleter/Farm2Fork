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
        /* Style global (identique à celui de la page principale) */
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
            <a class="navbar-brand px-4 py-3 m-0" href="gestion_commandes.html">
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
        <section class="">
            <h2>Liste des Livraisons</h2>
            <table class="table table-bordered" id="livraisonTable" width="100%">
                <thead>
                    <tr>
                        <th>ID Livraison</th>
                        <th>Ville</th>
                        <th>Code Postal</th>
                        <th>Adresse</th>
                        <th>Date d'Envoi</th>
                        <th>Statut</th>
                        <th>Date Livraison Estimée</th>
                        <th>ID Utilisateur</th>
                        <th>Actions</th> <!-- Regroupé dans une seule colonne -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../../../Controller/LivraisonController.php';

                    use Controller\LivraisonController;

                    $livraisonController = new LivraisonController();
                    $livraisons = $livraisonController->getAllLivraisons(); // Récupérer toutes les livraisons

                    foreach ($livraisons as $livraison) {
                        echo "
            <tr id='row-{$livraison['ID_livraison']}'>
                <td>{$livraison['ID_livraison']}</td>
                <td>{$livraison['ville']}</td>
                <td>{$livraison['codePostal']}</td>
                <td>{$livraison['Adresse_de_Livraison']}</td>
                <td>{$livraison['Date_d_envoi']}</td>
                <td>{$livraison['Statut_de_Livraison']}</td>
                <td>{$livraison['Date_de_Livraison_Estimee']}</td>
                <td>{$livraison['idUser']}</td>
                <td>
                    <!-- Actions : Modifier et Annuler -->
                    <a href='editlivraison.php?id={$livraison['ID_livraison']}' class='btn btn-success '>Modifier</a>
                    <a href='deletelivraison.php?id={$livraison['ID_livraison']}' class='btn btn-primary'>Annuler</a>
                </td>
            </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <script>
                function modifierLivraison(id) {
                    // Redirection vers la page editlivraison.php avec l'ID de la livraison
                    window.location.href = 'editlivraison.php?id=' + id;
                }

                function annulerLivraison(id) {
                    // Logique pour annuler une livraison si nécessaire
                    alert("Livraison " + id + " annulée.");
                }
            </script>

        </section>
    </main>


    <script>
        // Fonction pour modifier l'adresse de la livraison
        function modifierLivraison(idLivraison) {
            // Récupère la nouvelle adresse
            const newAddress = document.getElementById("address-" + idLivraison).value;

            // Vérifie si l'adresse est valide
            if (newAddress.trim() === "") {
                alert("L'adresse ne peut pas être vide.");
                return;
            }

            // Envoie une requête pour mettre à jour l'adresse de la livraison dans la base de données
            fetch('/modifier_livraison', {
                    method: 'POST',
                    body: JSON.stringify({
                        idLivraison: idLivraison,
                        address: newAddress
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Adresse de livraison modifiée avec succès !");
                    } else {
                        alert("Erreur lors de la modification de l'adresse.");
                    }
                });
        }

        // Fonction pour annuler (supprimer) la livraison
        function annulerLivraison(idLivraison) {
            // Demande de confirmation avant de supprimer la livraison
            if (confirm("Êtes-vous sûr de vouloir annuler cette livraison ?")) {
                // Envoie une requête pour supprimer la livraison
                fetch('/annuler_livraison', {
                        method: 'POST',
                        body: JSON.stringify({
                            idLivraison: idLivraison
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Livraison annulée avec succès.");
                            // Retirer la ligne de la table (dynamique)
                            const row = document.getElementById('row-' + idLivraison);
                            row.remove();
                        } else {
                            alert("Erreur lors de l'annulation de la livraison.");
                        }
                    });
            }
        }
    </script>

</body>

</html>