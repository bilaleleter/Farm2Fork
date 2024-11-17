<?php
// Inclure les fichiers nécessaires
include_once __DIR__ . "/../../../Controller/CommandeController.php";
include_once __DIR__ . "/../../../Model/Commande.php";
include_once __DIR__ . "/../../../Controller/ProduitController.php";
include_once __DIR__ . "/../../../Config.php";

// Instancier le contrôleur
$commandeController = new Controller\CommandeController();
$produitController = new Controller\ProduitController();

// Traitement du formulaire lors de la soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $produit = $_POST['produit'];
    $id_produit = (int) $produit;
    $quantite = (int) $_POST['quantite'];
    $adresse_livraison = $_POST['adresse_livraison'];
    $date_livraison = $_POST['date_livraison'] ?: null; // Date peut être vide
    $mode_paiement = $_POST['mode_paiement'];

    // Associer un id_utilisateur (par exemple, 1 pour un utilisateur fictif ou depuis la session utilisateur)
    

    // Créer une nouvelle commande avec les données du formulaire
    $commande = new Model\Commande(
        0, // ID commande sera auto-généré par la base de données
        date('Y-m-d H:i:s'), // Date de la commande
        'en attente', // L'état initial de la commande
        $quantite,
        1,
        $id_produit
    );

    // Ajouter la commande à la base de données
    $commandeController->addCommande($commande);

    // Rediriger l'utilisateur après l'ajout de la commande
    echo "Commande passée avec succès !";
    // Vous pouvez également rediriger vers une autre page si nécessaire :
    // header('Location: /confirmation');
}
?>

<!-- HTML pour le formulaire -->
<form action="" method="POST">
    <!-- Informations Client -->
    

    <h2>Informations Client</h2>
    <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
    </div>

    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="Votre email" required>
    </div>

    <div>
        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" placeholder="Votre numéro de téléphone" required>
    </div>

    <div>
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" placeholder="Votre adresse" required>
    </div>

    <!-- Détails du Produit -->
    <h2>Choix du Produit</h2>
    <div>
        <label for="produit">Produit :</label>
        <select id="produit" name="produit" required>
            <option value="" disabled selected>Sélectionnez un produit</option>
            <?php
            
            $produits = $produitController->getAllProduits();
           
            foreach ($produits as $produit) {
                echo "<option value='{$produit['idProduit']}' >{$produit['NomProduit']}</option>";
            }
            ?>
            
        </select>
    </div>

    <div>
        <label for="quantite">Quantité :</label>
        <input type="number" id="quantite" name="quantite" min="1" placeholder="Quantité" required>
    </div>

    <!-- Informations sur la Livraison -->
    <h2>Informations de Livraison</h2>
    <div>
        <label for="adresse_livraison">Adresse de Livraison :</label>
        <input type="text" id="adresse_livraison" name="adresse_livraison" placeholder="Adresse de livraison" required>
    </div>

    <div>
        <label for="date_livraison">Date de Livraison Préférée :</label>
        <input type="date" id="date_livraison" name="date_livraison">
    </div>

    <!-- Mode de Paiement -->
    <h2>Mode de Paiement</h2>
    <div>
        <label for="mode_paiement">Mode de Paiement :</label>
        <select id="mode_paiement" name="mode_paiement" required>
            <option value="" disabled selected>Sélectionnez un mode de paiement</option>
            <option value="carte_bancaire">Carte Bancaire</option>
            <option value="paypal">PayPal</option>
            <option value="virement">Virement Bancaire</option>
        </select>
    </div>

    <!-- Bouton de Soumission -->
    <div>
        <button type="submit">Passer la Commande</button>
    </div>
</form>
