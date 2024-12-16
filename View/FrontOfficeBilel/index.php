<?php
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\ProduitController.php';

$produitcontroller = new ProduitController();


$categorieId = isset($_GET['categorie']) ? intval($_GET['categorie']) : null;

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';


$liste = $categorieId ? $produitcontroller->listeProduit($categorieId, $searchTerm) : $produitcontroller->listeProduit(null, $searchTerm);



$categories = $produitcontroller->getAllCategories();


session_start();

if (!isset($_SESSION['email'])) {
  $_SESSION = array();
  session_destroy();
  header("Location: \Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeUser\sign_in.php");
  exit;
}

// Check if logout has been requested
if (isset($_POST['logout'])) {
  $_SESSION = array();
  session_destroy();
  header("Location: \Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeUser\start_page.php");
  exit;
}
require_once '../../Controller/UserController.php';  // Adjust path as needed
$userController = new UserController();
$user = $userController->getUserByEmail($_SESSION['email']);
if ($user == null) {
  echo "error getting user info";
  exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'viderPanier') {

  unset($_SESSION['panier']);

  header('Location: index.php');
  exit();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produit']) && isset($_POST['quantite'])) {

  $id_produit = $_POST['id_produit'];
  $quantite = $_POST['quantite'];


  if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
  }


  if (isset($_SESSION['panier'][$id_produit])) {
    $_SESSION['panier'][$id_produit] += $quantite;
  } else {

    $_SESSION['panier'][$id_produit] = $quantite;
  }
}

$tri = isset($_GET['tri']) ? $_GET['tri'] : '';

if ($tri === 'alphabet') {
  usort($liste, fn($a, $b) => strcasecmp($a['nom_produit'], $b['nom_produit']));
} else if ($tri === 'prix_asc') {
  usort($liste, fn($a, $b) => $a['prix'] <=> $b['prix']);
} else if ($tri === 'prix_desc') {
  usort($liste, fn($a, $b) => $b['prix'] <=> $a['prix']);
}

if (!isset($_SESSION['favoris'])) {
  $_SESSION['favoris'] = [];
}

// Gestion des actions sur les favoris
if (isset($_GET['action']) && isset($_GET['id_produit'])) {
  $id_produit = (int) $_GET['id_produit'];

  if ($_GET['action'] === 'add_favoris') {
    // Ajouter aux favoris si pas déjà présent
    if (!in_array($id_produit, $_SESSION['favoris'])) {
      $_SESSION['favoris'][] = $id_produit;
    }
  } elseif ($_GET['action'] === 'remove_favoris') {
    // Retirer des favoris
    $_SESSION['favoris'] = array_filter($_SESSION['favoris'], fn($id) => $id != $id_produit);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Farm2Fork</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">

  <link rel="icon" href="/images/icon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/vendor.css">
  <link rel="stylesheet" type="text/css" href="style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    .filter-form {
      display: flex;
      align-items: center;
      background-color: #fff8e1;
      /* Couleur inspirée de l'image */
      padding: 10px 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .filter-form label {
      margin-right: 10px;
      font-weight: bold;
      color: #4caf50;
      /* Vert pour rappeler le branding */
      font-size: 16px;
    }

    .filter-form select {
      border: 2px solid #4caf50;
      border-radius: 8px;
      padding: 8px 12px;
      margin-right: 10px;
      font-size: 14px;
      color: #4caf50;
      background: #ffffff;
    }

    .filter-form button {
      background-color: #ff9800;
      /* Orange vif pour contraster */
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 8px 16px;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .filter-form button:hover {
      background-color: #e68900;
    }

    .product-item h3 {
      font-size: 1rem;
      font-weight: 500;
      color: #444;
      margin: 15px 10px 10px;
    }

    .text-muted {
      color: #6c757d !important;
    }

    .small {
      font-size: 0.9rem;
    }

    .fw-semibold {
      font-weight: 600;
    }

    .modal-body img {
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-title {
      font-size: 1.5rem;
      font-weight: 600;
    }

    .modal-body p {
      margin: 10px 0;
      font-size: 1rem;
    }

    .tab-image {
      width: 100%;
      /* Ensures the image takes the full width of its container */
      height: auto;
      /* Maintains aspect ratio */
      max-height: 200px;
      /* Limits the maximum height */
      object-fit: cover;
      /* Ensures the image fills the box without distortion */
      border-radius: 8px;
      /* Optional: Adds rounded corners */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      /* Optional: Adds shadow for a polished look */
    }

    /* Image in modal */
    .modal-body img {
      max-width: 100%;
      /* Ensures the image fits within the modal's width */
      height: auto;
      /* Maintains aspect ratio */
      max-height: 400px;
      /* Limits the maximum height of the image in the modal */
      object-fit: contain;
      /* Ensures the image stays within bounds without cutting off content */
      border-radius: 8px;
    }

    /* Style personnalisé pour réduire la taille de l'espace de saisie */
    #search {
      border-radius: 15px;
      /* Coins arrondis */
      padding-left: 30px;
      /* Décalage pour l'icône */
      font-size: 14px;
      /* Taille du texte dans le champ de recherche */
      height: 35px;
      /* Réduire la hauteur du champ */
      width: 200px;
      /* Largeur plus petite */
    }

    /* Supprimer le fond bleu sur l'icône de recherche */
    .input-group-text {
      background-color: transparent;
      /* Retirer la couleur de fond */
      color: #333;
      /* Icône noire ou grise */
      border: 1px solid #ccc;
      /* Ajouter une bordure gris clair */
    }

    /* Ajout d'une bordure fine autour de l'input sans l'icône */
    .input-group .form-control {
      border-left: none;
      /* Retirer la bordure gauche pour éviter la double bordure */
      border: 1px solid #ccc;
      /* Bordure grise autour du champ de texte */
    }

    .compare-form button:hover {
      background-color: #218838;
      /* Changement de couleur au survol */
      transform: scale(1.05);
      /* Légère augmentation de taille au survol */
    }

    /* Styles pour le modal "À propos de nous" */
    .about-modal .modal-content {
      background-color: #fdf2e7;
      /* Beige clair */
      padding: 20px;
      border-radius: 15px;
      max-width: 600px;
      width: 90%;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      color: #1c5739;
      /* Vert sapin pour le texte */
      animation: slideIn 0.4s ease-out;
    }

    /* Titre du modal */
    .about-modal-title {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 15px;
      color: #ead885;
      /* Jaune sable */
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }

    /* Texte du modal */
    .about-modal-body {
      font-size: 1.1rem;
      line-height: 1.8;
      margin-bottom: 20px;
      color: #1c5739;
      /* Texte en vert sapin */
    }

    /* Bouton de fermeture */
    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      font-weight: bold;
      color: #fdf2e7;
      /* Blanc cassé pour le bouton */
      cursor: pointer;
      background: #1c5739;
      /* Vert sapin */
      border: none;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .close-btn:hover {
      transform: scale(1.2);
      /* Effet de zoom au survol */
      background: #ead885;
      /* Jaune sable */
      color: #1c5739;
      /* Vert sapin */
    }

    /* Animation d'ouverture */
    @keyframes slideIn {
      0% {
        transform: translateY(-50%);
        opacity: 0;
      }

      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    /* recettes nadine css*/
    .recipe {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 16px;
  margin: 16px;
  background-color: #f9f9f9;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.recipe h2 {
  font-size: 20px;
  color: #007bff;
  margin-bottom: 8px;
}

.recipe p {
  font-size: 14px;
  margin: 4px 0;
}

.recipe .details-link {
  display: inline-block;
  margin-top: 8px;
  padding: 8px 16px;
  background-color: #007bff;
  color: white;
  text-decoration: none;
  border-radius: 4px;
  transition: background-color 0.3s ease;
}

.recipe .details-link:hover {
  background-color: #0056b3;
}

.swiper {
  padding: 20px 0;
}

.swiper-slide {
  width: 300px !important; /* Adjust card width as needed */
}

.swiper-button-next,
.swiper-button-prev {
  padding-right: 50px;
  color: #007bff;
}
  </style>

</head>

<body style="background-color: #fdf2e7;">

  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <defs>
      <symbol xmlns="http://www.w3.org/2000/svg" id="mail" viewBox="0 0 24 24">
        <rect x="2" y="4" width="20" height="2" fill="currentColor" />
        <path fill="currentColor" d="M12 13l10-6V6l-10 6-10-6v1l10 6 10-6z" />
        <path fill="currentColor" d="M2 8v8c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8l-10 6-10-6z" />
      </symbol>

      <symbol xmlns="http://www.w3.org/2000/svg" id="menu" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1m0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1m1 5.033a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="link" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="category" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="check" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="trash" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 15 15">
        <path fill="currentColor"
          d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
      </symbol>

      <symbol xmlns="http://www.w3.org/2000/svg" id="package" viewBox="0 0 48 48">
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="m24 13.264l7.288 4.21L24 21.681l-7.288-4.209Z" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="M16.712 17.473v8.418L24 30.101l7.288-4.21v-8.418M24 30.1v-8.418" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="M40.905 21.405a16.905 16.905 0 1 0-23.389 15.611L24 43.5l6.484-6.484a16.906 16.906 0 0 0 10.42-15.611" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="secure" viewBox="0 0 48 48">
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="M14.134 36V20.11h19.732M19.279 36h14.587V25.45" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="m19.246 26.606l4.135 4.135l5.373-5.372m-8.934-9.282a4.087 4.087 0 1 1 8.174 0m0 0v4.023m-8.172-4.108v4.108" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="M30.288 44.566a21.516 21.516 0 1 1 9.69-6.18" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="quality" viewBox="0 0 48 48">
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="m30.59 13.45l4.77 2.94L24 34.68l-10.33-7l3.11-4.6l5.52 3.71l8.26-13.38Z" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="M24 4.5s-11.26 2-15.25 2v20a11.16 11.16 0 0 0 .8 4.1a15 15 0 0 0 2 3.61a22 22 0 0 0 2.81 3.07a34.47 34.47 0 0 0 3 2.48a34 34 0 0 0 2.89 1.86c1 .59 1.71 1 2.13 1.19l1 .49a1.44 1.44 0 0 0 1.24 0l1-.49c.42-.2 1.13-.6 2.13-1.19a34 34 0 0 0 2.89-1.86a34.47 34.47 0 0 0 3-2.48a22 22 0 0 0 2.81-3.07a15 15 0 0 0 2-3.61a11.16 11.16 0 0 0 .8-4.1v-20c-3.99.03-15.25-2-15.25-2" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="savings" viewBox="0 0 48 48">
        <circle cx="24" cy="24" r="21.5" fill="none" stroke="currentColor" stroke-linecap="round"
          stroke-linejoin="round" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="M12.5 23.684a3.298 3.298 0 0 1 5.63-2.332l3.212 3.212h0l8.53-8.53a3.298 3.298 0 0 1 5.628 2.333h0c0 .875-.348 1.714-.966 2.333L22.983 32.25a2.321 2.321 0 0 1-3.283 0l-6.234-6.233a3.298 3.298 0 0 1-.966-2.333" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="offers" viewBox="0 0 48 48">
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="m41.556 39.297l-22.022 3.11a1.097 1.097 0 0 1-1.245-.97l-2.352-22.311a1.097 1.097 0 0 1 1.08-1.213l24.238-.229a1.097 1.097 0 0 1 1.108 1.09l.137 19.429c.004.55-.4 1.017-.944 1.094M26.1 25.258v2.579m8.494-2.731v2.175" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="M34.343 32.346c-1.437.828-1.926 1.198-2.774 1.988c-1.19-.457-2.284-1.228-3.797-1.456m-15.953 8.721l-3.49-1.6a1.12 1.12 0 0 1-.643-.863L5.511 23.593c-.056-.4.108-.8.43-1.046l3.15-2.406a1.257 1.257 0 0 1 2.014.874l1.966 19.69a.887.887 0 0 1-1.252.894m11.989-28.112c.214-.456.964-1.716 2.76-3.618c3.108-3.323 4.26-4.288 4.26-4.288s1.42.75 3.27 3.109c1.876 2.358 1.93 3.832 1.93 3.832s.67-.08-4.797 1.688c-3.055.991-4.368 1.152-4.931 1.152" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="M26.97 17.828v-.054c0-.884-.241-1.715-.67-2.412c-.563-.91-1.447-1.608-2.492-1.876a3.58 3.58 0 0 0-1.072-.16c-.429 0-.858.053-1.233.214c-1.152.348-2.063 1.18-2.573 2.278a4.747 4.747 0 0 0-.428 1.956v.134" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
          d="M18.93 15.818c-.562-.107-1.5-.349-3.135-.884c-2.304-.75-3.43-1.528-3.43-1.528s-.456-1.393 1.045-3.296s2.653-2.52 2.653-2.52s.911.778 3.43 3.485c1.26 1.313 1.796 2.09 2.01 2.465h.027" />
      </symbol>

      <symbol xmlns="http://www.w3.org/2000/svg" id="delivery" viewBox="0 0 32 32">
        <path fill="currentColor"
          d="m29.92 16.61l-3-7A1 1 0 0 0 26 9h-3V7a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v17a1 1 0 0 0 1 1h2.14a4 4 0 0 0 7.72 0h6.28a4 4 0 0 0 7.72 0H29a1 1 0 0 0 1-1v-7a1 1 0 0 0-.08-.39M23 11h2.34l2.14 5H23ZM9 26a2 2 0 1 1 2-2a2 2 0 0 1-2 2m10.14-3h-6.28a4 4 0 0 0-7.72 0H4V8h17v12.56A4 4 0 0 0 19.14 23M23 26a2 2 0 1 1 2-2a2 2 0 0 1-2 2m5-3h-1.14A4 4 0 0 0 23 20v-2h5Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="organic" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M0 2.84c1.402 2.71 1.445 5.241 2.977 10.4c1.855 5.341 8.703 5.701 9.21 5.711c.46.726 1.513 1.704 3.926 2.21l.268-1.272c-2.082-.436-2.844-1.239-3.106-1.68l-.005.006c.087-.484 1.523-5.377-1.323-9.352C7.182 3.583 0 2.84 0 2.84m24 .84c-3.898.611-4.293-.92-11.473 3.093a11.879 11.879 0 0 1 2.625 10.05c3.723-1.486 5.166-3.976 5.606-6.466c0 0 1.27-4.716 3.242-6.677M12.527 6.773l-.002-.002v.004zM2.643 5.22s5.422 1.426 8.543 11.543c-2.945-.889-4.203-3.796-4.63-5.168h.006a15.863 15.863 0 0 0-3.92-6.375z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="fresh" viewBox="0 0 24 24">
        <g fill="none">
          <path
            d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
          <path fill="currentColor"
            d="M20 9a1 1 0 0 1 1 1v1a8 8 0 0 1-8 8H9.414l.793.793a1 1 0 0 1-1.414 1.414l-2.496-2.496a.997.997 0 0 1-.287-.567L6 17.991a.996.996 0 0 1 .237-.638l.056-.06l2.5-2.5a1 1 0 0 1 1.414 1.414L9.414 17H13a6 6 0 0 0 6-6v-1a1 1 0 0 1 1-1m-4.793-6.207l2.5 2.5a1 1 0 0 1 0 1.414l-2.5 2.5a1 1 0 1 1-1.414-1.414L14.586 7H11a6 6 0 0 0-6 6v1a1 1 0 1 1-2 0v-1a8 8 0 0 1 8-8h3.586l-.793-.793a1 1 0 0 1 1.414-1.414" />
        </g>
      </symbol>

      <symbol xmlns="http://www.w3.org/2000/svg" id="star-full" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="m3.1 11.3l3.6 3.3l-1 4.6c-.1.6.1 1.2.6 1.5c.2.2.5.3.8.3c.2 0 .4 0 .6-.1c0 0 .1 0 .1-.1l4.1-2.3l4.1 2.3s.1 0 .1.1c.5.2 1.1.2 1.5-.1c.5-.3.7-.9.6-1.5l-1-4.6c.4-.3 1-.9 1.6-1.5l1.9-1.7l.1-.1c.4-.4.5-1 .3-1.5s-.6-.9-1.2-1h-.1l-4.7-.5l-1.9-4.3s0-.1-.1-.1c-.1-.7-.6-1-1.1-1c-.5 0-1 .3-1.3.8c0 0 0 .1-.1.1L8.7 8.2L4 8.7h-.1c-.5.1-1 .5-1.2 1c-.1.6 0 1.2.4 1.6" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="star-half" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="m3.1 11.3l3.6 3.3l-1 4.6c-.1.6.1 1.2.6 1.5c.2.2.5.3.8.3c.2 0 .4 0 .6-.1c0 0 .1 0 .1-.1l4.1-2.3l4.1 2.3s.1 0 .1.1c.5.2 1.1.2 1.5-.1c.5-.3.7-.9.6-1.5l-1-4.6c.4-.3 1-.9 1.6-1.5l1.9-1.7l.1-.1c.4-.4.5-1 .3-1.5s-.6-.9-1.2-1h-.1l-4.7-.5l-1.9-4.3s0-.1-.1-.1c-.1-.7-.6-1-1.1-1c-.5 0-1 .3-1.3.8c0 0 0 .1-.1.1L8.7 8.2L4 8.7h-.1c-.5.1-1 .5-1.2 1c-.1.6 0 1.2.4 1.6m8.9 5V5.8l1.7 3.8c.1.3.5.5.8.6l4.2.5l-3.1 2.8c-.3.2-.4.6-.3 1c0 .2.5 2.2.8 4.1l-3.6-2.1c-.2-.2-.3-.2-.5-.2" />
      </symbol>

      <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="12" cy="9" r="3" />
          <circle cx="12" cy="12" r="10" />
          <path stroke-linecap="round" d="M17.97 20c-.16-2.892-1.045-5-5.97-5s-5.81 2.108-5.97 5" />
        </g>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="wishlist" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1.5">
          <path
            d="M21 16.09v-4.992c0-4.29 0-6.433-1.318-7.766C18.364 2 16.242 2 12 2C7.757 2 5.636 2 4.318 3.332C3 4.665 3 6.81 3 11.098v4.993c0 3.096 0 4.645.734 5.321c.35.323.792.526 1.263.58c.987.113 2.14-.907 4.445-2.946c1.02-.901 1.529-1.352 2.118-1.47c.29-.06.59-.06.88 0c.59.118 1.099.569 2.118 1.47c2.305 2.039 3.458 3.059 4.445 2.945c.47-.053.913-.256 1.263-.579c.734-.676.734-2.224.734-5.321Z" />
          <path stroke-linecap="round" d="M15 6H9" />
        </g>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="shopping-bag" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1.5">
          <path
            d="M3.864 16.455c-.858-3.432-1.287-5.147-.386-6.301C4.378 9 6.148 9 9.685 9h4.63c3.538 0 5.306 0 6.207 1.154c.901 1.153.472 2.87-.386 6.301c-.546 2.183-.818 3.274-1.632 3.91c-.814.635-1.939.635-4.189.635h-4.63c-2.25 0-3.375 0-4.189-.635c-.814-.636-1.087-1.727-1.632-3.91Z" />
          <path
            d="m19.5 9.5l-.71-2.605c-.274-1.005-.411-1.507-.692-1.886A2.5 2.5 0 0 0 17 4.172C16.56 4 16.04 4 15 4M4.5 9.5l.71-2.605c.274-1.005.411-1.507.692-1.886A2.5 2.5 0 0 1 7 4.172C7.44 4 7.96 4 9 4" />
          <path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2h-4a1 1 0 0 1-1-1Z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 13v4m8-4v4m-4-4v4" />
        </g>
      </symbol>

      <symbol xmlns="http://www.w3.org/2000/svg" id="fruits" viewBox="0 0 48 48">
        <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
          <path d="M18.88 7.566a1 1 0 0 1 1 1v6.6a1 1 0 1 1-2 0v-6.6a1 1 0 0 1 1-1" />
          <path
            d="M11.78 13.905c1.13-.27 2.283-.065 3.48.553c.975.505 1.667.736 2.206.847c.538.112.966.114 1.483.114v2h-.02c-.516 0-1.12 0-1.868-.155c-.757-.157-1.622-.462-2.72-1.03c-.878-.453-1.54-.517-2.096-.384c-.584.14-1.201.53-1.912 1.264c-1.632 1.688-2.139 3.426-2.316 4.762c-.1 1.644.197 4.89 1.668 8.063c.5 1.08 1.21 2.57 2.076 3.737c.432.582.866 1.03 1.283 1.306c.405.267.741.34 1.046.288c3.123-.538 3.71-.551 4.319-.551h1.037v2H18.38c-.422 0-.92 0-3.95.522c-.94.162-1.787-.127-2.488-.59c-.689-.455-1.284-1.106-1.787-1.783c-1.005-1.353-1.791-3.024-2.284-4.088c-1.638-3.532-1.972-7.137-1.848-9.064l.003-.032l.004-.032c.212-1.644.844-3.839 2.866-5.928c.845-.874 1.783-1.556 2.885-1.82" />
          <path
            d="M14.64 11.41c1.496 1.431 2.307 3.166 2.307 4.51a1 1 0 1 0 2 0c0-2.05-1.168-4.275-2.925-5.956C14.244 8.265 11.743 7 8.896 7a1 1 0 0 0 0 2c2.244 0 4.268.999 5.743 2.41" />
          <path
            d="M8.574 7.009a1 1 0 0 1 1.116.868c.492 3.93 3.945 6 6.734 7.115a1 1 0 0 1-.743 1.857c-2.869-1.147-7.335-3.604-7.975-8.724a1 1 0 0 1 .868-1.116m17.188 6.894c-1.152-.264-2.334-.066-3.57.548c-1.02.506-1.747.74-2.317.853c-.57.113-1.022.115-1.56.115a1 1 0 0 0 0 2h.019c.537 0 1.16 0 1.93-.153c.781-.155 1.676-.458 2.816-1.024c.924-.458 1.632-.528 2.236-.39c.626.144 1.277.542 2.017 1.277c1.716 1.703 2.235 3.452 2.414 4.784a1 1 0 0 0 1.982-.266c-.222-1.653-.884-3.85-2.987-5.938c-.881-.874-1.85-1.548-2.98-1.806m.945 20.377a1 1 0 0 0-1.414.027c-.757.786-1.393 1.05-1.931.962c-3.252-.538-3.86-.55-4.485-.55a1 1 0 0 0 0 2h.028c.447 0 .967 0 4.13.523c1.522.252 2.785-.599 3.699-1.548a1 1 0 0 0-.027-1.415" />
          <path
            d="M32.65 16.103c-1.003 1.81-1.263 3.709-.864 4.992a1 1 0 1 1-1.91.594c-.609-1.959-.153-4.43 1.025-6.556c1.193-2.152 3.206-4.101 5.925-4.947a1 1 0 1 1 .594 1.91c-2.143.666-3.78 2.222-4.77 4.007" />
          <path
            d="M34.719 17.379c-1.168 1.71-2.748 2.793-4.073 3.013a1 1 0 1 0 .326 1.973c2.023-.335 4.027-1.851 5.398-3.858c1.388-2.032 2.227-4.706 1.762-7.515a1 1 0 1 0-1.974.326c.367 2.214-.288 4.375-1.44 6.06" />
          <path d="M31.78 23a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5m-4.5 2.5a4.5 4.5 0 1 1 9 0a4.5 4.5 0 0 1-9 0" />
          <path
            d="M37.845 18.09a4.5 4.5 0 0 1 2.716 5.755a1 1 0 1 1-1.883-.675a2.5 2.5 0 1 0-4.706-1.69a1 1 0 0 1-1.882-.675a4.5 4.5 0 0 1 5.755-2.715" />
          <path
            d="M36.253 23.176a4.501 4.501 0 0 1 3.822 8.014a1 1 0 1 1-1.144-1.64a2.5 2.5 0 1 0-3.008-3.99a1 1 0 1 1-1.262-1.552a4.501 4.501 0 0 1 1.592-.832M27.78 29a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5m-4.5 2.5a4.5 4.5 0 1 1 9 0a4.5 4.5 0 0 1-9 0" />
          <path d="M35.78 29a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5m-4.5 2.5a4.5 4.5 0 1 1 9 0a4.5 4.5 0 0 1-9 0" />
          <path d="M31.78 35a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5m-4.5 2.5a4.5 4.5 0 1 1 9 0a4.5 4.5 0 0 1-9 0" />
          <path
            d="M37.834 33.966a1 1 0 0 1 1.278-.606a4.5 4.5 0 1 1-4.675 7.44a1 1 0 1 1 1.405-1.423a2.5 2.5 0 1 0 2.598-4.133a1 1 0 0 1-.606-1.278" />
        </g>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="dairy" viewBox="0 0 48 48">
        <g fill="none">
          <path d="M0 0h48v48H0z" />
          <path fill="currentColor" fill-rule="evenodd"
            d="M10 5a1 1 0 0 1 1-1h18.571a1 1 0 0 1 .559.17l7.428 5A1 1 0 0 1 38 10v33a1 1 0 0 1-1 1H18.429a1 1 0 0 1-.559-.17l-7.428-5A1 1 0 0 1 10 38zm2 1.878v2.494a2 2 0 0 0 .168.802l1.985 4.539a1 1 0 0 0 1.67.258l.682-.781A2 2 0 0 0 17 12.873v-2.63zM19 11v31h17V11zm14.723-2h-14.99l-4.456-3h14.99zM36 23a8 8 0 1 0-16 0a8 8 0 0 0 16 0M17 40.833V16.61a2.964 2.964 0 0 1-2 .702v22.175zm-4-2.692V16.5h.012a2.997 2.997 0 0 1-.691-.986L12 14.781v22.687zM28 17a6 6 0 1 0 0 12a6 6 0 0 0 0-12m-4 5a1 1 0 0 1 1-1h6v2h-6a1 1 0 0 1-1-1m2 3a1 1 0 0 1 1-1h2v2h-2a1 1 0 0 1-1-1"
            clip-rule="evenodd" />
        </g>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="meat" viewBox="0 0 48 48">
        <g fill="currentColor">
          <path d="M14 14a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
          <path fill-rule="evenodd"
            d="M15.086 6c1.26-1.26 3.414-.368 3.414 1.414V9h1.586c1.782 0 2.674 2.154 1.414 3.414l-1.793 1.793a1.138 1.138 0 0 1-.037.036l3.456 5.847a4 4 0 0 0 4.08 1.914l12.58-2.027c1.63-.263 2.74 1.609 1.728 2.914c-.97 1.251-1.459 2.85-1.812 4.6C38.384 34.02 32.854 39.052 26 39.88V42h2.5v2H19v-2h5v-2c-5.414 0-10.21-2.607-13.107-6.608c-2.324-3.21-1.946-7.335-1.006-10.767l.495-1.805a6.996 6.996 0 0 0 .181-2.822L10.5 18H7.914C6.132 18 5.24 15.846 6.5 14.586zm5 5l-1.466 1.466l-.73-1.233a4.55 4.55 0 0 0-.307-.455c.275.142.586.222.917.222zM16.5 9c0 .334.082.65.227.926a4.548 4.548 0 0 0-1.894-.845L16.5 7.414zm-8.586 7l1.595-1.594c.04.208.096.416.168.624l.334.97zm3.654-1.622a2.548 2.548 0 0 1 4.601-2.127l5.236 8.857a6 6 0 0 0 6.119 2.87l12.148-1.957c-1.082 1.557-1.589 3.383-1.93 5.075a13.09 13.09 0 0 1-1.419 3.815a.999.999 0 0 0-.247.222C34.183 33.513 31.378 35 28.264 35C22.654 35 18 30.136 18 24a1 1 0 0 0-2 0c0 7.12 5.432 13 12.264 13c.4 0 .794-.02 1.184-.06A14.402 14.402 0 0 1 24 38c-4.763 0-8.96-2.291-11.487-5.78c-1.766-2.439-1.6-5.773-.697-9.066l.495-1.806a8.998 8.998 0 0 0-.171-5.311z"
            clip-rule="evenodd" />
        </g>
      </symbol>


  </svg>

  <div class="preloader-wrapper">
    <div class="preloader">
    </div>
  </div>


  <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header justify-content-center">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Votre Panier</span>
      </h4>


      <div id="cart-items">
        <?php
        $total = 0;

        if (!empty($_SESSION['panier'])) {
          foreach ($_SESSION['panier'] as $id_produit => $quantite) {

            $produit = array_filter($liste, fn($item) => $item['id_produit'] == $id_produit);
            $produit = reset($produit);
            if ($produit) {

              $prixTotal = $produit['prix'] * $quantite;
              $total += $prixTotal;
              echo "
                <div class='d-flex justify-content-between align-items-center mb-2'>
                    <img src='../BackOfficeBilel/{$produit['image_produit']}' alt='{$produit['nom_produit']}' style='width: 50px; height: auto; margin-right: 10px;'>
                    <span>{$produit['nom_produit']}</span>
                    <span>Quantité: $quantite</span>
                    <span>\${$prixTotal}</span>
                </div>";
            }
          }
        } else {
          echo "<p>Votre panier est vide.</p>";
        }
        ?>
      </div>


      <?php if (!empty($_SESSION['panier'])): ?>
        <div class="d-flex justify-content-between align-items-center mt-3">
          <span>Total :</span>
          <strong>$<?= number_format($total, 2) ?></strong>
        </div>
        <div class="mt-3">
          <a href="index.php?action=viderPanier"
            class="btn btn-danger w-100 d-flex align-items-center justify-content-center p-3 rounded-3 shadow-sm"
            style="transition: background-color 0.3s ease, transform 0.3s ease;">
            <i class="bi bi-trash3-fill me-2" style="font-size: 20px;"></i> Vider le Panier
          </a>
        </div>
      <?php endif; ?>

      <?php if (!empty($_SESSION['panier'])): ?>
        <!--<button class="w-100 btn btn-primary btn-lg mt-3" type="submit">Continue to checkout</button>-->
        <a href="\Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeAmal\commandes\passer_commande.php" class="w-100 btn btn-primary btn-lg mt-3" >Continue to checkout</a>
      <?php endif; ?>
    </div>
  </div>



  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFavoris">
    <div class="offcanvas-header justify-content-center">
      <h4>Favoris</h4>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <?php if (!empty($_SESSION['favoris'])): ?>
        <?php foreach ($_SESSION['favoris'] as $id_favori): ?>
          <?php
          $produit = array_filter($liste, fn($item) => $item['id_produit'] == $id_favori);
          $produit = reset($produit);
          ?>
          <?php if ($produit): ?>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <img src="../BackOfficeBilel/<?= htmlspecialchars($produit['image_produit']) ?>"
                alt="<?= htmlspecialchars($produit['nom_produit']) ?>" style="width: 50px; height: auto;">
              <span><?= htmlspecialchars($produit['nom_produit']) ?></span>
              <a href="index.php?action=remove_favoris&id_produit=<?= $produit['id_produit'] ?>"
                class="btn btn-sm btn-danger">
                Retirer
              </a>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-muted">Aucun produit dans vos favoris.</p>
      <?php endif; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">

    <div class="offcanvas-header justify-content-between">
      <h4 class="fw-normal text-uppercase fs-6">Menu</h4>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
        
    <div class="offcanvas-body">

      <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
        <li class="nav-item border-dashed active">
          <a href="?categorie=1" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#fruits"></use>
            </svg>
            <span>Fruits et Légumes</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="?categorie=2" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#dairy"></use>
            </svg>
            <span>Produits Laitiers</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="?categorie=3" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#meat"></use>
            </svg>
            <span>Viandes</span>
          </a>
        </li>
        </button>
      </ul>

    </div>

  </div>

  <header>
    <div class="container-fluid">
      <div class="row py-3 border-bottom">

        <div
          class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
          <div class="d-flex align-items-center my-3 my-sm-0">
            <a href="index.html">
              <img src="images/logo.png" alt="logo" class="img-fluid">
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#menu"></use>
            </svg>
          </button>
        </div>





        <div class="d-flex justify-content-end align-items-center">
          <div class="col-auto d-flex gap-4 align-items-center">
            <ul class="d-flex list-unstyled m-0">
              <li>
                <?php if ($user['role_id'] == 1): ?>
                  <a href="/Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\agriculteur_profile.php"
                    class="p-2 mx-1">
                    <svg width="24" height="24">
                      <use xlink:href="#user"></use>
                    </svg>
                  </a>
                <?php elseif ($user['role_id'] == 2): ?>
                  <a href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\consomateur_profile.php"
                    class="p-2 mx-1">
                    <svg width="24" height="24">
                      <use xlink:href="#user"></use>
                    </svg>
                  </a>
                <?php endif; ?>
              </li>
              <li>
                <a href="#" class="p-2 mx-1 text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFavoris"
                  aria-controls="offcanvasFavoris" style="text-decoration: none;">
                  <svg width="24" height="24" style="fill: black;">
                    <use xlink:href="#wishlist"></use>
                  </svg>
                </a>
              </li>
              <li>
                <a href="#" class="p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                  aria-controls="offcanvasCart">
                  <svg width="24" height="24">
                    <use xlink:href="#shopping-bag"></use>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>


      </div>
    </div>
  </header>

  <section style="background-image: url('images/banner-1.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="container-lg">
      <div class="row">
        <div class="col-lg-6 pt-5 mt-5">
          <h2 class="display-1 ls-1"><span class="fw-bold text-primary">Farm2Fork</span> Mangez <span
              class="fw-bold">local</span>, pensez <span class="fw-bold"> global.</span></h2>
          <p class="fs-4">Découvrez une large sélection de produits frais et locaux, soigneusement sélectionnés pour
            vous.</p>



          <div class="row my-5">
            <div class="col">
              <div class="row text-dark">
                <div class="col-auto">
                  <p class="fs-1 fw-bold lh-sm mb-0">14k+</p>
                </div>
                <div class="col">
                  <p class="text-uppercase lh-sm mb-0">Variétés de Produits</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row text-dark">
                <div class="col-auto">
                  <p class="fs-1 fw-bold lh-sm mb-0">50k+</p>
                </div>
                <div class="col">
                  <p class="text-uppercase lh-sm mb-0">Clients Satisfaits</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row text-dark">
                <div class="col-auto">
                  <p class="fs-1 fw-bold lh-sm mb-0">15+</p>
                </div>
                <div class="col">
                  <p class="text-uppercase lh-sm mb-0">Fermes Partenaires</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-3 g-0 justify-content-center">
        <div class="col">
          <div class="card border-0 bg-primary rounded-0 p-4 text-light">
            <div class="row">
              <div class="col-md-3 text-center">
                <svg width="60" height="60">
                  <use xlink:href="#fresh"></use>
                </svg>
              </div>
              <div class="col-md-9">
                <div class="card-body p-0">
                  <h5 class="text-light">Frais de la ferme</h5>
                  <p class="card-text">Des produits frais, directement de la ferme à votre table. Profitez de saveurs
                    authentiques et de la qualité naturelle, récoltée pour vous.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-0 bg-secondary rounded-0 p-4 text-light">
            <div class="row">
              <div class="col-md-3 text-center">
                <svg width="60" height="60">
                  <use xlink:href="#organic"></use>
                </svg>
              </div>
              <div class="col-md-9">
                <div class="card-body p-0">
                  <h5 class="text-light">100% Organique</h5>
                  <p class="card-text">Nos produits sont certifiés 100% biologiques, cultivés sans produits chimiques,
                    pour une alimentation saine et respectueuse de l'environnement.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-0 bg-danger rounded-0 p-4 text-light">
            <div class="row">
              <div class="col-md-3 text-center">
                <svg width="60" height="60">
                  <use xlink:href="#delivery"></use>
                </svg>
              </div>
              <div class="col-md-9">
                <div class="card-body p-0">
                  <h5 class="text-light">Livraison Gratuite</h5>
                  <p class="card-text">Recevez vos produits frais sans frais supplémentaires, directement chez vous. La
                    livraison est gratuite pour que vous profitiez de la qualité sans compromis.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <section class="py-5 overflow-hidden">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                    <h2 class="section-title">Liste des Recettes</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="category-carousel swiper">
                    <div class="swiper-wrapper">
                        <?php
                        require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\recetteControler.php';

                        $recetteController = new recettes();
                        $recipes = $recetteController->afficherecette();
                        ?>

                        <?php if (!empty($recipes)): ?>
                            <?php foreach ($recipes as $recipe): ?>
                                <div class="swiper-slide">
                                    <div class="recipe">
                                        <h2><?= htmlspecialchars($recipe['nomr']); ?></h2>
                                        <p><?= htmlspecialchars($recipe['tempsr']); ?> minutes</p>
                                        <p><?= htmlspecialchars($recipe['descriptionr']); ?></p>
                                        <p class="difficulty">Difficulté : <?= htmlspecialchars($recipe['difficulte']); ?></p>
                                        <!-- Link to Details -->
                                        <a href="\Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeNadine\affiche.php?id=<?= htmlspecialchars($recipe['idr']); ?>" class="details-link">Détails</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="text-align: center;">Aucune recette trouvée.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Add Navigation Buttons -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>
  <section class="py-5 overflow-hidden">
    <div class="container-lg">
      <div class="row">
        <div class="col-md-12">
          <div class="section-header d-flex flex-wrap justify-content-between mb-5">
            <h2 class="section-title">Catégories</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="category-carousel swiper">
            <div class="swiper-wrapper">

              <a href="?categorie=1" class="nav-link swiper-slide text-center">
                <img src="images/category-thumb-1.jpg" class="rounded-circle" alt="Fruits & Légumes">
                <h4 class="fs-6 mt-3 fw-normal category-title">Fruits & Légumes</h4>
              </a>

              <a href="?categorie=3" class="nav-link swiper-slide text-center">
                <img src="images/category-thumb-5.jpg" class="rounded-circle" alt="Viandes">
                <h4 class="fs-6 mt-3 fw-normal category-title">Viandes</h4>
              </a>

              <a href="?categorie=2" class="nav-link swiper-slide text-center">
                <img src="images/category-thumb-7.jpg" class="rounded-circle" alt="Produits Laitiers">
                <h4 class="fs-6 mt-3 fw-normal category-title">Produits Laitiers</h4>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>


  <section class="pb-5">
    <div class="container-lg">
      <div class="row">
        <div class="col-md-12">

          <div class="section-header d-flex flex-wrap justify-content-between my-4">
            <div class="row mt-5">
              <div class="col-md-12">
                <h2>
                  <?php
                  if (!$categorieId) {
                    echo "Toutes les catégories";
                  } else {
                    foreach ($categories as $categorie) {
                      if ($categorieId == $categorie['id_categorie']) {
                        echo htmlspecialchars($categorie['nom_categorie']);
                        break;
                      }
                    }
                  }
                  ?>
                </h2>

              </div>
            </div>
          </div>
        </div>
      </div>
      <form method="GET" action="" class="filter-form d-flex align-items-center">
        <label for="categorie">Filtrer par catégorie :</label>
        <select name="categorie" id="categorie" class="mx-2">
          <option value="">Toutes les catégories</option>
          <?php foreach ($categories as $categorie) { ?>
            <option value="<?= htmlspecialchars($categorie['id_categorie']) ?>"
              <?= $categorieId == $categorie['id_categorie'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($categorie['nom_categorie']) ?>
            </option>
          <?php } ?>
        </select>


        <div class="input-group mx-2">
          <span class="input-group-text" id="basic-addon1">
            <i class="fa fa-search" aria-hidden="true"></i>
          </span>
          <input type="text" name="search" id="search" class="form-control" placeholder="Rechercher un produit..."
            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
        </div>

        <button type="submit" class="btn btn-primary">Filtrer</button>
      </form>

      <form method="GET" action="index.php"
        class="d-flex align-items-center justify-content-end gap-3 mb-4 p-2 rounded shadow-sm"
        style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
        <label for="tri" class="form-label mb-0 fw-bold text-secondary">Trier par :</label>
        <select name="tri" id="tri" class="form-select form-select-sm w-auto" onchange="this.form.submit()"
          style="border-color: #ced4da;">
          <option value=""></option>
          <option value="alphabet" <?= ($tri === 'alphabet') ? 'selected' : '' ?>>Nom (A-Z)</option>
          <option value="prix_asc" <?= ($tri === 'prix_asc') ? 'selected' : '' ?>>Prix (croissant)</option>
          <option value="prix_desc" <?= ($tri === 'prix_desc') ? 'selected' : '' ?>>Prix (décroissant)</option>
        </select>

      </form>

      <form method="GET" action="../BackOfficeBilel/comparerProduits.php" class="compare-form">
        <button type="submit" class="btn btn-sm btn-primary mt-2" style="
                background-color: #28a745; 
                color: white; 
                padding: 8px 16px; 
                border: none; 
                border-radius: 50px; 
                font-size: 14px; 
                font-weight: bold; 
                transition: background-color 0.3s ease, transform 0.3s ease;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
          Comparer les produits sélectionnés
        </button>





        <div class="row">
          <div class="col-md-12">
            <div
              class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
              <?php if (!empty($liste)) { ?>
                <?php foreach ($liste as $produit): ?>
                  <div class="col">
                    <div class="product-item">
                      <figure>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#productModal<?= $produit['id_produit'] ?>"
                          title="<?= htmlspecialchars($produit['nom_produit']) ?>">
                          <img src="../BackOfficeBilel/<?= htmlspecialchars($produit['image_produit']) ?>"
                            alt="<?= htmlspecialchars($produit['nom_produit']) ?>" class="tab-image">
                        </a>
                      </figure>
                      <div class="d-flex flex-column text-center">
                        <h3 class="fs-6 fw-normal"><?= htmlspecialchars($produit['nom_produit']) ?></h3>
                        <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                          <span class="text-dark fw-semibold">$<?= htmlspecialchars($produit['prix']) ?></span>
                        </div>
                        <div class="d-flex justify-content-between px-3 mb-3">
                          <span class="text-muted small">Quantité :
                            <strong><?= htmlspecialchars($produit['quantite_produit']) ?></strong></span>
                          <span class="text-muted small">Stock :
                            <strong><?= htmlspecialchars($produit['stock_produit']) ?></strong></span>
                        </div>
                        <input type="checkbox" name="produits[]" value="<?= $produit['id_produit'] ?>" />
                        <label for="compare">Comparer</label>
                        <a href="index.php?action=<?= in_array($produit['id_produit'], $_SESSION['favoris']) ? 'remove_favoris' : 'add_favoris' ?>&id_produit=<?= $produit['id_produit'] ?>"
                          class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center gap-1">
                          <svg class="icon" width="18" height="18">
                            <use xlink:href="#wishlist"></use>
                          </svg>
                          <?= in_array($produit['id_produit'], $_SESSION['favoris']) ? 'Retirer' : 'Favoris' ?>
                        </a>

                        <form method="POST" action="index.php" class="add-to-cart-form">
                          <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>" />
                          <label for="quantite">Quantité:</label>
                          <input type="number" name="quantite" min="1" max="<?= $produit['quantite_produit'] ?>" value="1"
                            class="form-control mb-2" style="width: 80px; display: inline-block;">
                          <button type="submit" class="btn btn-primary">Ajouter au Panier</button>
                        </form>
                      </div>
                    </div>


                    <div class="modal fade" id="productModal<?= $produit['id_produit'] ?>" tabindex="-1"
                      aria-labelledby="productModalLabel<?= $produit['id_produit'] ?>" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel<?= $produit['id_produit'] ?>">
                              <?= htmlspecialchars($produit['nom_produit']) ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-center">
                            <img src="../BackOfficeBilel/<?= htmlspecialchars($produit['image_produit']) ?>"
                              alt="<?= htmlspecialchars($produit['nom_produit']) ?>"
                              style="width: 100%; height: auto; max-width: 400px; border-radius: 8px;">
                            <div class="mt-3">
                              <p><strong>Prix :</strong> $<?= htmlspecialchars($produit['prix']) ?></p>
                              <p><strong>Stock :</strong> <?= htmlspecialchars($produit['stock_produit']) ?></p>
                              <p><strong>Quantité disponible :</strong>
                                <?= htmlspecialchars($produit['quantite_produit']) ?></p>
                              <p><strong>Description :</strong>
                                <?= nl2br(htmlspecialchars($produit['description_produit'])) ?></p>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <a href="index.php?action=<?= in_array($produit['id_produit'], $_SESSION['favoris']) ? 'remove_favoris' : 'add_favoris' ?>&id_produit=<?= $produit['id_produit'] ?>"
                              class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center gap-1">
                              <svg class="icon" width="18" height="18">
                                <use xlink:href="#wishlist"></use>
                              </svg>
                              <?= in_array($produit['id_produit'], $_SESSION['favoris']) ? 'Retirer' : 'Favoris' ?>
                            </a>
                            <form method="POST" action="index.php" class="add-to-cart-form">
                              <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>" />
                              <div class="d-flex align-items-center gap-2">
                                <input type="number" name="quantite"
                                  class="form-control border-dark-subtle input-number quantity" min="1"
                                  max="<?= htmlspecialchars($produit['quantite_produit']) ?>" value="1"
                                  style="width: 80px; display: inline-block;">
                                <button type="submit" class="btn btn-primary rounded-1 p-2 fs-7">
                                  Ajouter au Panier
                                </button>
                              </div>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php } else { ?>
                <p>Aucun produit disponible pour cette catégorie.</p>
              <?php } ?>




            </div>
          </div>
        </div>
    </div>
  </section>


  <svg style="display: none;">
    <symbol id="cart" viewBox="0 0 24 24">
      <path fill="currentColor"
        d="M7 18c1.1 0 1.99.9 1.99 2S8.1 22 7 22s-2-.9-2-2 .9-2 2-2zm10 0c1.1 0 1.99.9 1.99 2s-.89 2-1.99 2-2-.9-2-2 .9-2 2-2zM7.82 6l1.38 6h8.43l1.47-6H7.82zM6.16 4h12.41c.48 0 .91.34.98.82L21 10H8l-.93-4H2V4h4.16z" />
    </symbol>
    <symbol id="heart" viewBox="0 0 24 24">
      <path fill="currentColor"
        d="M12.1 21.55l-1.1-1.03C5.14 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A5.978 5.978 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.14 6.86-8.9 11.54l-1.1 1.01z" />
    </symbol>
  </svg>


  <section class="py-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-md-12">

          <div class="banner-blocks">

            <div class="banner-ad d-flex align-items-center large bg-info block-1"
              style="background: url('images/banner-ad-1.jpg') no-repeat; background-size: cover;">

            </div>

            <div class="banner-ad bg-success-subtle block-2"
              style="background:url('images/banner-ad-2.jpg') no-repeat;background-size: cover">
              <div class="banner-content align-items-center p-5">

              </div>
            </div>

            <div class="banner-ad bg-danger block-3"
              style="background:url('images/banner-ad-3.jpg') no-repeat;background-size: cover">
              <div class="banner-content align-items-center p-5">
                <div class="content-wrapper text-light">
                  <h3 class="banner-title text-light"></h3>
                  <p></p>
                  <a href="#" class="btn-link text-white"></a>
                </div>
              </div>
            </div>

          </div>


        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container-lg">
      <div class="row justify-content-center row-cols-1 row-cols-sm-3 row-cols-lg-5">
        <div class="col">
          <div class="card mb-3 border border-dark-subtle p-3">
            <div class="text-dark mb-3">
              <svg width="32" height="32">
                <use xlink:href="#package"></use>
              </svg>
            </div>
            <div class="card-body p-0">
              <h5>100% Paiement Sécurisé</h5>
              <p class="card-text">Effectuez vos achats en toute tranquillité grâce à notre système de paiement
                sécurisé, protégé par les dernières technologies.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-3 border border-dark-subtle p-3">
            <div class="text-dark mb-3">
              <svg width="32" height="32">
                <use xlink:href="#quality"></use>
              </svg>
            </div>
            <div class="card-body p-0">
              <h5>Qualité garantie</h5>
              <p class="card-text">Nous sélectionnons rigoureusement nos produits pour vous offrir la meilleure qualité,
                du champ à votre assiette.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-3 border border-dark-subtle p-3">
            <div class="text-dark mb-3">
              <svg width="32" height="32">
                <use xlink:href="#savings"></use>
              </svg>
            </div>
            <div class="card-body p-0">
              <h5>Économies garanties</h5>
              <p class="card-text">Profitez de prix avantageux sur des produits frais et locaux. Acheter directement à
                la source, c’est aussi faire des économies.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <footer class="py-5">
    <div class="container-lg">
      <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="footer-menu">
            <img src="images/logo.png" width="240" height="70" alt="logo">
            <div class="social-links mt-3">
              <ul class="d-flex list-unstyled gap-2">
                <li>
                  <a href="mailto:farm2fork2024@gmail.com" class="btn btn-outline-light">
                    <svg width="24" height="24">
                      <use xlink:href="#mail"></use>
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-2 col-sm-6">
          <div class="footer-menu">
            <h5 class="widget-title">Farm2Fork</h5>
            <ul class="menu-list list-unstyled">
              <li class="menu-item">
                <a href="javascript:void(0);" class="nav-link" onclick="openModal()">À propos de nous</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">Conditions </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <div id="footer-bottom">
    <div class="container-lg">
      <div class="row">
        <div class="col-md-6 copyright">
          <p>© 2024 Farm2Fork. Tous droits réservés.</p>
        </div>
        <div class="col-md-6 credit-link text-start text-md-end">
          <p>Modèle HTML par <a href="https://templatesjungle.com/">TemplatesJungle</a>Distribué par <a
              href="https://themewagon.com">ThemeWagon</a> </p>
        </div>
      </div>
    </div>
  </div>
  <div class="modal about-modal" id="aboutModal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeModal()">&times;</span>
      <h2 class="modal-title">À propos de Farm2Fork</h2>
      <p class="modal-body">
        Bienvenue sur Farm2Fork !
        <br>

        Nous sommes dédiés à rapprocher l'agriculture et votre assiette en vous proposant des produits frais, sains, et
        biologiques, directement issus des exploitations agricoles.
        <br><br>
        Notre mission est de promouvoir une alimentation durable et de qualité en établissant un lien de confiance entre
        les producteurs locaux et nos clients. Grâce à Farm2Fork, vous accédez à une sélection de fruits, légumes,
        produits laitiers, et bien plus encore, soigneusement cultivés dans le respect de l'environnement et sans
        intermédiaires inutiles.
        <br><br>
        Avec Farm2Fork, faites le choix d'une alimentation authentique, soutenez les agriculteurs locaux, et contribuez
        à un avenir plus vert. Du champ à la fourchette, la fraîcheur et la qualité sont nos priorités !
      </p>
    </div>
  </div>

  <script>
    // Fonction pour ouvrir le modal
    function openModal() {
      const modal = document.getElementById("aboutModal");
      modal.style.display = "flex"; // Affiche la fenêtre modale
    }

    // Fonction pour fermer le modal
    function closeModal() {
      const modal = document.getElementById("aboutModal");
      modal.style.display = "none"; // Cache la fenêtre modale
    }

    // Fermer le modal si on clique à l'extérieur du contenu
    window.onclick = function (event) {
      const modal = document.getElementById("aboutModal");
      if (event.target === modal) {
        modal.style.display = "none";
      }
    };


  </script>
  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const checkboxes = document.querySelectorAll('input[name="produits[]"]');
      checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
          const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
          if (checkedCount > 2) {
            alert("Vous ne pouvez comparer que 2 produits à la fois.");
            this.checked = false; // Décocher la dernière checkbox
          }
        });
      });
    });
  </script>

  <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
  <script src="https://files.bpcontent.cloud/2024/12/04/12/20241204125303-O4NIIS3P.js"></script>

</body>

</html>