<?php
require_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\recetteControler.php';

$recetteController = new recettes();
$recipes = $recetteController->afficherecette();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Recettes</title>
    <style>
        .recipe {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin: 16px 0;
            background-color: #f9f9f9;
        }
        .recipe h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .recipe p {
            margin: 8px 0;
            font-size: 16px;
        }
        .difficulty {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Liste des Recettes</h1>
    <div class="recipes">
        <?php if (!empty($recipes)): ?>
            <?php foreach ($recipes as $recipe): ?>
                <div class="recipe">
                    <h2><?= htmlspecialchars($recipe['nomr']); ?></h2>
                    <p><?= htmlspecialchars($recipe['descriptionr']); ?></p>
                    <p class="difficulty">Difficulté : <?= htmlspecialchars($recipe['difficulte']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">Aucune recette trouvée.</p>
        <?php endif; ?>
    </div>
</body>
</html>
