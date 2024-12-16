<?php
include_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\ProduitController.php';
$produitcontroller = new ProduitController();

// Récupérer les IDs des produits à comparer
$produitsIds = isset($_GET['produits']) ? $_GET['produits'] : [];

// Charger les produits correspondants
$produits = [];
if (!empty($produitsIds)) {
    foreach ($produitsIds as $id) {
        $produit = $produitcontroller->showProduit($id); // Assurez-vous que cette méthode existe
        if ($produit) {
            $produits[] = $produit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparaison des Produits</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Ajoutez le bon chemin -->
    <style>
        /* Style pour le tableau comparatif */
        .compare-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .compare-table th,
        .compare-table td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        .compare-table th {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .compare-table td {
            background-color: #f2f2f2;
        }

        .compare-table td img {
            width: 120px;
            height: auto;
        }

        .btn-primary {
            background-color: #FF5733;
            border-color: #FF5733;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #C70039;
            text-decoration: none;
        }

        .text-muted {
            color: #8B8B8B;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 style="color: #343A40;">Comparaison des Produits</h1>

        <?php if (!empty($produits)): ?>
            <table class="compare-table">
                <thead>
                    <tr>
                        <th>Critères</th>
                        <?php foreach ($produits as $produit): ?>
                            <th><?= htmlspecialchars($produit['nom_produit']) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Image</td>
                        <?php foreach ($produits as $produit): ?>
                            <td><img src="../Backoffice/<?= htmlspecialchars($produit['image_produit']) ?>" alt="<?= htmlspecialchars($produit['nom_produit']) ?>"></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Prix</td>
                        <?php foreach ($produits as $produit): ?>
                            <td>$<?= htmlspecialchars(number_format($produit['prix'], 2)) ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Stock</td>
                        <?php foreach ($produits as $produit): ?>
                            <td><?= htmlspecialchars($produit['stock_produit']) ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Quantité Disponible</td>
                        <?php foreach ($produits as $produit): ?>
                            <td><?= htmlspecialchars($produit['quantite_produit']) ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <?php foreach ($produits as $produit): ?>
                            <td><?= nl2br(htmlspecialchars($produit['description_produit'])) ?></td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-muted">Aucun produit sélectionné pour la comparaison.</p>
        <?php endif; ?>

        <a href="../FrontofficeBilel/index.php" class="btn btn-primary mt-3">Retour à la liste des produits</a>
    </div>
</body>
</html>
