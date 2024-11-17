function validateAgriculteurFields() {
    let verif = 1; // init 1 =valid
    const agriFields = [
        "nom_ferme_agri",
        "nom_prop_agri",
        "email_agri",
        "mdp_agri",
        "phone_agri",
        "country_agri",
        "city_agri",
        "address_agri",
    ];

    agriFields.forEach((fieldId) => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener("input", () => {
                if (isFieldValid(field)) {
                    field.style.border = "2px solid green"; 
                } else {
                    field.style.border = "2px solid red"; 
                }
            });
            if (!isFieldValid(field)) {
                field.style.border = "2px solid red";
                verif = 0;
            } else {
                field.style.border = "2px solid green";
            }
        }
    });

    return verif;
}

function validateConsommateurFields() {
    let verif = 1; 
    const consFields = [
        "nom_cons",
        "prenom_cons",
        "email_cons",
        "password_cons",
        "phone_cons",
        "country_cons", 
        "gender_cons"
    ];

    consFields.forEach((fieldId) => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener("input", () => {
                if (isFieldValid(field)) {
                    field.style.border = "2px solid green"; 
                } else {
                    field.style.border = "2px solid red"; 
                }
            });
            if (!isFieldValid(field)) {
                field.style.border = "2px solid red";
                verif = 0;
            } else {
                field.style.border = "2px solid green";
            }
        }
    });

    return verif;
}

function isFieldValid(field) {
    if (!field.value.trim()) return false; // Check if the field is empty

    switch (field.type) {
        case "email":
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value); // Validate email format
        case "password":
            // Password: min 8 characters, 1 uppercase, 1 lowercase, 1 number, 1 special character
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(field.value);
        case "tel":
            // Phone number: digits only, length check (e.g., 8-15 digits)
            return /^[0-9]{8,15}$/.test(field.value);
        case "select-one":
            return field.value !== ""; 
        default:
            return field.value !== ""; 
    }
}

document.addEventListener("submit", (event) => {

    if (roleSelect.value == 1) {
        if (!validateAgriculteurFields()) {
            alert("Check Form");
            event.preventDefault(); 
        }
    } else if (roleSelect.value == 2) {
        if (!validateConsommateurFields()) {
            alert("Check Form");
            event.preventDefault(); 
        }
    }
});
