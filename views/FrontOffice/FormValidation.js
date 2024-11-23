document.addEventListener('DOMContentLoaded', function() {
    
    const form = document.getElementById('signup-form');
    const roleSelect = document.getElementById('role-select');

    form.setAttribute('novalidate', true); // Disable HTML5 validation.

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        validateForm();
    });

    function validateForm() {
        let isValid = true;
        let firstError = null;

        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(e => e.remove());
        document.querySelectorAll('input, select').forEach(input => {
            input.classList.remove('invalid');
            input.style.borderColor = '#ccc';
        });

        // Determine fields based on the active role
        const activeFields = roleSelect.value === '1' ? document.querySelectorAll('#agriculteur-fields input, #agriculteur-fields select') : document.querySelectorAll('#consommateur-fields input, #consommateur-fields select');

        activeFields.forEach(field => {
            if (!field.value.trim()) {
                setError(field, 'This field is required');
                isValid = false;
                if (!firstError) firstError = field;
            } else if (field.type === 'email' && !validateEmail(field.value)) {
                setError(field, 'Please enter a valid email address');
                isValid = false;
                if (!firstError) firstError = field;
            } else if (field.type === 'tel' && !validatePhone(field.value)) {
                setError(field, 'Phone number must be numeric and at least 8 digits');
                isValid = false;
                if (!firstError) firstError = field;
            } else if (field.type === 'password' && !validatePassword(field.value)) {
                setError(field, 'Password must meet complexity requirements');
                isValid = false;
                if (!firstError) firstError = field;
            } else if ((field.id.includes('address') && !validateAddress(field.value))) {
                setError(field, 'Address can only contain numbers and letters');
                isValid = false;
                if (!firstError) firstError = field;
            } 
            else if(field.type === "text" && !validateText(field.value) && !field.id.includes('address')){
                setError(field, 'Can only contain characters and spaces');
                isValid = false;
                if (!firstError) firstError = field;
            }
            else {
                setSuccess(field);
            }
        });

        if (firstError) firstError.focus();

        if (isValid) submitForm();
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function validatePhone(phone) {
        return /^\d{8,}$/.test(phone); // Remove non-digits and test
    }

    function validatePassword(password) {
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password);
    }

    function validateAddress(address) {
        return /^[a-zA-Z0-9\s,.'-]+$/.test(address);
    }
    
    function validateText(input) {
        return /^[a-zA-Z\s]+$/.test(input);
    }
    
    function setError(input, message) {
        input.classList.add('invalid');
        input.style.borderColor = 'red';
        const error = document.createElement('small');
        error.className = 'error-message';
        error.textContent = message;
        error.style.color = 'red';
    
        // Check if the input type is 'email' or 'password'
        if (input.type === 'email' || input.type === 'password') {
            const container = input.closest('.input-container'); // Find the closest input container
            if (container) {
                container.parentNode.insertBefore(error, container.nextSibling); // Insert the error after the container
            } else {
                input.parentNode.insertBefore(error, input.nextSibling); // Fallback if no container is found
            }
        } else {
            input.parentNode.insertBefore(error, input.nextSibling); // Normal insertion for other input types
        }
    }
    

    function setSuccess(input) {
        input.classList.remove('invalid');
        input.style.borderColor = 'green';
    }

    function submitForm() {
        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (!data.success) {
                // Make sure you are targeting the right input field for the role selected
                const emailInput = document.querySelector(`[name="${roleSelect.value === '1' ? 'email_agri' : 'email_cons'}"]`);
                if (emailInput) {
                    setError(emailInput, data.message);
                    emailInput.focus();
                } else {
                    console.error('Email input field not found');
                }
            } else {
                window.location.href = data.redirect;
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }
    
});

