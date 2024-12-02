function validForm() {
    // Récupérer les valeurs des champs
    const idProduit = document.getElementById('idProduit').value.trim();
    const idr = document.getElementById('idr').value.trim();
    const calories = document.getElementById('calories').value.trim();
    const proteines = document.getElementById('proteines').value.trim();
    const carbohydrates = document.getElementById('carbohydrates').value.trim();

    // Validation pour idProduit
    if (!idProduit || isNaN(parseFloat(idProduit)) || parseFloat(idProduit) <= 0) {
        alert("L'ID Produit doit être un nombre décimal positif.");
        return false;
    }

    // Validation pour idr
    if (!idr || isNaN(parseFloat(idr)) || parseFloat(idr) <= 0) {
        alert("L'ID Recette doit être un nombre décimal positif.");
        return false;
    }

    // Validation pour calories
    if (!calories || isNaN(parseFloat(calories)) || parseFloat(calories) <= 0) {
        alert("Les calories doivent être un nombre décimal positif.");
        return false;
    }

    // Validation pour proteines
    if (!proteines || isNaN(parseFloat(proteines)) || parseFloat(proteines) < 0) {
        alert("Les protéines doivent être un nombre décimal non négatif.");
        return false;
    }

    // Validation pour carbohydrates
    if (!carbohydrates || isNaN(parseFloat(carbohydrates)) || parseFloat(carbohydrates) < 0) {
        alert("Les glucides doivent être un nombre décimal non négatif.");
        return false;
    }

    // Si tout est valide
    return true;
}
