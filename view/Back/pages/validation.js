document.addEventListener('DOMContentLoaded', () => {
    function validateForm() {
        const fields = [
            { id: 'idr', message: "L'ID doit être un nombre et ne peut pas être vide.", test: value => /^\d+$/.test(value) },
            { id: 'nomr', message: "Le nom de la recette doit contenir au moins 3 caractères.", test: value => value.length >= 3 },
            { id: 'descriptionr', message: "La description doit contenir au moins 10 caractères.", test: value => value.length >= 10 },
            { id: 'tempsr', message: "Le temps de préparation doit être un nombre positif.", test: value => /^\d+$/.test(value) && parseInt(value) > 0 },
            { id: 'difficulte', message: "Veuillez sélectionner une difficulté.", test: value => value.trim() !== '' }
        ];

        fields.forEach(({ id, message, test }) => {
            const field = document.getElementById(id);
            const errorDiv = document.getElementById(`error-${id}`);

            field.addEventListener('input', () => {
                const value = field.value.trim();
                if (!test(value)) {
                    errorDiv.textContent = message;
                } else {
                    errorDiv.textContent = '';
                }
            });
        });
    }

    validateForm();
});
