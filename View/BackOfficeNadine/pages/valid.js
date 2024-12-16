function validateForm() {
    const fields = [
        { 
            id: 'idr', 
            errorId: 'idrError', 
            message: "L'ID de la recette doit être un nombre positif.", 
            test: value => value !== '' && !isNaN(value) && parseFloat(value) > 0 
        },
        { 
            id: 'calories', 
            errorId: 'caloriesError', 
            message: "Les calories doivent être un nombre positif.", 
            test: value => value !== '' && !isNaN(value) && parseFloat(value) > 0 
        },
        { 
            id: 'proteines', 
            errorId: 'proteinesError', 
            message: "Les protéines doivent être un nombre positif.", 
            test: value => value !== '' && !isNaN(value) && parseFloat(value) > 0 
        },
        { 
            id: 'carbohydrates', 
            errorId: 'carbohydratesError', 
            message: "Les glucides doivent être un nombre positif.", 
            test: value => value !== '' && !isNaN(value) && parseFloat(value) > 0 
        }
    ];

    let isValid = true;

    fields.forEach(({ id, errorId, message, test }) => {
        const field = document.getElementById(id);
        const errorDiv = document.getElementById(errorId);

        if (!field || !errorDiv) {
            console.error(`Missing field or error container for: ${id} / ${errorId}`);
            isValid = false;
            return;
        }

        const value = field.value.trim();
        if (!test(value)) {
            errorDiv.textContent = message; // Show error message
            errorDiv.style.color = 'red';
            isValid = false;
        } else {
            errorDiv.textContent = ''; // Clear error message
        }
    });

    return isValid; // Prevent form submission if any field is invalid
}

// Add real-time validation on input
document.addEventListener('DOMContentLoaded', () => {
    const fields = ['idr', 'calories', 'proteines', 'carbohydrates'];
    
    fields.forEach(id => {
        const field = document.getElementById(id);
        if (field) {
            field.addEventListener('input', validateForm);
        }
    });
});
