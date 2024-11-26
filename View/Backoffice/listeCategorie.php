<?php
include './../../Controller/CategorieController.php';
$categoriecontroller = new CategorieController();

$listc = $categoriecontroller->afficherCategories();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>Liste des catégories</title>
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
    <style>
        /* Global styling */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2rem;
            text-align: center;
            color: #ffdf70;
        }

        /* Table styling */
        table {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #ffffff;
            color: #333;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #6a11cb;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Button styles */
        .btn {
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: bold;
            color: #fff;
            transition: background 0.3s ease;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-warning {
            background-color: #f39c12;
        }

        .btn-warning:hover {
            background-color: #d35400;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }

            th, td {
                padding: 10px;
                font-size: 0.9rem;
            }
        }
    </style>
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
          <a class="nav-link text-dark" href="listeCategorie.php">
            <i class="material-symbols-rounded opacity-5">view_list</i>
            <span class="nav-link-text ms-1">Afficher les Catégories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="add.php">
            <i class="material-symbols-rounded opacity-5">add_circle</i>
           <span class="nav-link-text ms-1">Ajouter une Catégorie</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="listeCategorie.php">
            <i class="material-symbols-rounded opacity-5">edit</i>
             <span class="nav-link-text ms-1">Mettre a jour une Catégorie</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="listeCategorie.php">
            <i class="material-symbols-rounded opacity-5">delete</i>
            <span class="nav-link-text ms-1">Supprimer une Catégorie</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

    <h1>Liste des catégories</h1>
    <table>
        <thead>
            <tr>
                <th>Nom de la catégorie</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listc as $categorie) { ?>
                <tr>
                    <td><?= htmlspecialchars($categorie['nom_categorie']) ?></td>
                    <td>
                        <a href="supprimerCategorie.php?id_categorie=<?= htmlspecialchars($categorie['id_categorie']) ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                    <td>
                        <form action="updateCategorie.php" method="post" class="action-buttons">
                            <input type="hidden" name="id_categorie" value="<?= htmlspecialchars($categorie['id_categorie']) ?>">
                            <button type="submit" class="btn btn-warning">Mettre à jour</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
