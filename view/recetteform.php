<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Recette</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            color: #333333;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Ajouter une Recette</h1>
        <form method="POST" action="addrecette.php">
    <label for="idr">ID:</label>
    <input type="text" id="idr" name="idr" required><br><br>

    <label for="nomr">Nom de la Recette:</label>
    <input type="text" id="nomr" name="nomr" required><br><br>

    <label for="descriptionr">Description:</label>
    <textarea id="descriptionr" name="descriptionr" required></textarea><br><br>

    <label for="tempsr">Temps de Préparation:</label>
    <input type="date" id="tempsr" name="tempsr" required><br><br>

    <label for="difficulte">Difficulté:</label>
    <select id="difficulte" name="difficulte" required>
        <option value="Facile">Facile</option>
        <option value="Moyen">Moyen</option>
        <option value="Difficile">Difficile</option>
    </select><br><br>

    <button type="submit">Ajouter la Recette</button>
</form>

    </div>
</body>
</html>
