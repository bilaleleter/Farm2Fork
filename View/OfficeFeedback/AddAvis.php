<?php
// Inclure les fichiers nécessaires
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\AvisC.php';
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Model\Avis.php';

$error = "";
$Avis = null;
$AvisC = new AvisC();

// Vérifiez si le formulaire est soumis
if (
    isset($_POST["rating"]) && // Note via les étoiles
    isset($_POST["type_avis"])
) {
    if (
        !empty($_POST["rating"]) &&
        !empty($_POST["type_avis"]) 
    ) {
        // Créez un nouvel objet Avis avec la date actuelle
        $Avis = new Avis(
            null,
            $_POST['rating'], // Note sélectionnée
            $_POST['type_avis'],
            new DateTime(), // Date actuelle
        );

        // Ajouter l'avis en base de données
        $AvisC->addAvis($Avis);

        // Rediriger vers la page de liste
        header('Location: AfficherAvis.php');
        exit();
    } else {
        $error = "Toutes les informations sont requises.";
    }
}
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
    <title>Ajouter un avis</title>
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

    <!-- Inclure Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Formulaire principal */
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Titre */
        h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #333;
        }

        /* Étiquettes */
        label {
            font-weight: bold;
            color: #495057;
        }

        /* Boutons */
        button {
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        button.btn-primary {
            background-color: #007bff;
            color: white;
        }

        button.btn-primary:hover {
            background-color: #0056b3;
        }

        button.btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        button.btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Champs de saisie */
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
            color: #495057;
        }

        input[type="text"]:focus,
        input[type="date"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.25);
        }

        /* Section de notation */
        .rating {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .rating .star {
            font-size: 32px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s;
        }

        .rating .star:hover,
        .rating .star:hover ~ .star,
        .rating input:checked ~ label {
            color: #ffcc00;
        }

        .rating input {
            display: none;
        }

        /* Erreur */
        .alert {
            font-size: 14px;
            color: #842029;
            background-color: #f8d7da;
            border: 1px solid #f5c2c7;
            padding: 10px;
            border-radius: 4px;
        }

        /* Espacement */
        .mb-3 {
            margin-bottom: 20px;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        /* Icônes de main */
        .like-dislike .icon {
            font-size: 32px;
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
            <li class="nav-item">
                <a class="nav-link active bg-gradient-dark text-white"
                    href="\Farm2Fork MAIN BRANCH\Integration\View\OfficeFeedback\AfficherAvis.php">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Retourner au avis</span>
                </a>
            </li>
            <ul class="navbar-nav">
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
    <form action="" method="POST" class="border p-4 rounded shadow-sm" onsubmit="return validateForm()">
    <input type="hidden" name="idAvis" value="<?= htmlspecialchars($idAvis) ?>">

    <div class="mb-3">
            <label class="form-label">Note</label>
            <div class="rating d-flex justify-content-center gap-1 my-2">
                
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5" class="star" title="5 étoiles">★</label>

                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4" class="star" title="4 étoiles">★</label>

                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3" class="star" title="3 étoiles">★</label>

                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2" class="star" title="2 étoiles">★</label>

                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1" class="star" title="1 étoile">★</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="type_avis" class="form-label">Avis</label>
            <input type="text" class="form-control" id="type_avis" name="type_avis" placeholder="Donner votre avis">
        </div>
       
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="AfficherAvis.php" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </form>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var likeBtn = document.getElementById('likeBtn');
            var dislikeBtn = document.getElementById('dislikeBtn');
            var likeInput = document.getElementById('like');
            var dislikeInput = document.getElementById('dislike');

            likeBtn.addEventListener('click', function() {
                likeInput.value = 1;
                dislikeInput.value = 0;
            });

            dislikeBtn.addEventListener('click', function() {
                likeInput.value = 0;
                dislikeInput.value = 1;
            });
        });

        function validateForm() {
            var rating = document.querySelector('input[name="rating"]:checked');
            var type_avis = document.getElementById('type_avis').value;

            if (!rating) {
                alert("Veuillez sélectionner une note.");
                return false;
            }

            var regexAvis = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/;
            if (type_avis.trim() == "" || !regexAvis.test(type_avis)) {
                alert("Veuillez entrer un avis valide (uniquement du texte).");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
