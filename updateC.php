<?php

include '../Controller/CommentaireC.php';
require '../Model/Commentaire.php';


$error = "";
$com= null;
$comC = new CommentaireC();
if ( 
    isset($_POST["contenu"]) &&
    isset($_POST["datec"]) &&
    isset($_POST["idAvis"]) 
   
) {
    if (
        
        !empty($_POST["contenu"]) &&
        !empty($_POST["datec"]) &&
        !empty($_POST["idAvis"]) 
        
    ) { $com = new Commentaire(
        null,
        $_POST['contenu'],
        new DateTime($_POST['datec']),
        $_POST['idAvis']
                 
    );
    $comC->updateC($com,$_POST["id"]);
    header('Location:AfficherC.php');
} else
    $error = "Missing information";
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à Jour un Commentaire</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
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

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Mettre à Jour</button>
                <a href="AfficherC.php" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </form>
    </div>
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
