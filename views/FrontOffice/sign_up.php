<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm2Fork Sign Up</title>
    <link rel="stylesheet" href="sign_up.css">
</head>
<header class="overlay">
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="start_page.php">
                    <img src="assets\img\farm2fork v1.png" alt="Logo" />
                </a>
            </div>
        </div>
    </nav>
</header>

<body>
    <video id="video" width="640" height="480" autoplay hidden></video>
    <canvas id="canvas" width="640" height="480" hidden></canvas>
    <form id="signup-form" action="register.php" method="POST" autocomplete="off" class="overlay">
        <!-- Role Selection -->
        <div id="role-selection" class="form-step active">
            <label for="role-select">Sélectionnez un rôle</label>
            <select id="role-select" name="role">
                <option value="0" disabled selected>Choisissez votre rôle</option>
                <option value="1">Agriculteur</option>
                <option value="2">Consommateur</option>
            </select>
            <div class="nav-buttons">
                <button type="button" id="next-button" class="nav-button">Suivant</button>
            </div>
        </div>

        <!-- Agriculteur Form Fields -->
        <div id="agriculteur-fields" class="form-step" enctype="multipart/form-data">
            <label for="profile_pic_agri">Profile Picture:</label>
            <input type="file" id="profile_pic_agri" name="profile_pic_agri" accept="image/*">
            <label for="nom_ferme_agri">Nom de la Ferme</label>
            <input type="text" id="nom_ferme_agri" name="nom_ferme_agri" placeholder="Nom de la Ferme">

            <label for="nom_prop_agri">Nom du Propriétaire</label>
            <input type="text" id="nom_prop_agri" name="nom_prop_agri" placeholder="Nom du Propriétaire">
            <label for="email_agri">Email</label>
            <div class="input-container">
                <input type="email" id="email_agri" name="email_agri" placeholder="Email">
                <span class="info-icon" data-tooltip="Please enter a valid email address.">&#9432;</span>
            </div>
            <label for="mdp_agri">Mot de Passe</label>
            <div class="input-container">
                <input type="password" id="mdp_agri" name="mdp_agri" placeholder="Mot de passe">
                <span class="info-icon"
                    data-tooltip="Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&)">&#9432;</span>
            </div>



            <label for="phone_agri">Numéro de Téléphone</label>
            <input type="tel" id="phone_agri" name="phone_agri" placeholder="Exemple: 52 789 111">
            <label for="country_agri">Pays</label>
            <select id="country_agri" name="country_agri">
                <option value="" disabled selected>Sélectionnez votre pays</option>
                <option value="AF">Afghanistan</option>
                <option value="DZ">Algeria</option>
                <option value="AR">Argentina</option>
                <option value="AU">Australia</option>
                <option value="BE">Belgium</option>
                <option value="BR">Brazil</option>
                <option value="CA">Canada</option>
                <option value="CN">China</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>
                <option value="IN">India</option>
                <option value="IT">Italy</option>
                <option value="JP">Japan</option>
                <option value="KR">South Korea</option>
                <option value="MX">Mexico</option>
                <option value="MA">Morocco</option>
                <option value="NG">Nigeria</option>
                <option value="RU">Russia</option>
                <option value="SA">Saudi Arabia</option>
                <option value="ZA">South Africa</option>
                <option value="ES">Spain</option>
                <option value="TN">Tunisia</option>
                <option value="TR">Turkey</option>
                <option value="GB">United Kingdom</option>
                <option value="US">United States</option>
                <option value="VN">Vietnam</option>
            </select>

            <label for="city_agri">Ville</label>
            <input type="text" id="city_agri" name="city_agri" placeholder="Ville">
            <label for="address_agri">Adresse</label>
            <div style="display: flex; align-items: center; justify-content:space-between; padding-right: 5px; ">
                <input type="text" id="address_agri" name="address_agri" placeholder="Adresse complète">
                <button type="button" id="locate-me-button_agri" class="location-button">
                    <img style="width: 30px; height: 30px;"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAqpJREFUSEvFlj1oFFEQx/+zGz9AkFRCchviRzSIjVgk2bvCmEZbhcsGNUEbRbAQhRR2ImgR0UIsRJD4gd67KyyDghjR7AsEv0DEIopm312joFhIPsyObkji5dy9fRcX8rpl/jO/nZk3wyOs0KEV4qJmcMPBdLPp8y4GbwQTG4xPs2y8LBVGJmpJQhdMqe6O40R0GsDWCMB7EC6pnLwJgON+Ihbc1JNpZPgPwGiLCzZvf+Yb0wdK9198raavCk45bduIzWEQGjSh8zLyfJrJlHJjXpRfJLjlUPv6yV/GawCbaoMuql+t/VFvjw8NTYX5R4Itx74NoDcC+hlEg3M25iMAmsN0DLpcFO4ZbbDV09EOptHITAlPVU52Bnarxx4GY3eE1oePVlWQ45X20IybHPsKA6cSAAch+pWQA1pgy7HfAtiREPiREnKvLvgbgPolYuI9C988a3wvFtzg4iGVTe8k0/+rZXpSAfmohNyiC54GsKpcrISMnfm5njt25fL4+afU63TBHwBsTijjcSXkP9suNAur234MQldCPX6ohNynm/FVACcTAg8oIfv1wMnNMQjU4gk3aN3SzkVllXLsdwRs/5/NBWBYCbk4DeWxIm9qyrH7CLgVWW4NA7PRVcyPVI7XnGfVEbEcewRAWoMRJrmjhOyL8q0KbsxmWg3DfwNgTY3wL4Zptk7cex4sotATuxSanPRRBgevCt0zQ6CMJ9yxag6x4PltdB3AMS0yU6/Ku3fjtFpgdHbWWRum8iDsr5oF4aKXk2fjoLGXa0mAbNa0TG8QTIfDm8Y3VG5UrypxtzoEQCknfY3AJ8psPojOq5x7Tud1ueCnV+qKP7AcO1inFwAYAGeVGB3SKa/WAokLFLxADdSt9oQbPBpqPsvKuGZKWM+SCLKcGL8BBPT3H5JVgiYAAAAASUVORK5CYII=" />
                </button>
            </div>
            <div>
                <button type="button" id="registerFace" class="face-recognition-btn" onclick="startFaceRecognition()">
                    <img id="face-icon"
                        src="data:image/png;base64,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" />
                    Set Up Face ID
                </button>
                <input type="hidden" name="face_id_agri" id="face_id_agri" value="">
            </div>


            <div class="nav-buttons">
                <button type="button" id="prev-button-agri" class="nav-button">Précédent</button>
                <button id="submit-button" type="submit" class="nav-button">Créer un Compte</button>
            </div>
        </div>

        <!-- Consommateur Form Fields -->
        <div id="consommateur-fields" class="form-step">
            <label for="profile_pic_cons">Profile Picture:</label>
            <input type="file" id="profile_pic_cons" name="profile_pic_cons" accept="image/*">
            <label for="nom_cons">Nom</label>
            <input type="text" id="nom_cons" name="nom_cons" placeholder="Votre Nom">

            <label for="prenom_cons">Prénom</label>
            <input type="text" id="prenom_cons" name="prenom_cons" placeholder="Votre Prénom">
            <label for="email_cons">Email</label>
            <div class="input-container">
                <input type="email" id="email_cons" name="email_cons" placeholder="Email">
                <span class="info-icon" data-tooltip="Please enter a valid email address.">&#9432;</span>
            </div>
            <label for="password_cons">Mot de Passe</label>
            <div class="input-container">
                <input type="password" id="password_cons" name="password_cons" placeholder="Mot de Passe">
                <span class="info-icon"
                    data-tooltip="Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&)">&#9432;</span>
            </div>


            <label for="phone_cons">Numéro de Téléphone</label>
            <input type="tel" id="phone_cons" name="phone_cons" placeholder="Exemple: 52 789 111">
            <label for="country_cons">Pays</label>
            <select id="country_cons" name="country_cons">
                <option value="" disabled selected>Sélectionnez votre pays</option>
                <option value="AF">Afghanistan</option>
                <option value="DZ">Algeria</option>
                <option value="AR">Argentina</option>
                <option value="AU">Australia</option>
                <option value="BE">Belgium</option>
                <option value="BR">Brazil</option>
                <option value="CA">Canada</option>
                <option value="CN">China</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>
                <option value="IN">India</option>
                <option value="IT">Italy</option>
                <option value="JP">Japan</option>
                <option value="KR">South Korea</option>
                <option value="MX">Mexico</option>
                <option value="MA">Morocco</option>
                <option value="NG">Nigeria</option>
                <option value="RU">Russia</option>
                <option value="SA">Saudi Arabia</option>
                <option value="ZA">South Africa</option>
                <option value="ES">Spain</option>
                <option value="TN">Tunisia</option>
                <option value="TR">Turkey</option>
                <option value="GB">United Kingdom</option>
                <option value="US">United States</option>
                <option value="VN">Vietnam</option>
            </select>

            <label for="city_cons">Ville</label>
            <input type="text" id="city_cons" name="city_cons" placeholder="Ville">

            <label for="address_cons">Adresse</label>
            <div style="display: flex; align-items: center; justify-content:space-between; padding-right: 5px; ">
                <input type="text" id="address_cons" name="address_cons" placeholder="Adresse complète">
                <button type="button" id="locate-me-button_cons" class="location-button">
                    <img style="width: 30px; height: 30px;"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAqpJREFUSEvFlj1oFFEQx/+zGz9AkFRCchviRzSIjVgk2bvCmEZbhcsGNUEbRbAQhRR2ImgR0UIsRJD4gd67KyyDghjR7AsEv0DEIopm312joFhIPsyObkji5dy9fRcX8rpl/jO/nZk3wyOs0KEV4qJmcMPBdLPp8y4GbwQTG4xPs2y8LBVGJmpJQhdMqe6O40R0GsDWCMB7EC6pnLwJgON+Ihbc1JNpZPgPwGiLCzZvf+Yb0wdK9198raavCk45bduIzWEQGjSh8zLyfJrJlHJjXpRfJLjlUPv6yV/GawCbaoMuql+t/VFvjw8NTYX5R4Itx74NoDcC+hlEg3M25iMAmsN0DLpcFO4ZbbDV09EOptHITAlPVU52Bnarxx4GY3eE1oePVlWQ45X20IybHPsKA6cSAAch+pWQA1pgy7HfAtiREPiREnKvLvgbgPolYuI9C988a3wvFtzg4iGVTe8k0/+rZXpSAfmohNyiC54GsKpcrISMnfm5njt25fL4+afU63TBHwBsTijjcSXkP9suNAur234MQldCPX6ohNynm/FVACcTAg8oIfv1wMnNMQjU4gk3aN3SzkVllXLsdwRs/5/NBWBYCbk4DeWxIm9qyrH7CLgVWW4NA7PRVcyPVI7XnGfVEbEcewRAWoMRJrmjhOyL8q0KbsxmWg3DfwNgTY3wL4Zptk7cex4sotATuxSanPRRBgevCt0zQ6CMJ9yxag6x4PltdB3AMS0yU6/Ku3fjtFpgdHbWWRum8iDsr5oF4aKXk2fjoLGXa0mAbNa0TG8QTIfDm8Y3VG5UrypxtzoEQCknfY3AJ8psPojOq5x7Tud1ueCnV+qKP7AcO1inFwAYAGeVGB3SKa/WAokLFLxADdSt9oQbPBpqPsvKuGZKWM+SCLKcGL8BBPT3H5JVgiYAAAAASUVORK5CYII=" />
                </button>
            </div>
            <label for="gender_cons">Genre</label>
            <select id="gender_cons" name="gender_cons">
                <option value="" disabled selected>Choisissez</option>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
                <option value="O">Autre</option>
            </select>
            <div>
                <button type="button" id="registerFace" class="face-recognition-btn" onclick="startFaceRecognition()">
                    <img id="face-icon"
                        src="data:image/png;base64,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" />
                    Set Up Face ID
                </button>
                <input type="hidden" name="face_id_cons" id="face_id_cons" value="">
            </div>
            <div class="nav-buttons">
                <button type="button" id="prev-button-cons" class="nav-button">Précédent</button>
                <button id="submit-button" type="submit" class="nav-button">Créer un Compte</button>
            </div>
        </div>
    </form>
    <spline-viewer url="https://prod.spline.design/W9FvZRtvN7bpFnEI/scene.splinecode"></spline-viewer>
    <script>
        var roleSelect = document.getElementById('role-select');
        const agriculteurFields = document.getElementById('agriculteur-fields');
        const consommateurFields = document.getElementById('consommateur-fields');
        const roleSelection = document.getElementById('role-selection');
        const nextButton = document.getElementById('next-button');
        const prevButtonAgri = document.getElementById('prev-button-agri');
        const prevButtonCons = document.getElementById('prev-button-cons');
        const nextButtonAgri = document.getElementById('next-button-agri');
        const submitButtons = document.querySelectorAll("#submit-button");
        const submitButton = document.getElementById("submit-button");

        nextButton.addEventListener('click', () => {
            if (roleSelect.value != 0) {
                roleSelection.classList.remove('active');
                submitButtons.forEach(element => {
                    element.style.visibility = "visible";
                });
            }

            //submitButton.style.visibility = "visible";
            if (roleSelect.value == 1) agriculteurFields.classList.add('active');
            else if (roleSelect.value == 2) consommateurFields.classList.add('active');
        });

        prevButtonAgri.addEventListener('click', () => {
            agriculteurFields.classList.remove('active');
            roleSelection.classList.add('active');
        });

        prevButtonCons.addEventListener('click', () => {
            consommateurFields.classList.remove('active');
            roleSelection.classList.add('active');
        });

    </script>
    <script src="user_geolocation.js"></script>
    <script src="sign_up_validation.js"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.42/build/spline-viewer.js"></script>
    <script>
        const viewer = document.querySelector('spline-viewer');
        window.addEventListener('load', () => {
            if (viewer) {
                const style = document.createElement('style');
                const style2 = document.createElement('style');
                const logoElement = viewer.shadowRoot.getElementById('logo');
                const element = viewer.shadowRoot.getElementById('spline');
                style.innerHTML = `
            #logo {
                display: none !important;
            }
        `;
                style2.innerHTML = `
            #spline {
                display: unset !important;
            }
        `;
                viewer.shadowRoot.appendChild(style);
                viewer.shadowRoot.appendChild(style2);
            }
        });


    </script>
    <script>
        function startFaceRecognition() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            var faceIdInput;
            if(roleSelect.value==1){
                faceIdInput = document.getElementById('face_id_agri');
            }
            else{
                faceIdInput = document.getElementById('face_id_cons');
            }
            console.log(faceIdInput);

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                    setTimeout(() => {  // Give user a moment to adjust their position
                        context.drawImage(video, 0, 0, 640, 480);
                        video.hidden = true;
                        const imageDataURL = canvas.toDataURL('image/png');
                        canvas.hidden = false;

                        // Here we call the Face++ API to register the face
                        registerFace(imageDataURL)
                            .then(faceId => {
                                faceIdInput.value = faceId;  // Store the faceId in a hidden input to be sent with the form
                                stream.getTracks().forEach(track => track.stop());  // Stop the camera stream
                                alert("Face registered successfully!");
                                stopVideoStream(video);
                                //activate check mark and desactivate button
                            })
                            .catch(error => {
                                alert("Failed to register face: " + error.message);
                                stopVideoStream(video);
                            });
                    }, 2000);
                });
        }

        function registerFace(imageDataURL) {
            return fetch('capture_face.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `image_data=${encodeURIComponent(imageDataURL)}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("date face id: ", data.face_id);
                        return data.face_id;  // Return the faceId received from the server
                    } else {
                        console.log("error: ", data.message);
                        throw new Error(data.message);
                    }
                });
        }
        function stopVideoStream(video) {
            const stream = video.srcObject;
            if (stream) {
                const tracks = stream.getTracks();

                tracks.forEach(function (track) {
                    track.stop();
                });

                video.srcObject = null; // Clear the source after stopping the track
            }
            video.hidden = true; // Optionally hide the video element
            canvas.hidden = true; // Optionally hide the canvas if you're using it
        }

    </script>
</body>

</html>