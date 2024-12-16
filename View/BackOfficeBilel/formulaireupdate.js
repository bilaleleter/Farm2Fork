document.getElementById("form_produit").addEventListener("submit", function (e) {
    e.preventDefault(); // Empêche l'envoi du formulaire par défaut
  
    let isValid = true;
  
    // Champs à valider
    const nomProduit = document.getElementById("nom_produit");
    const imageProduit = document.getElementById("image_produit");
    const descriptionProduit = document.getElementById("description_produit");
    const prix = document.getElementById("prix");
    const quantiteProduit = document.getElementById("quantite_produit");
    const stockProduit = document.getElementById("stock_produit");
    const categorie = document.getElementById("categorie");
  
    // Validation du nom (au moins 3 lettres)
    if (nomProduit.value.trim().length < 3) {
        alert("Le nom du produit doit comporter au moins 3 lettres.");
        isValid = false;
      }
    
  
    // Validation de l'image (formats autorisés)
    if (imageProduit.value && !/\.(png|jpg|jpeg)$/i.test(imageProduit.value)) {
        alert("Veuillez sélectionner une image valide (.png, .jpeg, .jpg).");
        isValid = false;
    }
  
    // Validation de la description (non vide)
    if (descriptionProduit.value.trim() === "") {
        alert("Veuillez entrer une description pour le produit.");
        isValid = false;
    }
  
    // Validation du prix (nombre positif)
    if (!prix.value.trim() || isNaN(prix.value) || parseFloat(prix.value) <= 0) {
        alert("Le prix est obligatoire et doit être un nombre positif.");
        isValid = false;
    }
  
    // Validation de la quantité (entier positif)
    if (!/^\d+$/.test(quantiteProduit.value.trim()) || parseInt(quantiteProduit.value) < 0) {
        alert("La quantité est obligatoire et doit être un entier positif.");
        isValid = false;
    }
  
    // Validation du stock (entier positif)
    if (!/^\d+$/.test(stockProduit.value.trim()) || parseInt(stockProduit.value) < 0) {
        alert("Le stock est obligatoire et doit être un entier positif.");
        isValid = false;
    }
  
    // Validation de la catégorie (obligatoire)
    if (categorie.value === "") {
        alert("Veuillez sélectionner une catégorie.");
        isValid = false;
      }
  
    // Si tout est valide, soumettre le formulaire
    if (isValid) {
        alert("Mise à jour réussie !");
        this.submit();
    }
  });
  