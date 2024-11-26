document.getElementById("form_produit").addEventListener("submit", function (e) {
    e.preventDefault();
  
    let isValid = true;
  
    // Sélection des champs
    const nomProduit = document.getElementById("nom_produit");
    const imageProduit = document.getElementById("image_produit");
    const descriptionProduit = document.getElementById("description_produit");
    const prix = document.getElementById("prix");
    const quantiteProduit = document.getElementById("quantite_produit");
    const stockProduit = document.getElementById("stock_produit");
    const categorie = document.getElementById("categorie");
  
    // Validation du nom du produit (au moins 3 lettres)
    if (nomProduit.value.trim().length < 3) {
      alert("Le nom du produit doit comporter au moins 3 lettres.");
      isValid = false;
    }
  
    // Validation de l'image (formats png, jpg, jpeg)
    if (!/\.(png|jpg|jpeg)$/i.test(imageProduit.value)) {
        alert("Veuillez sélectionner une image valide (.png, .jpeg, .jpg).");
        isValid = false;
    }
  
    // Validation de la description (obligatoire)
    if (descriptionProduit.value.trim() === "") {
        alert("Veuillez entrer une description pour le produit.");
        isValid = false;
    }
  
    // Validation du prix (obligatoire, positif)
    if (!prix.value.trim()) {
        alert("Le prix est obligatoire et doit être un nombre positif.");
        isValid = false;
    } else if (isNaN(prix.value) || parseFloat(prix.value) <= 0) {
        alert("Le prix doit être un nombre positif.");
        isValid = false;
    }
  
    // Validation de la quantité (obligatoire, entier positif)
    if (!/^\d+$/.test(quantiteProduit.value) || parseInt(quantiteProduit.value) < 0) {
        alert("La quantité est obligatoire et doit être un entier positif.");
        isValid = false;
    }
  
    // Validation du stock (obligatoire, entier positif)
    if (!/^\d+$/.test(stockProduit.value) || parseInt(stockProduit.value) < 0) {
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
        alert("Produit ajouté avec succès !");
        this.submit();
    }
  });
  