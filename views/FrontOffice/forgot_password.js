//reset password form js

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('reset-password-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (validateForm()) {
            submitForm();
        }
    });

    function validateForm() {
        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(e => e.remove());
        document.querySelectorAll('input').forEach(input => {
            input.classList.remove('invalid');
            input.style.borderColor = '#ccc';
        });

        const email = document.getElementById('email');
        const newPassword = document.getElementById('new-password');
        const confirmPassword = document.getElementById('confirm-password');

        if (!validateEmail(email.value)) {
            setError(email, 'Please enter a valid email address');
            isValid = false;
        }

        if (!validatePassword(newPassword.value)) {
            setError(newPassword, 'Password must meet complexity requirements');
            isValid = false;
        }

        if (newPassword.value !== confirmPassword.value) {
            setError(confirmPassword, 'Passwords do not match');
            isValid = false;
        }

        return isValid;
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function validatePassword(password) {
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password);
    }

    function setError(input, message) {
        input.classList.add('invalid');
        input.style.borderColor = 'red';
        const error = document.createElement('small');
        error.className = 'error-message';
        error.textContent = message;
        error.style.color = 'red';
        input.parentNode.insertBefore(error, input.nextSibling);
    }

    function submitForm() {
        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (!data.success) {
                setError(document.getElementById(data.field), data.message);
            } else {
                window.location.href = data.redirect;
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }
});

//forgot password form js
document.addEventListener('DOMContentLoaded', function() {
    const forgotPasswordForm = document.getElementById('forgot-password-form');

    forgotPasswordForm.setAttribute('novalidate', true); // Disable native HTML validation.

    forgotPasswordForm.addEventListener('submit', function(event) {
        event.preventDefault();
        validateAndSubmitForgotPasswordForm();
    });

    function validateAndSubmitForgotPasswordForm() {
        const emailInput = document.getElementById('email');
        clearErrors(); // Remove previous errors and messages if any

        if (!validateEmail(emailInput.value)) {
            setError(emailInput, 'Please enter a valid email address.');
        } else {
            submitForgotPasswordForm(emailInput.value);
        }
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function setError(input, message) {
        const error = document.createElement('small');
        error.className = 'error-message';
        error.textContent = message;
        error.style.color = 'red';
        input.parentNode.appendChild(error);
        input.classList.add('invalid');
    }

    function clearErrors() {
        const errors = document.querySelectorAll('.error-message, .info-message');
        errors.forEach(error => error.remove());
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => input.classList.remove('invalid'));
    }

    function submitForgotPasswordForm(email) {
        const formData = new FormData();
        formData.append('email', email);

        fetch(forgotPasswordForm.action, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(data => {
            handleResponse(data);
        }).catch(error => {
            console.error('Error:', error);
        });
    }

    function handleResponse(data) {
        if (!data.success) {
            const emailInput = document.getElementById('email');
            setError(emailInput, data.message);
        } else {
            // Display a success message instead of alert
            setInfoMessage('A reset link has been sent to your email address.');
        }
    }

    function setInfoMessage(message) {
        const messageElement = document.createElement('small');
        messageElement.className = 'info-message';
        messageElement.textContent = message;
        messageElement.style.color = 'green'; // or any color that indicates success
        forgotPasswordForm.prepend(messageElement);
    }
});
