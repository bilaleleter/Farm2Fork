<?php

session_start();

if (!isset($_SESSION['email'])) {
  $_SESSION = array();
  session_destroy();
  header("Location: ../../../FrontOfficeUser/sign_in.php");
  exit;
}

// Check if logout has been requested
if (isset($_POST['logout'])) {
  // Destroy the session
  $_SESSION = array();
  session_destroy();

  // Redirect to the login page
  header("Location: ../../../FrontOfficeUser/start_page.php");
  exit;
}

require_once '../../../../Controller/UserController.php';  // Adjust path as needed
$userController = new UserController();
$consommateurs = $userController->getConsommateurs();
$agriculteurs = $userController->getAgriculteurs();

?>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
  <title>Admin - Gestion Utilisateur</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css" rel="stylesheet" />
</head>

<style>
  label {
    color: #e91e63 !important;
  }
  <style>
        /* Add hover effect for table rows */
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
  </style>
</style>

<body class="g-sidenav-show bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
        target="_blank">
        <img src="../../../FrontOfficeUser/assets/img/farm2fork v1.png" class="navbar-brand-img" alt="main_logo" />
        <span class="ms-1 text-sm text-dark">Farm2Fork</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2" />
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <!--<li class="nav-item">
          <a class="nav-link text-dark" href="../pages/dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/user_management.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Gestion Utilisateurs</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="../pages/gestion_fournisseur.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Gestion Fournisseurs</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="../pages/gestion_factures.php">
                <i class="material-symbols-rounded opacity-5">table_view</i>
                <span class="nav-link-text ms-1">Gestion Factures</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeAmal\commandes\commande.php">
                <i class="material-symbols-rounded opacity-5">table_view</i>
                <span class="nav-link-text ms-1">Gestion Commandes</span>
            </a>
        </li>

        <!--<li class="nav-item">
          <a class="nav-link text-dark" href="../pages/logs.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Logs</span>
          </a>
        </li>-->
        <!--
          <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account</h6>
          </li>
          -->
      </ul>
    </div>
    <form method="post" name="SignOutForm" id="SignOutForm"></form>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3">
        <button type="submit" class="btn bg-gradient-dark w-100" form="SignOutForm" name="logout">Sign out</button>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
              Gestion Fournisseur
            </li>
          </ol>
        </nav>

      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="container mt-5">
        <?php
        include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\fournisseurController.php';

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
            <input type="text" name="search" id="searchInput" class="form-control"
              placeholder="Rechercher par nom ou adresse..." value="<?= htmlspecialchars($search) ?>"
              aria-label="Search by name or address">
            <button type="submit" class="btn btn-primary mt-2" aria-label="Search">Rechercher</button>
          </form>
        </div>

        <div class="mb-2 text-end">
          <a href="../pages/gestion_factures.php" class="btn btn-primary mt-2" aria-label="Liste Factures">Liste des Factures</a>
        </div>
        <div class="mb-2 text-end">
          <a href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeAziz\addFournisseur.php" class="btn btn-success" aria-label="Ajout Fournisseur">Ajouter un Fournisseur</a>
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
                    <a href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeAziz\updateFournisseur.php?id=<?= $fournisseur->getId() ?>" class="btn btn-warning"
                      aria-label="Edit Supplier">Modifier</a>
                    <a href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeAziz\deleteFournisseur.php?id=<?= $fournisseur->getId() ?>" class="btn btn-danger"
                      aria-label="Delete Supplier">Supprimer</a>
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
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
      var win = navigator.platform.indexOf("Win") > -1;
      if (win && document.querySelector("#sidenav-scrollbar")) {
        var options = {
          damping: "0.5",
        };
        Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
      }
    </script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
    <!-- USER ADD SCRIPT FORM-->

</body>

</html>