document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('login-form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        validateAndSubmitForm();
    });

    function validateAndSubmitForm() {
        // Clear previous errors
        resetErrors();

        // Client-side validation
        let hasError = false;
        if (!validateEmail(emailInput.value)) {
            setError(emailInput, 'Please enter a valid email address.');
            hasError = true;
        }

        if (!passwordInput.value.trim()) {
            setError(passwordInput, 'Password is required.');
            hasError = true;
        }

        // If no client-side errors, submit the form
        if (!hasError) {
            submitForm();
        }
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function setError(input, message) {
        input.classList.add('invalid');
        const error = document.createElement('small');
        error.className = 'error-message';
        error.textContent = message;
        error.style.color = 'red';
        input.parentNode.appendChild(error);
    }

    function resetErrors() {
        document.querySelectorAll('.error-message').forEach(e => e.remove());
        [emailInput, passwordInput].forEach(input => {
            input.classList.remove('invalid');
        });
    }

    function submitForm() {
        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (!data.success) {
                // Display server-side error using the setError function
                if (data.field && data.field === 'email') {
                    setError(emailInput, data.message);
                } else if (data.field && data.field === 'password') {
                    setError(passwordInput, data.message);
                } else {
                    // General error not specific to a field
                    alert(data.message);
                }
            } else {
                window.location.href = data.redirect; // Redirect on successful login
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }
});
