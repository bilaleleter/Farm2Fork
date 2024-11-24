//reset password form js

document.addEventListener('DOMContentLoaded', function () {
    const newPassword = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const form = document.getElementById('reset-password-form');
    if(form!=null){
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (validateForm()) {
            console.log("validated form");
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
                setError(confirmPassword, data.message);
            } else {
                setInfoMessage("Your password is reset!");
                console.log("pass reset");
                setTimeout(function() {
                    window.location.href = 'sign_in.php';
                }, 1500);
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }
    function setInfoMessage(message) {
        const messageElement = document.createElement('small');
        messageElement.className = 'info-message';
        messageElement.textContent = message;
        messageElement.style.color = 'green'; // or any color that indicates success
        form.prepend(messageElement);
    }
}});
//--------------------------------------------------------------
//forgot password form js
document.addEventListener('DOMContentLoaded', function() {
    const forgotPasswordForm = document.getElementById('forgot-password-form');
    const emailInput = document.getElementById('email');
    if(forgotPasswordForm!=null){

        forgotPasswordForm.setAttribute('novalidate', true); // Disable native HTML validation.
        
        forgotPasswordForm.addEventListener('submit', function(event) {
            event.preventDefault();
            validateAndSubmitForgotPasswordForm();
        });

        function validateAndSubmitForgotPasswordForm() {
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
                console.error(data.message);
            });
        }
        
        function handleResponse(data) {
            if (!data.success) {
                const emailInput = document.getElementById('email');
                setError(emailInput, data.message);
            } else {
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
    }});
    