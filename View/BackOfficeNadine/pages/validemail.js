document.addEventListener('DOMContentLoaded', () => {
    function validateForm() {
        const fields = [
            { 
                id: 'adresse', 
                errorId: 'emailError', // Correct error ID for the email field
                message: "Veuillez entrer une adresse email valide.", 
                test: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) 
            },
            { 
                id: 'objet', 
                errorId: 'subjectError', // Correct error ID for the subject field
                message: "L'objet doit contenir au moins 3 caractères.", 
                test: value => value.trim().length >= 3 
            },
            { 
                id: 'message', 
                errorId: 'messageError', // Correct error ID for the message field
                message: "Le message doit contenir au moins 10 caractères.", 
                test: value => value.trim().length >= 10 
            }
        ];

        fields.forEach(({ id, errorId, message, test }) => {
            const field = document.getElementById(id);
            const errorDiv = document.getElementById(errorId);

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
