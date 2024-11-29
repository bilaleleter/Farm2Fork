<?php
include './../../Controller/ProduitController.php';

$produitcontroller = new ProduitController();

// Récupérer toutes les catégories
$categories = $produitcontroller->getAllCategories();

// Récupérer la liste des produits, filtrée ou non par catégorie
$id_categorie = isset($_GET['categorie']) ? $_GET['categorie'] : null;
$liste = $produitcontroller->listeProduit($id_categorie);
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
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
      <span class="ms-1 text-sm text-dark">Farm2Fork</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="./pages/dashboard.html">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="listeProduit.php">
            <i class="material-symbols-rounded opacity-5">view_list</i>
            <span class="nav-link-text ms-1">Afficher les Produits</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="ajout.php">
            <i class="material-symbols-rounded opacity-5">add_circle</i>
           <span class="nav-link-text ms-1">Ajouter un Produit</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="listeProduit.php">
            <i class="material-symbols-rounded opacity-5">edit</i>
             <span class="nav-link-text ms-1">Mettre a jour un produit</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="listeProduit.php">
            <i class="material-symbols-rounded opacity-5">delete</i>
            <span class="nav-link-text ms-1">Supprimer un produit</span>
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
        <?php foreach ($categories as $categorie) { ?>
            <option value="<?= htmlspecialchars($categorie['id_categorie']) ?>" 
                <?= ($id_categorie == $categorie['id_categorie']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($categorie['nom_categorie']) ?>
            </option>
        <?php } ?>
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
        <?php 
        // Vérification si la liste des produits est vide
        if (!empty($liste)) {
            foreach ($liste as $produit) { ?>
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
            <?php } 
        } else { ?>
            <tr>
                <td colspan="9">Aucun produit disponible</td>
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