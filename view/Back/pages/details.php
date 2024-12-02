<?php
require_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\nutritionController.php';
$idr = isset($_GET['idr']) ? htmlspecialchars($_GET['idr']) : null;
if (!$idr) {
    echo "
    <div class='alert alert-danger text-center' style='margin: 20px auto; max-width: 600px;'>
        <strong>Erreur :</strong> ID de la recette manquant.
    </div>";
    exit;
}

$nutritionController = new nutritions();

// Vérifier si les informations nutritionnelles existent déjà
$existingNutrition = $nutritionController->getNutritionByRecetteId($idr);

if ($existingNutrition) {
    echo "
    <div class='container' style='margin: 20px auto; max-width: 600px;'>
        <div class='alert alert-warning text-center'>
            <h5 class='mb-3'><i class='fas fa-exclamation-circle'></i> Détails déjà existants</h5>
            <p>
                Les détails nutritionnels pour cette recette existent déjà.
                Vous pouvez les mettre à jour si nécessaire.
            </p>
            <a href='update_nutrition.php?idProduit=" . htmlspecialchars($existingNutrition['idProduit']) . "' 
               class='btn btn-primary'>
                <i class='fas fa-edit'></i> Mettez à jour les détails ici
            </a>
        </div>
    </div>";
    exit;
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des Informations Nutritionnelles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Style global pour le formulaire */
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
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control-lg:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            color: white;
        }
        .form-label i {
            margin-left: 5px;
            color: #007bff;
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
                        <i class="fas fa-utensils me-2"></i>Ajouter des Informations Nutritionnelles
                    </h6>
                </div>
            </div>
            <div class="card-body">
                <form onsubmit="return validForm();" method="POST" action="addNutrition.php">
                <div class="form-group mb-4">
                <label for="idr" class="form-label fw-bold">ID de la recette</label>
                <input type="text" id="idr" name="idr" class="form-control form-control-lg" readonly value="<?= $idr; ?>">
                        </div>


                    <div class="form-group mb-4">
                        <label for="calories" class="form-label fw-bold">Calories <i class="fas fa-fire-alt text-warning"></i></label>
                        <input type="number" id="calories" name="calories" class="form-control form-control-lg" placeholder="Ex : 250" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="proteines" class="form-label fw-bold">Protéines (en g) <i class="fas fa-drumstick-bite text-info"></i></label>
                        <input type="number" id="proteines" name="proteines" class="form-control form-control-lg" placeholder="Ex : 15" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="carbohydrates" class="form-label fw-bold">Glucides (en g) <i class="fas fa-bread-slice text-secondary"></i></label>
                        <input type="number" id="carbohydrates" name="carbohydrates" class="form-control form-control-lg" placeholder="Ex : 50" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-plus-circle me-2"></i>Ajouter les Informations Nutritionnelles
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
