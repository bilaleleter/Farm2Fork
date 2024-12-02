<?php

include '../Controller/CommentaireC.php';
require '../Model/Commentaire.php';

$error = "";
$com = null;
$comC = new CommentaireC();

// Vérifier si l'ID de l'avis est passé dans l'URL
$idAvis = isset($_GET['id']) ? $_GET['id'] : null;

// Vérifier si le formulaire est soumis
if (
    isset($_POST["contenu"]) &&
    isset($_POST["datec"]) &&
    isset($_POST["idAvis"])
) {
    if (
        !empty($_POST["contenu"]) &&
        !empty($_POST["datec"]) &&
        !empty($_POST["idAvis"])
    ) {
        // Créer un objet Commentaire
        $com = new Commentaire(
            null,
            $_POST['contenu'],
            new DateTime($_POST['datec']),
            $_POST['idAvis']
        );

        // Ajouter le commentaire
        $comC->addC($com);

        // Rediriger vers la liste des commentaires
        header('Location: AfficherC.php');
        exit;
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Commentaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Fonction pour valider le formulaire
        function validateForm() {
            const contenu = document.getElementById("contenu").value.trim();
            const regexAlphabet = /^[A-Za-z\s]+$/;

            if (!regexAlphabet.test(contenu)) {
                alert("Le contenu du commentaire doit contenir uniquement des lettres.");
                return false;
            }

            return true; // Formulaire valide
        }

        // Définir la date actuelle automatiquement
        window.onload = function () {
            const dateField = document.getElementById("datec");
            const today = new Date().toISOString().split("T")[0];
            dateField.value = today;
        };
    </script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Ajouter un Commentaire</h1>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="border p-4 rounded shadow-sm" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="contenu" class="form-label">Contenu du Commentaire</label>
                <textarea class="form-control" id="contenu" name="contenu" rows="4" placeholder="Entrez votre commentaire ici..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="datec" class="form-label">Date du Commentaire</label>
                <input type="date" class="form-control" id="datec" name="datec" readonly>
            </div>

            <div class="mb-3">
                <label for="idAvis" class="form-label">ID de l'Avis</label>
                <input type="text" class="form-control" id="idAvis" name="idAvis" value="<?= htmlspecialchars($idAvis); ?>" readonly>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Ajouter Commentaire</button>
                <a href="AfficherC.php" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

