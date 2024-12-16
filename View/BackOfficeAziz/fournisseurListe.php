<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\fournisseurController.php';
session_start();

// Messages de succès ou d'erreur
$successMessage = $_SESSION['success_message'] ?? null;
$errorMessage = $_SESSION['error_message'] ?? null;

// Effacer les messages après l'affichage
unset($_SESSION['success_message'], $_SESSION['error_message']);

$controller = new FournisseurController();
$search = $_GET['search'] ?? '';
$fournisseurs = $controller->getAllFournisseurs();

// Recherche par nom ou adresse
if ($search) {
    $fournisseurs = array_filter($fournisseurs, function ($fournisseur) use ($search) {
        $search = strtolower($search);
        return stripos($fournisseur->getNom(), $search) !== false || 
               stripos($fournisseur->getAdresse(), $search) !== false;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Fournisseurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php if ($successMessage): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($successMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($errorMessage): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($errorMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h1 class="text-center">Liste des Fournisseurs</h1>
    <div class="mb-2">
        <form method="GET">
            <input 
                type="text" 
                name="search" 
                id="searchInput" 
                class="form-control" 
                placeholder="Rechercher par nom ou adresse..." 
                value="<?= htmlspecialchars($search) ?>"
            >
            <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
        </form>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Date d'Ajout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($fournisseurs) > 0): ?>
                <?php foreach ($fournisseurs as $fournisseur): ?>
                    <tr>
                        <td><?= htmlspecialchars($fournisseur->getId()) ?></td>
                        <td><?= htmlspecialchars($fournisseur->getNom()) ?></td>
                        <td><?= htmlspecialchars($fournisseur->getAdresse()) ?></td>
                        <td><?= htmlspecialchars($fournisseur->getTelephone()) ?></td>
                        <td><?= htmlspecialchars($fournisseur->getDateajout()->format('Y-m-d')) ?></td>
                        <td>
                            <a href="updateFournisseur.php?id=<?= $fournisseur->getId() ?>" class="btn btn-warning">Modifier</a>
                            <a href="deleteFournisseur.php?id=<?= $fournisseur->getId() ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Aucun fournisseur trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <td>
    <a href="addFournisseur.php?id=<?= $fournisseur->getId() ?>" class="btn btn-success btn-sm">Ajouter</a>

    </td>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php if ($successMessage): ?>
    Swal.fire({
        icon: 'success',
        title: 'Succès',
        text: '<?= htmlspecialchars($successMessage) ?>',
        timer: 3000,
        showConfirmButton: false
    });
<?php endif; ?>

<?php if ($errorMessage): ?>
    Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: '<?= htmlspecialchars($errorMessage) ?>',
        timer: 3000,
        showConfirmButton: false
    });
<?php endif; ?>
</script>
</html>
