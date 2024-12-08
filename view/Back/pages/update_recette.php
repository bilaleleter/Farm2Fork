<?php
require_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\recetteControler.php';
require_once 'C:\xampp\htdocs\dashboard\recettenadine\model\recetteModel.php';

$recetteController = new recettes();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['idr'])) {
    $idr = $_GET['idr'];

    $recipes = $recetteController->afficherecette();
    $recipe = null;

    foreach ($recipes as $r) {
        if ($r['idr'] == $idr) {
            $recipe = $r;
            break;
        }
    }

    if (!$recipe) {
        echo "Recipe not found.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idr = $_POST['idr'];
    $newNomr = $_POST['nomr'];
    $newDescriptionr = $_POST['descriptionr'];
    $newTempsr = $_POST['tempsr'];
    $newDifficulte = $_POST['difficulte'];

    $recetteObj = new recette($idr, $newNomr, $newDescriptionr, $newTempsr, $newDifficulte);

    $recetteController->updaterecette($recetteObj, $idr);

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
    <title>Modifier une Recette</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Modifier une Recette</h1>
        <form onsubmit="return validateForm();" action="update.php" method="POST">
            <input type="hidden" name="idr" value="<?= htmlspecialchars($recipe['idr']); ?>">

            <label for="nomr">Nom de la Recette :</label>
            <input type="text" id="nomr" name="nomr" 
                   value="<?= htmlspecialchars($recipe['nomr']); ?>" 
                   placeholder="Entrez le nom de la recette" required>

            <label for="descriptionr">Description :</label>
            <textarea id="descriptionr" name="descriptionr" 
                      placeholder="Entrez la description" required><?= htmlspecialchars($recipe['descriptionr']); ?></textarea>

            <label for="tempsr">Temps de Préparation (en minutes) :</label>
            <input type="number" id="tempsr" name="tempsr" 
                   value="<?= htmlspecialchars($recipe['tempsr']); ?>" 
                   placeholder="Entrez le temps de préparation" required>

            <label for="difficulte">Difficulté :</label>
            <select id="difficulte" name="difficulte" required>
                <option value="Facile" <?= $recipe['difficulte'] === 'Facile' ? 'selected' : ''; ?>>Facile</option>
                <option value="Moyen" <?= $recipe['difficulte'] === 'Moyen' ? 'selected' : ''; ?>>Moyen</option>
                <option value="Difficile" <?= $recipe['difficulte'] === 'Difficile' ? 'selected' : ''; ?>>Difficile</option>
            </select>

            <button type="submit">Mettre à Jour</button>
        </form>
    </div>

    <script>
    function validateForm() {
        const nomr = document.getElementById('nomr').value.trim();
        const descriptionr = document.getElementById('descriptionr').value.trim();
        const tempsr = document.getElementById('tempsr').value.trim();
        const difficulte = document.getElementById('difficulte').value.trim();

        if (!nomr || nomr.length < 3) {
            alert("Le nom de la recette doit contenir au moins 3 caractères.");
            return false;
        }

        if (!descriptionr || descriptionr.length < 10) {
            alert("La description doit contenir au moins 10 caractères.");
            return false;
        }

        if (!tempsr || isNaN(tempsr) || parseInt(tempsr) <= 0) {
            alert("Le temps de préparation doit être un nombre positif.");
            return false;
        }

        if (!difficulte) {
            alert("Veuillez sélectionner une difficulté.");
            return false;
        }

        return true;
    }
</script>

</body>
</html>
