<?php
include './../../Controller/Farm2ForkController.php';
$farm2forkcontroller=new Farm2ForkController();
$liste=$farm2forkcontroller->listeProduit();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste de produit</title>
</head>
<body>
  <br><br>
  <td><a href="ajout.php">Ajouter un produit</a></td>
  <br><br><br>
  <table border="1">
  <tr >
  <th>Nom du produit</th>
  <th>Image du produit</th>
  <th>Description du produit</th>
  <th>Prix du produit</th>
  <th>Quantité du produit</th>
  <th>Stock du produit</th>
  <th colspan="2">Actions</th>
  </tr>

   <?php
   foreach($liste as $produit){
?>
  <tr>
  <td><?=  $produit['nom_produit'] ?></td>
  <td><img src="<?= $produit['image_produit'] ?>" alt="<?= $produit['nom_produit'] ?>" style="width:100px;height:auto;"></td>
  <td><?=  $produit['description_produit'] ?></td>
  <td><?=  $produit['prix'] ?></td>
  <td><?=  $produit['quantite_produit'] ?></td>
  <td><?=  $produit['stock_produit'] ?></td>
  <td><a href="supprimerProduit.php?id_produit=<?= $produit['id_produit']?>">Supprimer un Produit</a></td>
  <td>
       <form action="updateProduit.php" method="post">
       <input type="submit" value="Mettre a jour">
       <input type="hidden" value="<?php  echo $produit['id_produit']; ?>" name="id_produit">
       </form>
  </td>
 </tr>
  <?php
   }
   ?>
</table>
</body>
</html>