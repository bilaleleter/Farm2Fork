<?php
include '../../Controller/Farm2ForkController.php';
include '../../Model/Produit.php';

$error = "";
$produit = null;


$produitcontroller = new Farm2ForkController();

if (isset($_POST["nom_produit"]) && isset($_POST["description_produit"]) && isset($_POST["prix"]) && isset($_POST["quantite_produit"]) && isset($_POST["stock_produit"])) {
    if (!empty($_POST["nom_produit"]) && !empty($_POST["description_produit"]) && !empty($_POST["prix"]) && !empty($_POST["quantite_produit"]) && !empty($_POST["stock_produit"])) {
        
       
        $produit = new Produit(
            null,  
            $_POST['nom_produit'],
            null,  
            $_POST['description_produit'],
            $_POST['prix'],
            $_POST['quantite_produit'],
            $_POST['stock_produit']
        );

       
        if (isset($_FILES['image_produit']) && $_FILES['image_produit']['error'] == 0) {
           
            $target_dir = "uploads/"; 
            $target_file = $target_dir . basename($_FILES["image_produit"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
           
            if (move_uploaded_file($_FILES["image_produit"]["tmp_name"], $target_file)) {
                $produit->setImageProduit($target_file);
            } else {
                die("Erreur lors du téléchargement de l'image.");
            }
        } else {
           
            $produit->setImageProduit($_POST['current_image']);
        }

        
        $produitcontroller->updateProduit($produit, $_POST['id_produit']);
        
      
        header('Location: listeProduit.php');
        exit();
    } else {
        $error = "Information manquante";
    }
}

if (isset($_POST['id_produit'])) {
   
    $produit = $produitcontroller->showProduit($_POST['id_produit']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour</title>
</head>
<body>
    <?php
    if (isset($_POST['id_produit']) && $produit) {
        ?>
        <h1 style="text-align: center;">Mettre a jour un produit</h1>
      <form action="" method="POST" id="form_produit" style="text-align: center;" enctype="multipart/form-data">
    <label for="nom_produit">Nom du produit:</label>
    <input type="text" id="nom_produit" name="nom_produit" value="<?= htmlspecialchars($produit['nom_produit']) ?>" pattern="[A-Za-z\s]+" required>
    <br><br>

    <label for="image_produit">Image du produit:</label>
    <input type="file" id="image_produit" name="image_produit" accept=".png, .jpeg, .jpg">
    <br><br>
    <img src="<?= htmlspecialchars($produit['image_produit']) ?>" alt="Image actuelle" style="max-width: 200px">
    <br><br>

    <label for="description_produit">Description du produit:</label>
    <textarea id="description_produit" name="description_produit" required><?= $produit['description_produit'] ?></textarea>
    <br><br>

    <label for="prix">Prix du produit:</label>
    <input type="number" id="prix" name="prix" value="<?= $produit['prix'] ?>" step="0.01" min="0" required>
    <br><br>

    <label for="quantite_produit">Quantité du produit:</label>
    <input type="number" id="quantite_produit" name="quantite_produit" value="<?= $produit['quantite_produit'] ?>" min="0" required>
    <br><br>

    <label for="stock_produit">Stock du produit:</label>
    <input type="number" id="stock_produit" name="stock_produit" value="<?= $produit['stock_produit'] ?>" min="0" required>
    <br><br>

   
    <input type="hidden" name="id_produit" value="<?= $_POST['id_produit'] ?>">
    <input type="hidden" name="current_image" value="<?= $produit['image_produit'] ?>">

    <input type="submit" name="envoyer" value="Mettre à jour">
</form>
        <?php
    }
    ?>
</body>
</html>
