document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form_categorie');
    const nomCategorieInput = document.getElementById('nom_categorie');
  
    form.addEventListener('submit', (e) => {
        const nomCategorie = nomCategorieInput.value.trim();
  
        // Réinitialiser le message d'erreur
        let errorMessage = document.querySelector('.error-message');
        if (errorMessage) {
            errorMessage.remove();
        }
  
        // Vérification si le champ est vide ou a moins de 3 lettres
        if (nomCategorie === '') {
            e.preventDefault(); // Empêche l'envoi du formulaire
  
            // Afficher un message d'erreur pour un champ vide
            const error = document.createElement('p');
            error.textContent = 'Le nom de la catégorie est obligatoire.';
            error.style.color = 'red';
            error.classList.add('error-message');
            nomCategorieInput.parentNode.insertBefore(error, nomCategorieInput.nextSibling);
        } else if (nomCategorie.length < 3) {
            e.preventDefault(); // Empêche l'envoi du formulaire
  
            // Afficher un message d'erreur pour un champ trop court
            const error = document.createElement('p');
            error.textContent = 'Le nom de la catégorie doit contenir au moins 3 lettres.';
            error.style.color = 'red';
            error.classList.add('error-message');
            nomCategorieInput.parentNode.insertBefore(error, nomCategorieInput.nextSibling);
        }
    });
  });