<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\fournisseurController.php';
session_start();

// Générer un token CSRF si nécessaire
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$fournisseurController = new FournisseurController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Vérifier le token CSRF
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error_message'] = "Requête invalide (protection CSRF).";
            header('Location: \Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\gestion_fournisseur.php');
            exit();
        }
        
        // Réinitialiser le token après validation
        unset($_SESSION['csrf_token']);

        // Création d'un nouvel objet Fournisseur
        $fournisseur = new Fournisseur(
            null,
            $_POST['nom'],
            $_POST['adresse'],
            $_POST['telephone'],
            new DateTime($_POST['dateajout'])
        );

        // Ajout du fournisseur
        $fournisseurController->addFournisseur($fournisseur);

        // Définir un message de succès et redirection
        $_SESSION['success_message'] = "Fournisseur ajouté avec succès.";
        header('Location: \Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\gestion_fournisseur.php');
        exit();
    } catch (Exception $e) {
        // En cas d'erreur
        $_SESSION['error_message'] = "Erreur lors de l'ajout : " . $e->getMessage();
        header('Location: \Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\gestion_fournisseur.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Fournisseur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Ajouter un Fournisseur</h1>
    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
        <div class="mb-3">
            <label for="dateajout" class="form-label">Date d'Ajout</label>
            <input type="date" class="form-control" id="dateajout" name="dateajout" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\gestion_fournisseur.php" class="btn btn-secondary">Retour</a>
    </form>
</div>
</body>
</html>
