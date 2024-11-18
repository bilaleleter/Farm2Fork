<?php

use Controller\LivraisonController;
use Model\Livraison;

include '../../../Controller/LivraisonController.php';


// Vérifiez si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: livraison.php');
    exit;
}

// Instancier le contrôleur Livraison
$controller = new LivraisonController();

// Récupérer les détails de la livraison à partir de l'ID
$result = $controller->getLivraison($id);

// Vérifier si le formulaire est soumis
if (isset($_POST['btn'])) {
    // Récupérer les données du formulaire
    $ville = $_POST['ville'];
    $codePostal = $_POST['codePostal'];
    $adresse = $_POST['adresse'];
    $dateEnvoi = $_POST['dateEnvoi'];
    $statut = $_POST['statut'];
    $dateEstimee = $_POST['dateEstimee'];

    // Créer un objet Livraison avec les nouvelles données
    $livraison = new Livraison($id, $ville, $codePostal, $adresse, $dateEnvoi, $statut, $dateEstimee);

    // Appeler la méthode pour mettre à jour la livraison
    $controller->updateLivraison($livraison, $id);

    // Redirection vers la liste des livraisons après la mise à jour
    header('Location: livraison.php');
    exit;
}

?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier Livraison</title>
    <!-- Custom styles -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Modifier Livraison</h1>
                        </div>
                        <form class="user" method="post">
                            <div class="form-group">
                                <input type="text" name="ville" class="form-control form-control-user" value="<?php echo htmlspecialchars($result['ville']); ?>" placeholder="Ville">
                            </div>
                            <div class="form-group">
                                <input type="number" name="codePostal" class="form-control form-control-user" value="<?php echo htmlspecialchars($result['codePostal']); ?>" placeholder="Code Postal">
                            </div>
                            <div class="form-group">
                                <input type="text" name="adresse" class="form-control form-control-user" value="<?php echo htmlspecialchars($result['Adresse_de_Livraison']); ?>" placeholder="Adresse de Livraison">
                            </div>
                            <div class="form-group">
                                <input type="date" name="dateEnvoi" class="form-control form-control-user" value="<?php echo htmlspecialchars($result['Date_d_envoi']); ?>" placeholder="Date d'Envoi">
                            </div>
                            <div class="form-group">
                                <input type="text" name="statut" class="form-control form-control-user" value="<?php echo htmlspecialchars($result['Statut_de_Livraison']); ?>" placeholder="Statut de Livraison">
                            </div>
                            <div class="form-group">
                                <input type="date" name="dateEstimee" class="form-control form-control-user" value="<?php echo htmlspecialchars($result['Date_de_Livraison_Estimee']); ?>" placeholder="Date de Livraison Estimée">
                            </div>
                            <button name="btn" class="btn btn-primary btn-user btn-block">
                                Mettre à Jour
                            </button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>