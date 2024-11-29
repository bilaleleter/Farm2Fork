<?php
include_once '../../Controller/CategorieController.php';
include_once '../../Model/Categorie.php';

$error = "";
$categorie = null;


$categoriecontroller = new CategorieController();

if (isset($_POST["nom_categorie"])) {
    if (!empty($_POST["nom_categorie"])) {
        
       
        $categorie = new Categorie(
            null,  
            $_POST['nom_categorie']
        );

        $categoriecontroller->updateCategorie($categorie, $_POST['id_categorie']);
        
      
        header('Location: listeCategorie.php');
        exit();
    } else {
        $error = "Information manquante";
    }
}

if (isset($_POST['id_categorie'])) {
   
    $categorie = $categoriecontroller->showCategorie($_POST['id_categorie']);
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>Mettre à jour la catégorie</title>
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
        background: linear-gradient(to right, #f4d03f, #f5b041); /* Yellow-sand gradient */
        color: #fff;
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        background-color: #fffbea; /* Light sand background */
        color: #333;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 500px;
    }

    h1 {
        text-align: center;
        color: #f4d03f; /* Sand-yellow for headings */
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    label {
        font-size: 1rem;
        margin-bottom: 8px;
        display: block;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #f7dc6f; /* Light sand-yellow for input border */
        border-radius: 5px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    input[type="text"]:focus {
        border-color: #f4d03f; /* Sand-yellow for focused input */
        outline: none;
    }

    button {
        background-color: #f4d03f; /* Sand-yellow for button */
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s ease;
        width: 100%;
    }

    button:hover {
        background-color: #f5b041; /* Slightly darker sand for hover effect */
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .form-container {
            padding: 15px;
            width: 90%;
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
    <div class="form-container">
        <h1>Mettre à jour la catégorie</h1>
        <form action="updateCategorie.php" method="POST" id="form_categorie_update">
            <label for="nom_categorie">Nom de la catégorie:</label>
            <input type="text" id="nom_categorie" name="nom_categorie" value="<?= htmlspecialchars($categorie['nom_categorie']) ?>" required>
            <input type="hidden" name="id_categorie" value="<?= htmlspecialchars($categorie['id_categorie']) ?>">
            <button type="submit">Mettre à jour</button>
        </form>
    </div>

   
    <script src="formulairecategorieupdate.js"></script>
</body>
</html>

