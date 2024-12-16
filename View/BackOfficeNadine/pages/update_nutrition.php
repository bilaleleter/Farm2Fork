<?php
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\nutritionControler.php';
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Model\nutritionModel.php';

$nutritionController = new nutritions();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['idProduit'])) {
    $idProduit = $_GET['idProduit'];

    $nutritions = $nutritionController->affichenutrition();
    $nutrition = null;

    foreach ($nutritions as $n) {
        if ($n['idProduit'] == $idProduit) {
            $nutrition = $n;
            $idr = $n['idr'];
            $calories = $n['calories'];
            $proteines = $n['proteines'];
            $proteines = $n['carbohydrates'];
            break;
        }
    }

    if (!$nutrition) {
        echo "Nutrition entry not found.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idProduit = $_POST['idProduit'];
    $idr = $_POST['idr'];
   /* $newCalories = $_POST['calories'];
    $newProteines = $_POST['proteines'];
    $newCarbohydrates = $_POST['carbohydrates'];*/

    $nutritionObj = new Nutrition($idProduit, $idr, $newCalories, $newProteines, $newCarbohydrates);

    $nutritionController->updateNutrition($nutritionObj, $idProduit);

    header("Location: tables.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher des Informations Nutritionnelles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .form-control-lg {
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control-lg:focus {
            border-color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .row {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">
                        <i class="fas fa-utensils me-2"></i>Informations Nutritionnelles
                    </h6>
                </div>
            </div>
            <div class="card-body">
                <form onsubmit="return validForm();" method="POST" action="updateNutrition.php">
                    <!-- Champ ID Produit -->
                    <div class="form-group mb-4">
                        <label for="idProduit" class="form-label fw-bold">ID Produit</label>
                        <input type="text" id="idProduit" name="idProduit" class="form-control form-control-lg" readonly 
                               value="<?= htmlspecialchars($nutrition['idProduit']); ?>">
                    </div>

                    <!-- Champ ID Recette -->
                    <div class="form-group mb-4">
                        <label for="idr" class="form-label fw-bold">ID Recette</label>
                        <input type="text" id="idr" name="idr" class="form-control form-control-lg" readonly 
                               value="<?= htmlspecialchars($nutrition['idr']); ?>">
                    </div>

                    <!-- Champ Calories -->
                    <div class="form-group mb-4">
                        <label for="calories" class="form-label fw-bold">Calories</label>
                        <input type="number" id="calories" name="calories" class="form-control form-control-lg" 
                               value="<?= htmlspecialchars($nutrition['calories']); ?>" >
                    </div>

                    <!-- Champ Protéines -->
                    <div class="form-group mb-4">
                        <label for="proteines" class="form-label fw-bold">Protéines (g)</label>
                        <input type="number" id="proteines" name="proteines" class="form-control form-control-lg" 
                               value="<?= htmlspecialchars($nutrition['proteines']); ?>" >
                    </div>

                    <!-- Champ Glucides -->
                    <div class="form-group mb-4">
                        <label for="carbohydrates" class="form-label fw-bold">Glucides (g)</label>
                        <input type="number" id="carbohydrates" name="carbohydrates" class="form-control form-control-lg" 
                               value="<?= htmlspecialchars($nutrition['carbohydrates']); ?>" >
                    </div>

                    <!-- Bouton de mise à jour -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-edit me-2"></i>Mettre à Jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="valid.js"> </script>
</body>
</html>
