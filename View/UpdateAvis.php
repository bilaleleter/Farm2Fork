<?php
include '../Controller/AvisC.php';
require '../Model/Avis.php';

$AvisC = new AvisC();
$Avis = null;

// Vérifiez si un ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $Avis = $AvisC->getAvisById($id);
}

if (!$Avis) {
    echo "Avis introuvable.";
    exit;
}

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $note = $_POST['rating']; // Capturer le nombre d'étoiles sélectionnées
    $type_avis = $_POST['type_avis']; // Type fixe
    $date_avis = new DateTime(); // Date actuelle automatiquement

    // Créer un objet Avis avec les nouvelles données
    $updatedAvis = new Avis($Avis['id'], $note, $type_avis, $date_avis);

    // Appeler la méthode d'update pour mettre à jour l'avis
    $AvisC->updateAvis($updatedAvis, $id);

    // Rediriger vers une autre page (ex: liste des avis ou une page de succès)
    header("Location: AfficherAvis.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à Jour de l'Avis</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main id="main" class="main">
        <section class="section">
            <div class="container mt-5">
                <div class="text-center">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mise à Jour de l'Avis</h5>

                            <?php if (!empty($error)) : ?>
                                <div class="alert alert-danger">
                                    <?= htmlspecialchars($error) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($Avis) && $Avis) : ?>
                                <form method="POST" action="">
                                    <div class="row mb-3">
                                        <label for="inputId" class="col-sm-2 col-form-label">ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="id" value="<?= htmlspecialchars($Avis['id']); ?>" readonly>
                                        </div>
                                    </div>

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

                                    
                                    <div class="row mb-3">
    <label for="inputTypeAvis" class="col-sm-2 col-form-label">Avis</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="type_avis" value="" >
    </div>
</div>

<div class="row mb-3">
    <label for="inputDateAvis" class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-10">
        <input type="date" class="form-control" name="date_avis" value="<?= (new DateTime())->format('Y-m-d'); ?>" readonly>
    </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                </form>
                            <?php else : ?>
                                <div class="alert alert-warning">
                                    Aucun avis trouvé avec cet ID.
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
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
</style>

    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>