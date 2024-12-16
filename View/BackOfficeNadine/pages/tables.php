
<?php
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\recetteControler.php';
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\nutritionControler.php';
$recetteController = new recettes();
$recipes = $recetteController->afficherecette();

$nutritionController = new nutritions();
$nutritions = $nutritionController->affichenutrition();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Material Dashboard 3 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>
<style>
  .invalid-input {
    border: 2px solid red;}
</style>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Creative Tim</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <!--<li class="nav-item">
          <a class="nav-link text-dark" href="../pages/dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeBilel\index.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Marketplace</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeNadine\pages\tables.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Recettes</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\kitchen.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Kitchen</span>
          </a>
        </li>
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
        <a class="btn btn-outline-dark mt-4 w-100" href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\consomateur_profile.php" type="button">Account</a>
        <button type="submit" class="btn bg-gradient-dark w-100" form="SignOutForm" name="logout">Sign out</button>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
     
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
          </ol>
        </nav>
       


          <ul class="navbar-nav d-flex align-items-center  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="https://www.creative-tim.com/builder?ref=navbar-material-dashboard">Online Builder</a>
            </li>
            <li class="mt-1">
              <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
              </a>
            </li>
            <li class="nav-item dropdown pe-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-symbols-rounded">notifications</i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                <i class="material-symbols-rounded">account_circle</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form method="GET" action="tables.php" class="input-group input-group-outline">
                    <input type="text" name="query" class="form-control" placeholder="Type here..." required>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
    <div>
  <?php
$results = []; // Variable to hold search results
$message = ''; // Variable to hold messages (e.g., no results)

// Check if the search query is provided
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']); // Sanitize user input

    $controller = new recettes(); // Instantiate the controller
    try {
        // Fetch results using the searchRecettes method
        $results = $controller->searchRecettes($query);

        if (empty($results)) {
            $message = 'No results found for "' . htmlspecialchars($query) . '".';
        }
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}
?>
<div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Table des recherches</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
<body>
    <div class="container">
        <!-- Search Form -->
        

        <!-- Display Results or Message -->
        <?php if (!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>

        <?php if (!empty($results)): ?>
            <h2>Search Results:</h2>
            <ul class="results-list">
                <?php foreach ($results as $result): ?>
                    <li>
                        <strong><?= htmlspecialchars($result['nomr']) ?></strong>: 
                        <?= htmlspecialchars($result['descriptionr']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>All recipes are listed below. Use the search bar above to filter recipes.</p>
        <?php endif; ?>

        <!-- Full Recipe Table -->
        </div> </div> </div>
</body>
</html>
</div>
    <!-- Table of Recipes -->
    
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Table des recettes</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nom de la Recette</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Temps</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Difficulté</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recipes as $recipe): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($recipe['idr']); ?></td>
                                        <td><?= htmlspecialchars($recipe['nomr']); ?></td>
                                        <td><?= htmlspecialchars($recipe['descriptionr']); ?></td>
                                        <td><?= htmlspecialchars($recipe['tempsr']); ?> minutes</td>
                                        <td><?= htmlspecialchars($recipe['difficulte']); ?></td>
                                        <td>
                                            <form action="update_recette.php" method="GET" style="display:inline;">
                                                <input type="hidden" name="idr" value="<?= htmlspecialchars($recipe['idr']); ?>">
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </form>
                                            <form action="delete_recette.php" method="POST" style="display:inline;">
                                                <input type="hidden" name="idr" value="<?= htmlspecialchars($recipe['idr']); ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</button>
                                            </form>
                                            <form action="details.php" method="GET" style="display:inline;">
                                                <input type="hidden" name="idr" value="<?= htmlspecialchars($recipe['idr']); ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" >Details</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- affichage nutritions -->
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Table des nutritions</h6>
                                </div>
                                </div>
                <div class="card-body">
                <table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>ID Produit</th>
            <th>ID Recette</th>
            <th>Calories</th>
            <th>Protéines (g)</th>
            <th>Glucides (g)</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($nutritions)): ?>
            <?php foreach ($nutritions as $nutrition): ?>
                <tr>
                    <td><?= htmlspecialchars($nutrition['idProduit']); ?></td>
                    <td><?= htmlspecialchars($nutrition['idr']); ?></td>
                    <td><?= htmlspecialchars($nutrition['calories']); ?></td>
                    <td><?= htmlspecialchars($nutrition['proteines']); ?></td>
                    <td><?= htmlspecialchars($nutrition['carbohydrates']); ?></td>
                    <td>
                        <!-- Bouton Modifier -->
                        <form action="update_nutrition.php" method="GET" style="display:inline;">
                            <input type="hidden" name="idProduit" value="<?= htmlspecialchars($nutrition['idProduit']); ?>">
                            <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                        </form>

                        <!-- Bouton Supprimer -->
                        <form action="delete_nutrition.php" method="POST" style="display:inline;">
                            <input type="hidden" name="idProduit" value="<?= htmlspecialchars($nutrition['idProduit']); ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette nutrition ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Aucune information nutritionnelle trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

                  
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <?php if (isset($_GET['status'])): ?>
    <div id="notification" class="notification <?= $_GET['status'] === 'success' ? 'success' : 'error'; ?>">
        <span id="notification-text">
            <?= $_GET['status'] === 'success' 
                ? "🎉 Recette ajoutée avec succès !" 
                : "⚠️ Erreur: " . htmlspecialchars($_GET['message'] ?? "Une erreur est survenue."); ?>
        </span>
        <button id="close-notification" onclick="closeNotification()">×</button>
    </div>
<?php endif; ?>

<!-- Add Recipe Form -->
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Ajout Recettes</h6>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="addrecette.php">
            <div class="form-group mb-3">
                <label for="nomr" class="form-label">Nom de la Recette</label>
                <input type="text" id="nomr" name="nomr" class="form-control form-control-lg" placeholder="Entrez le nom de la recette" required>
                <div id="error-nomr" class="error-message"></div>
            </div>
            <div class="form-group mb-3">
                <label for="descriptionr" class="form-label">Description</label>
                <textarea id="descriptionr" name="descriptionr" class="form-control form-control-lg" rows="3" placeholder="Décrivez la recette" required></textarea>
                <div id="error-descriptionr" class="error-message"></div>
            </div>
            <div class="form-group mb-3">
                <label for="tempsr" class="form-label">Temps de Préparation</label>
                <input type="number" id="tempsr" name="tempsr" class="form-control form-control-lg" placeholder="Temps en minutes" required>
                <div id="error-tempsr" class="error-message"></div>
            </div>
            <div class="form-group mb-4">
                <label for="difficulte" class="form-label">Difficulté</label>
                <select id="difficulte" name="difficulte" class="form-select form-select-lg" required>
                    <option value="">Sélectionnez une option</option>
                    <option value="Facile">Facile</option>
                    <option value="Moyen">Moyen</option>
                    <option value="Difficile">Difficile</option>
                </select>
                <div id="error-difficulte" class="error-message"></div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg w-100">Ajouter la Recette</button>
            </div>
        </form>
    </div>
</div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <!-- Email Form -->
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Envoi d'email</h6>
                </div>
            </div>
            <div class="card-body">
            <form method="POST" action="test.php">
    <div class="form-group mb-3">
        <label for="adresse" class="form-label">Email Address</label>
        <input 
            type="email" 
            id="adresse" 
            name="adresse" 
            class="form-control form-control-lg" 
            placeholder="Entrez l'email" 
            required
        >
        <div class="error-message" id="emailError"></div>

    </div>

    <!-- Subject -->
    <div class="form-group mb-3">
        <label for="objet" class="form-label">Subject</label>
        <input 
            type="text" 
            id="objet" 
            name="subject" 
            class="form-control form-control-lg" 
            placeholder="Entrez l'objet" 
            required
        >
        <div class="error-message" id="subjectError"></div>

    </div>

    <!-- Message -->
    <div class="form-group mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea 
            id="message" 
            name="message" 
            class="form-control form-control-lg" 
            rows="4" 
            placeholder="Entrez le message" 
            required
        ></textarea>
        <div class="error-message" id="messageError"></div>

    </div>

    <!-- Submit Button -->
    <div class="text-center">
        <button type="submit" name="send" value="submit" class="btn btn-success btn-lg w-100">Envoyer un email</button>
    </div>
</form>
            </div>
        </div>
    </div>
</div>

<style>
    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
    }
        .notification {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
        }
        .notification.success {
            background-color: #d4edda;
            color: #155724;
        }
        .notification.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    
</style>


 

      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
              <div>
  <div>
  <form action="pdf.php"  style="display:inline;">
  <button type="submit" class="btn btn-danger btn-sm" >Imprimer</button>
 </form>
  </div>
</div>
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-symbols-rounded py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-symbols-rounded">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark active" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2  active ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="validation.js"></script>
  <script src="validemail.js"></script>
  <script>
    // Close notification function
    function closeNotification() {
        const notification = document.getElementById("notification");
        notification.style.animation = "fade-out 0.5s ease-out";
        setTimeout(() => notification.remove(), 500); // Remove after fade-out
    }

    // Auto-close notification after 5 seconds
    setTimeout(() => {
        const notification = document.getElementById("notification");
        if (notification) {
            closeNotification();
        }
    }, 5000);
</script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
  

</body>

</html>