<?php 
session_start();
if (isset($_SESSION['email'])) {
    //$_SESSION = array();
    if($_SESSION['role'] === 1){
        header("Location: ../BackOffice/template/pages/agriculteur_profile.php");
    }
    else if($_SESSION["role"] === 2){
        header("Location: ../BackOffice/template/pages/consomateur_profile.php");
    }
    else if($_SESSION["role"] === 0){
        header("Location: ../BackOffice/template/pages/user_management.php");

    }
  }
  else{
    session_destroy();
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm2Fork Sign In</title>
    <link rel="stylesheet" href="sign_in.css">
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
    <video id="video" width="640" height="480" autoplay hidden ></video>
    <canvas id="canvas" width="640" height="480" hidden class="overlay"></canvas>
    <form id="login-form" action="login.php" method="POST" autocomplete="off" novalidate="true" class="overlay">
        <div id="signin-fields" class="form-step active">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            
            <label for="password">Mot de Passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de Passe" required>
            
            <div class="nav-buttons">
                <button type="submit" class="nav-button">Se Connecter</button>
            </div>
            <div>
                <button type="button" id="face-login-btn" onclick="startFaceRecognition()" class="nav-buttons">Se connecter avec Face ID?</button>
            </div>
        </div>
        <div class="signup-link">
            <p>Mot de passe oublié? <a href="forgot_password.php">Réinitialiser</a></p>
        </div>
        
    </form>
    <spline-viewer url="https://prod.spline.design/W9FvZRtvN7bpFnEI/scene.splinecode"></spline-viewer>
</body>
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
<script src="face_recognition_login.js"></script>
<script src="sign_in_validation.js"></script>

</html>
