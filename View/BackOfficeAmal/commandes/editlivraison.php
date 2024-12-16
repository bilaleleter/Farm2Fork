<?php

use Controller\LivraisonController;
use Model\Livraison;

include '../../../Controller/LivraisonController.php';


// Vérifiez si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: livraison.php');
    exit;
}

// Instancier le contrôleur Livraison
$controller = new LivraisonController();

// Récupérer les détails de la livraison à partir de l'ID
$result = $controller->getLivraison($id);

// Vérifier si le formulaire est soumis
if (isset($_POST['btn'])) {
    // Récupérer les données du formulaire
    $ville = $_POST['ville'];
    $codePostal = $_POST['codePostal'];
    $adresse = $_POST['adresse'];
    $dateEnvoi = $_POST['dateEnvoi'];
    $statut = $_POST['statut'];
    $dateEstimee = $_POST['dateEstimee'];

    // Créer un objet Livraison avec les nouvelles données
    $livraison = new Livraison($id, $ville, $codePostal, $adresse, $dateEnvoi, $statut, $dateEstimee);

    // Appeler la méthode pour mettre à jour la livraison
    $controller->updateLivraison($livraison, $id);

    // Redirection vers la liste des livraisons après la mise à jour
    header('Location: livraison.php');
    exit;
}

?>








<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Livraison - Tableau de Bord</title>
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
            margin-left: 260px; /* Espace réservé pour la sidebar */
        }

        .overview {
            background-color: #ead885;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Personnalisation du formulaire */
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

        .form-group input:focus {
            outline: none;
            border-color: #1c5739;
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
    <h2>Modifier Livraison</h2>
    <form method="POST" class="user" id="livraisonForm">
        <div class="form-group">
            <input type="text" name="ville" id="ville" class="form-control form-control-user" value="<?php echo htmlspecialchars($result['ville']); ?>" placeholder="Ville">
            <small id="villeError" class="text-danger d-none">La ville doit contenir uniquement des lettres, des espaces ou des tirets (3 caractères minimum).</small>
        </div>
        <div class="form-group">
            <input type="text" name="codePostal" id="codePostal" class="form-control form-control-user" value="<?php echo htmlspecialchars($result['codePostal']); ?>" placeholder="Code Postal">
            <small id="codePostalError" class="text-danger d-none">Le code postal doit être constitué de 4 chiffres uniquement.</small>
        </div>
        <div class="form-group">
            <input type="text" name="adresse" id="adresse" class="form-control form-control-user" value="<?php echo htmlspecialchars($result['Adresse_de_Livraison']); ?>" placeholder="Adresse de Livraison">
            <small id="adresseError" class="text-danger d-none">L'adresse doit comporter au moins 5 caractères et être valide (lettres, chiffres, espaces, tirets, etc.).</small>
        </div>
        <button type="submit" name="btn" class="btn-update" id="submitBtn" disabled>
            Mettre à Jour
        </button>
    </form>
</section>

<script>
    // Récupérer les éléments du formulaire
    const form = document.getElementById('livraisonForm');
    const villeInput = document.getElementById('ville');
    const codePostalInput = document.getElementById('codePostal');
    const adresseInput = document.getElementById('adresse');
    const submitButton = document.getElementById('submitBtn');

    // Messages d'erreur
    const villeError = document.getElementById('villeError');
    const codePostalError = document.getElementById('codePostalError');
    const adresseError = document.getElementById('adresseError');

    // Fonction pour vérifier la validité du formulaire
    const checkFormValidity = () => {
        const villeValid = isVilleValid();
        const codePostalValid = isCodePostalValid();
        const adresseValid = isAdresseValid();

        // Activer ou désactiver le bouton de soumission en fonction de la validité des champs
        submitButton.disabled = !(villeValid && codePostalValid && adresseValid);
    };

    // Validation du champ Ville
    const isVilleValid = () => {
        const ville = villeInput.value.trim();
        const regexVille = /^[A-Za-zÀ-ÿ\s-]{3,50}$/;  // Ville : lettres, espaces ou tirets, minimum 3 caractères
        if (ville === '') {
            villeError.textContent = "La ville est obligatoire.";
            villeError.classList.remove('d-none');
            return false;
        } else if (!regexVille.test(ville)) {
            villeError.textContent = "La ville doit contenir uniquement des lettres, des espaces ou des tirets (3 caractères minimum).";
            villeError.classList.remove('d-none');
            return false;
        } else {
            villeError.classList.add('d-none');
            return true;
        }
    };

    // Validation du champ Code Postal
    const isCodePostalValid = () => {
        const codePostal = codePostalInput.value.trim();
        const regexCodePostal = /^\d{4}$/;  // Code postal : exactement 4 chiffres
        if (codePostal === '') {
            codePostalError.textContent = "Le code postal est obligatoire.";
            codePostalError.classList.remove('d-none');
            return false;
        } else if (!regexCodePostal.test(codePostal)) {
            codePostalError.textContent = "Le code postal doit être constitué de 4 chiffres uniquement.";
            codePostalError.classList.remove('d-none');
            return false;
        } else {
            codePostalError.classList.add('d-none');
            return true;
        }
    };

    // Validation du champ Adresse

    const isAdresseValid = () => {
    const adresse = adresseInput.value.trim();
    const regexAdresse = /^[A-Za-zÀ-ÿ0-9\s,.\-_\/]{5,}$/;  // Autoriser lettres, chiffres, espaces, virgules, points, tirets, tirets bas et slash
    if (adresse === '') {
        adresseError.textContent = "L'adresse est obligatoire.";
        adresseError.classList.remove('d-none');
        return false;
    } else if (!regexAdresse.test(adresse)) {
        adresseError.textContent = "L'adresse doit comporter au moins 5 caractères et être valide (lettres, chiffres, espaces, tirets, tirets bas, slash, etc.).";
        adresseError.classList.remove('d-none');
        return false;
    } else {
        adresseError.classList.add('d-none');
        return true;
    }
};


    // Validation en temps réel
    villeInput.addEventListener('input', () => {
        isVilleValid();
        checkFormValidity();
    });

    codePostalInput.addEventListener('input', () => {
        isCodePostalValid();
        checkFormValidity();
    });

    adresseInput.addEventListener('input', () => {
        isAdresseValid();
        checkFormValidity();
    });

    // Validation avant soumission du formulaire
    form.addEventListener('submit', (event) => {
        // Empêcher la soumission si un champ est invalide
        if (submitButton.disabled) {
            event.preventDefault();
        }
    });
</script>

    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
