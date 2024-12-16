<?php
require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\nutritionControler.php';


$idr = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

// Handle missing ID
if (!$idr) {
    echo "
    <div class='alert alert-danger text-center' style='margin: 20px auto; max-width: 600px;'>
        <strong>Erreur :</strong> ID de la recette manquant.
    </div>";
    exit;
}

// Fetch the nutritional details for the specific recette
$recetteController = new nutritions();
$recipe = $recetteController->getNutritionByRecetteId($idr);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Nutritionnels</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }
        .details {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            background-color: #f9f9f9;
        }
        .details p {
            margin: 8px 0;
            font-size: 16px;
        }
        .details .attribute {
            font-weight: bold;
            color: #555;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($recipe): ?>
            <div class="details">
                <p><span class="attribute">Calories:</span> <?= htmlspecialchars($recipe['calories']); ?> kcal</p>
                <p><span class="attribute">Protéines:</span> <?= htmlspecialchars($recipe['proteines']); ?> g</p>
                <p><span class="attribute">Glucides:</span> <?= htmlspecialchars($recipe['carbohydrates']); ?> g</p>
            </div>
            <a href="\Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeBilel\index.php" class="back-link">Retour à la liste des recettes</a>
        <?php else: ?>
            <h1>Aucune Information Disponible</h1>
            <a href="\Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeBilel\index.php" class="back-link">Retour à la liste des recettes</a>
        <?php endif; ?>
    </div>
</body>
</html>
