<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Material Dashboard 3 by Creative Tim</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
    <style>
        /* Add hover effect for table rows */
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard" target="_blank">
        <img src="assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Creative Tim</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="factureListe.php">
            <i class="material-symbols-rounded opacity-5">Tables</i>
          </a>
        </li>
        <!-- Other nav items -->
      </ul>
    </div>
</aside>
    
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
        <!-- Navbar content -->
      </div>
    </nav>
    <div class="container-fluid py-2">
        <div class="container mt-5">
            <?php
            include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\fournisseurController.php';
            session_start();

            // Messages de succès ou d'erreur
            $successMessage = $_SESSION['success_message'] ?? null;
            $errorMessage = $_SESSION['error_message'] ?? null;

            // Effacer les messages après l'affichage
            unset($_SESSION['success_message'], $_SESSION['error_message']);

            $controller = new FournisseurController();
            $search = htmlspecialchars($_GET['search'] ?? '');
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
                        aria-label="Search by name or address"
                    >
                    <button type="submit" class="btn btn-primary mt-2" aria-label="Search">Rechercher</button>
                </form>
            </div>

            <div class="mb-2 text-end">
                <a href="factureListe.php" class="btn btn-primary mt-2" aria-label="Liste Factures">Liste des Factures</a>
            </div>
            <div class="mb-2 text-end">
                <a href="addFournisseur.php" class="btn btn-success" aria-label="Ajout Fournisseur">Ajouter un Fournisseur</a>
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
                                    <a href="updateFournisseur.php?id=<?= $fournisseur->getId() ?>" class="btn btn-warning" aria-label="Edit Supplier">Modifier</a>
                                    <a href="deleteFournisseur.php?id=<?= $fournisseur->getId() ?>" class="btn btn-danger" aria-label="Delete Supplier">Supprimer</a>
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
        </div>
    </div>
</main>
    
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
</body>
</html>