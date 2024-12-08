<?php
require_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\recetteControler.php';

$recetteController = new recettes();
$recipes = $recetteController->afficherecette();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Recipes List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Preparation Time</th>
                <th>Difficulty</th>
                <th>Actions</th>
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
                        <!-- Update Form -->
                        <form action="update_recette.php" method="GET" style="display:inline;">
                            <input type="hidden" name="idr" value="<?= htmlspecialchars($recipe['idr']); ?>">
                            <button type="submit">Update</button>
                        </form>

                        <!-- Delete Form -->
                        <form action="delete_recette.php" method="POST" style="display:inline;">
                            <input type="hidden" name="idr" value="<?= htmlspecialchars($recipe['idr']); ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
