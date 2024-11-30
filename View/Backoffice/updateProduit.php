<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
include '../../Controller/ProduitController.php';
include '../../Model/Produit.php';

$error = "";
$produit = null;


$produitcontroller = new ProduitController();

$categories = $produitcontroller->getAllCategories();  

if (isset($_POST["nom_produit"]) && isset($_POST["description_produit"]) && isset($_POST["prix"]) && isset($_POST["quantite_produit"]) && isset($_POST["stock_produit"])  && isset($_POST["categorie"])) {
    if (!empty($_POST["nom_produit"]) && !empty($_POST["description_produit"]) && !empty($_POST["prix"]) && !empty($_POST["quantite_produit"]) && !empty($_POST["stock_produit"]) && !empty($_POST["categorie"])) {
        
       
        $produit = new Produit(
            null,  
            $_POST['nom_produit'],
            null,  
            $_POST['description_produit'],
            $_POST['prix'],
            $_POST['quantite_produit'],
            $_POST['stock_produit'],
            $_POST['categorie']
        );

       
        if (isset($_FILES['image_produit']) && $_FILES['image_produit']['error'] == 0) {
           
            $target_dir = "uploads/"; 
            $target_file = $target_dir . basename($_FILES["image_produit"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
           
            if (move_uploaded_file($_FILES["image_produit"]["tmp_name"], $target_file)) {
                $produit->setImageProduit($target_file);
            } else {
                die("Erreur lors du téléchargement de l'image.");
            }
        } else {
           
            $produit->setImageProduit($_POST['current_image']);
        }

        
        $produitcontroller->updateProduit($produit, $_POST['id_produit']);
        
      
        header('Location: listeProduit.php');
        exit();
    } else {
        $error = "Information manquante";
    }
}

if (isset($_POST['id_produit'])) {
   
    $produit = $produitcontroller->showProduit($_POST['id_produit']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
   Mettre a jour
  </title>
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
    body {
        font-family: Arial, sans-serif;
        background-color: #e6f2e6; /* Vert très clair */
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 110vh;
    }

    h1 {
        text-align: center;
        color: #194d33; /* Vert sapin foncé */
        margin-bottom: 5px;
    }

    form {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
        box-sizing: border-box;
    }

    label {
        font-size: 16px;
        color: #194d33; /* Vert sapin foncé */
        margin-bottom: 8px;
        display: block;
    }

    input[type="text"], input[type="number"], input[type="file"], textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #88b097; /* Vert doux */
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
    }

    input[type="text"]:focus, input[type="number"]:focus, textarea:focus {
        border-color: #194d33; /* Vert sapin foncé */
        outline: none;
    }

    textarea {
        height: 100px;
        resize: vertical;
    }

    input[type="submit"] {
        background-color: #194d33; /* Vert sapin foncé */
        color: #ffffff;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #145a40; /* Vert encore plus foncé */
    }

    br {
        line-height: 20px;
    }

    label[for="categorie"] {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #194d33; /* Vert sapin foncé */
    }

    /* Style de base pour le select */
    select#categorie {
        width: 100%;
        max-width: 400px;
        padding: 10px;
        border: 1px solid #88b097; /* Vert doux */
        border-radius: 5px;
        background-color: #ffffff; /* Fond blanc */
        font-size: 16px;
        color: #194d33; /* Vert sapin foncé */
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* Style au survol */
    select#categorie:hover {
        border-color: #194d33; /* Vert sapin foncé */
    }

    /* Style au focus */
    select#categorie:focus {
        border-color: #145a40; /* Vert encore plus foncé */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        outline: none;
    }

    /* Style des options */
    select#categorie option {
        padding: 8px;
        font-size: 16px;
        background-color: #ffffff; /* Fond blanc */
        color: #194d33; /* Texte vert sapin */
    }

    /* Placeholder (option par défaut) */
    select#categorie option[value=""] {
        color: #88b097; /* Texte vert clair */
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
  <?php
if (isset($_POST['id_produit']) && $produit) {
    ?>
    <form action="" method="POST" id="form_produit" enctype="multipart/form-data">
        <h1>Mettre à jour un produit</h1>

        <label for="nom_produit">Nom du produit:</label>
        <input type="text" id="nom_produit" name="nom_produit" value="<?= htmlspecialchars($produit['nom_produit']) ?>" >

        <label for="image_produit">Image du produit:</label>
        <input type="file" id="image_produit" name="image_produit">

        <div class="current-image">
            <img src="<?= htmlspecialchars($produit['image_produit']) ?>" alt="Image actuelle" style="width: 150px; height: auto; border-radius: 8px;">
        </div>

        <label for="description_produit">Description du produit:</label>
        <textarea id="description_produit" name="description_produit"><?= htmlspecialchars($produit['description_produit']) ?></textarea>

        <label for="prix">Prix du produit:</label>
        <input type="text" id="prix" name="prix" value="<?= htmlspecialchars($produit['prix']) ?>" >

        <label for="quantite_produit">Quantité du produit:</label>
        <input type="text" id="quantite_produit" name="quantite_produit" value="<?= htmlspecialchars($produit['quantite_produit']) ?>" >

        <label for="stock_produit">Stock du produit:</label>
        <input type="text" id="stock_produit" name="stock_produit" value="<?= htmlspecialchars($produit['stock_produit']) ?>">

        <label for="categorie">Catégorie :</label>
<select id="categorie" name="categorie" >
    <option value="">-- Sélectionnez une catégorie --</option>
    <?php foreach ($categories as $categorie) { ?>
        <option value="<?= htmlspecialchars($categorie['id_categorie']) ?>" 
            <?= $produit['categorie'] == $categorie['id_categorie'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($categorie['nom_categorie']) ?>
        </option>
    <?php } ?>
</select>


        
        <br><br>
        <input type="hidden" name="id_produit" value="<?= htmlspecialchars($_POST['id_produit']) ?>">
        <input type="hidden" name="current_image" value="<?= htmlspecialchars($produit['image_produit']) ?>">

        <input type="submit" name="envoyer" value="Mettre à jour">
    </form>
    <?php
}
?>

    <script src="formulaireupdate.js"></script>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    
   
    <div class="container-fluid py-4">
      <div class="row min-vh-80 h-100">
        <div class="col-12">
          
        </div>
    </div>
    
  </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
       
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
       
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
       
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>
 
  <script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>