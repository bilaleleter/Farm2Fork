<?php
include '../../Controller/Farm2ForkController.php';
include '../../Model/Produit.php';

$produit=null;

if (isset($_POST['nom_produit']) && isset($_FILES['image_produit']) 
    && isset($_POST['description_produit']) && isset($_POST['prix']) 
    && isset($_POST['quantite_produit']) && isset($_POST['stock_produit'])) {
    
    if (!empty($_POST["nom_produit"]) && !empty($_FILES["image_produit"]["name"]) 
        && !empty($_POST["description_produit"]) && !empty($_POST["prix"]) 
        && !empty($_POST["quantite_produit"]) && !empty($_POST["stock_produit"])) {

       
        $target_dir = "uploads/"; 
        $target_file = $target_dir . basename($_FILES["image_produit"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    
        if (move_uploaded_file($_FILES["image_produit"]["tmp_name"], $target_file)) {
           
            $produit = new Produit(
                NULL,
                $_POST['nom_produit'],
                $target_file, 
                $_POST['description_produit'],
                $_POST['prix'],
                $_POST['quantite_produit'],
                $_POST['stock_produit']
            );

            $produitController = new Farm2ForkController();
            $produitController->ajouterProduit($produit);
            header('Location: listeProduit.php');
            exit;
        } else {
            die("Désolé, une erreur est survenue lors du téléchargement de votre fichier.");
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter</title>
  <style>
   
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

   
    form {
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
      box-sizing: border-box;
    }

  
    label {
      font-size: 16px;
      color: #333;
      margin-bottom: 8px;
      display: block;
    }

   
    input[type="text"], input[type="number"], input[type="file"], textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 14px;
    }

    input[type="text"]:focus, input[type="number"]:focus, textarea:focus {
      border-color: #0056b3;
      outline: none;
    }

    textarea {
      height: 100px;
      resize: vertical;
    }
    input[type="submit"] {
      background-color: #0056b3;
      color: #fff;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #003d80;
    }

    
    br {
      line-height: 20px;
    }
  </style>
</head>
<body>

  <div>
    <h1>Ajouter un produit</h1>
    <form action="ajout.php" method="POST" id="form_produit" enctype="multipart/form-data">
      
      <label for="nom_produit">Nom du produit:</label>
      <input type="text" id="nom_produit" name="nom_produit" placeholder="ex: Tomates" pattern="[A-Za-z\s]+" required>
      
      <label for="image_produit">Image du produit:</label>
      <input type="file" id="image_produit" name="image_produit" accept=".png, .jpeg, .jpg" required>
      
      <label for="description_produit">Description du produit:</label>
      <textarea id="description_produit" name="description_produit" placeholder="Les tomates sont des fruits rouges ou jaunes, appréciés pour leur goût juteux et légèrement sucré." required></textarea>
      
      <label for="prix">Prix du produit:</label>
      <input type="number" id="prix" name="prix" step="0.01" min="0" required>
      
      <label for="quantite_produit">Quantité du produit:</label>
      <input type="number" id="quantite_produit" name="quantite_produit" min="0" required>
      
      <label for="stock_produit">Stock du produit:</label>
      <input type="number" id="stock_produit" name="stock_produit" min="0" required>
      
      <input type="submit" name="envoyer" value="Ajouter le produit" id="envoyer">
    </form>
  </div>

</body>
</html>

