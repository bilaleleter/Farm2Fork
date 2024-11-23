<?php
include './../../Controller/ProduitController.php';
$produitcontroller = new ProduitController();

$categorieId = isset($_GET['categorie']) ? $_GET['categorie'] : null;

// Récupérer la liste des produits, filtrée ou non par catégorie
$liste = $produitcontroller->listeProduit($categorieId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Liste de produit
  </title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="./assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Farm2Fork Dashboard</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="./pages/dashboard.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">First page</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="listeProduit.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">Afficher les produits</i>
            </div>
            <span class="nav-link-text ms-1">Affichage</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="ajout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">Ajouter un produit</i>
            </div>
            <span class="nav-link-text ms-1">Ajout</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="supprimerProduit.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">Supprimer un produit</i>
            </div>
            <span class="nav-link-text ms-1">Suppression</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="listeProduit.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">Mettre a jour un produit</i>
            </div>
            <span class="nav-link-text ms-1">Mise a jour</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h4>Liste des produits</h4>
            </div>
            <form method="GET" action="listeProduit.php">
    <label for="categorie">Filtrer par catégorie :</label>
    <select name="categorie" id="categorie">
        <option value="">Toutes les catégories</option>
        <option value="1" <?= $categorieId == 1 ? 'selected' : '' ?>>Fruits et Légumes</option>
        <option value="2" <?= $categorieId == 2 ? 'selected' : '' ?>>Produits Laitiers</option>
        <option value="3" <?= $categorieId == 3 ? 'selected' : '' ?>>Viandes</option>
    </select>
    <button type="submit">Filtrer</button>
          </form>
            <div class="card-body">
              <table class="table table-bordered align-middle text-center">
                <thead>
                  <tr>
                    <th>Nom du produit</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Stock</th>
                    <th>Catégorie</th>
                    <th colspan="2">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($liste as $produit) { ?>
                    <tr>
                      <td><?= htmlspecialchars($produit['nom_produit']) ?></td>
                      <td><img src="<?= htmlspecialchars($produit['image_produit']) ?>" alt="<?= htmlspecialchars($produit['nom_produit']) ?>" style="width:100px;height:auto;"></td>
                      <td><?= htmlspecialchars($produit['description_produit']) ?></td>
                      <td><?= htmlspecialchars($produit['prix']) ?>$</td>
                      <td><?= htmlspecialchars($produit['quantite_produit']) ?></td>
                      <td><?= htmlspecialchars($produit['stock_produit']) ?></td>
                      <td><?= htmlspecialchars($produit['nom_categorie']) ?></td>
                      <td>
                        <a href="supprimerProduit.php?id_produit=<?= htmlspecialchars($produit['id_produit']) ?>" class="btn btn-danger btn-sm">Supprimer</a>
                      </td>
                      <td>
                        <form action="updateProduit.php" method="post">
                          <input type="hidden" name="id_produit" value="<?= htmlspecialchars($produit['id_produit']) ?>">
                          <button type="submit" class="btn btn-warning btn-sm">Mettre à jour</button>
                        </form>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
</body>

</html>
