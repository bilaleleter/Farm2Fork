<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuler Commande (Admin)</title>
    <link rel="stylesheet" href="/public/css/admin.css">
</head>
<body>
    <h1>Annuler Commande</h1>
    <form action="/admin/commande/annuler" method="post">
        <label for="commande-id">ID de la Commande :</label>
        <input type="text" id="commande-id" name="commande_id" required>
        <button type="submit">Annuler</button>
    </form>
</body>
</html>
