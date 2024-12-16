<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\CommentaireC.php';
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Model\Commentaire.php';

$error = "";
$com = null;
$comC = new CommentaireC();
if (
    isset($_POST["contenu"]) &&
    isset($_POST["datec"]) &&
    isset($_POST["idAvis"]) &&
    isset($_POST["action"])
) {
    if (
        !empty($_POST["contenu"]) &&
        !empty($_POST["datec"]) &&
        !empty($_POST["idAvis"])
    ) {
        $com = new Commentaire(
            null,
            $_POST['contenu'],
            new DateTime($_POST['datec']),
            $_POST['idAvis'],
            $_POST['action'] == 'like' ? 1 : 0,
            $_POST['action'] == 'dislike' ? 1 : 0
        );
        $comC->updateCommentaire($com, $_POST["id"]);
        header('Location:AfficherC.php');
    } else {
        $error = "Missing information";
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
    <title>Mettre a jour - commentaire</title>
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
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container mt-5">
        <h1 class="text-center mb-4">Mettre à Jour un Commentaire</h1>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php
        // Assurer que l'ID du commentaire est passé par la méthode GET ou POST
        if (isset($_GET['id'])) {
            // Récupérer le commentaire à partir de l'ID
            $comC = new CommentaireC();
            $commentaire = $comC->getCommentaire($_GET['id']);
        }
        ?>

        <form action="" method="POST" class="border p-4 rounded shadow-sm" onsubmit="return validateForm()">
            <!-- ID Commentaire (caché, mais utilisé pour identifier le commentaire à mettre à jour) -->
            <input type="hidden" name="id" value="<?php echo $commentaire['id']; ?>">

            <div class="mb-3">
                <label for="contenu" class="form-label">Contenu du Commentaire</label>
                <textarea class="form-control" id="contenu" name="contenu" rows="4"><?php echo $commentaire['contenu']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="datec" class="form-label">Date du Commentaire</label>
                <input type="date" class="form-control" id="datec" name="datec" value="<?php echo $commentaire['datec']; ?>">
            </div>

            <div class="mb-3">
                <label for="idAvis" class="form-label">ID de l'Avis</label>
                <input type="text" class="form-control" id="idAvis" name="idAvis" value="<?php echo $commentaire['idAvis']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="action" class="form-label">Action</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="action" id="like" value="like" <?php echo $commentaire['likee'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="like">
                        Like
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="action" id="dislike" value="dislike" <?php echo $commentaire['dislike'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="dislike">
                        Dislike
                    </label>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Mettre à Jour</button>
                <a href="AfficherC.php" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </form>
    </div>
    </main>
    <script>
        function validateForm() {
            const contenu = document.getElementById("contenu").value.trim();
            const regexAlphabet = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/; // Accepte les lettres et espaces (avec accents).

            if (!regexAlphabet.test(contenu)) {
                alert("Le contenu du commentaire doit contenir uniquement des lettres.");
                return false; // Empêche la soumission du formulaire.
            }

            return true; // Le formulaire est valide.
        }
    </script>
    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
