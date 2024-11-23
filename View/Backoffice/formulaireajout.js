document.getElementById("form_produit").addEventListener("submit", function (e) {
  e.preventDefault();

  let isValid = true;

 
  const nomProduit = document.getElementById("nom_produit");
  const imageProduit = document.getElementById("image_produit");
  const descriptionProduit = document.getElementById("description_produit");
  const prix = document.getElementById("prix");
  const quantiteProduit = document.getElementById("quantite_produit");
  const stockProduit = document.getElementById("stock_produit");

  
  if (!/^[A-Za-z\s]+$/.test(nomProduit.value)) {
    alert("Veuillez entre un nom pour le produit.");
    isValid = false;
  }

  
  if (!/\.(png|jpg|jpeg)$/i.test(imageProduit.value)) {
    alert("Veuillez sélectionner une image valide (.png, .jpeg, .jpg).");
    isValid = false;
  }

  
  if (descriptionProduit.value.trim() === "") {
    alert("Veuillez entrer une description pour le produit.");
    isValid = false;
  }

  
  if (!prix.value.trim()) {
    alert("Le prix est obligatoire et doit être un nombre positif.");
    isValid = false;
  } else if (isNaN(prix.value) || parseFloat(prix.value) <= 0) {
    alert("Le prix doit être un nombre positif.");
    isValid = false;
  }




 
  if (!/^\d+$/.test(quantiteProduit.value) || parseInt(quantiteProduit.value) < 0) {
    alert("La quantité est obligatoire et doit être un entier positif.");
    isValid = false;
  }

  
  if (!/^\d+$/.test(stockProduit.value) || parseInt(stockProduit.value) < 0) {
    alert("Le stock est obligatoire et doit être un entier positif.");
    isValid = false;
  }

  
  if (isValid) {
    alert("Produit ajouté avec succès !");
    this.submit();
  }
});
