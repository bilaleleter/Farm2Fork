<?php
session_start();
if (isset($_SESSION['email'])) {
    //$_SESSION = array();
    if ($_SESSION['role'] === 1) {
        header("Location: ../BackOfficeUser/template/pages/agriculteur_profile.php");
    } else if ($_SESSION["role"] === 2) {
        header("Location: ../BackOfficeUser/template/pages/consomateur_profile.php");
    } else if ($_SESSION["role"] === 0) {
        header("Location: ../BackOfficeUser/template/pages/user_management.php");

    }
} else {
    session_destroy();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="start_page.css">
    <title>Farm2Fork</title>
</head>

<header>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="#">
                    <img src="assets/img/farm2fork v1.png" alt="Logo" />
                </a>
            </div>
            <ul class="navbar-links">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
            </ul>
        </div>
    </nav>
</header>

<body>
    <div class="main-content">
        <h1>Mangez local, pensez global.</h1>
        <h5>Découvrez des produits frais et de qualité directement des fermes locales, tout en soutenant une
            agriculture durable et responsable. Ensemble, faisons un pas vers un avenir plus sain et connecté.</h5>
        <div id="button_signup">
            <a href="sign_up.php">Commencez Ici</a>
            <img
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAA1BJREFUSEvFlluITHEcx7+/MzvWbSOcGbuI2O2c2VUe5JI3SUlSVlYeln3QyvWNODNqys5MLYkQSwqhjXUpDx6EpCikPLAzaxU27M7MukWyO/P/cfbCXM5lZqz2/3h+l8/vdv7/H2GYDg0TF3mDY62huZBEBQSm9AUt4R2SaJMrvU/zSSIncPR5qBwO3g7wGgClJoB3TGhOJvlIWaXvjV0QluAPL4OyQ/AJMKrtHKXImYmaRyZ6to2r8n80szMFd73cN0tKSrcZmJ4HNFX1VULwErPsDcHvXzRML5LoMQC5QGi/GaGrKOGYP6Fq99tMP1ngjo6Do4q//3gEYPY/Qf8aP/3iKFlUUbHjZ6q/LHA0HDwM8I4hgg4kzgdk1bfTFNzd3jAtkaB2AkYMJRjADxKYJVd6Pwz6Tcs42ho4CsJWE2g3M45aBUSE5QDmGekQsF9WvbuywMxMsUgwBmCimXNmPuX2+OrN5NFw4BiALSby9y7V23/p9M3dwIlHQvMEC32oLA8DTS5F20xEnKloUzFIRJ5JihZOA0dbgxtAfMYO3CdnnJNVrS4TbpMxmGiVW9GuZ4I1EAdyATPogkvZU5s3GLTFrWrH08HhoA/gfXbgfmjPeiK/yCq1dY/BRuBYa6CeCU024BZZ6V2rQ5n9UjziPCsIt9yK95xuZ19qrnYrvmsZGYeWAeKmOZguy0r5OqKaJN/1F8VKR1wceK30Gd3oUrXTdsNFAnMHn88/U935bP8YqbjnEwBnJpyBj18dJWX6tcdPmpzRsfEWAlam6hFRPQueY3EPxGVFcw3ORfoFEmm4AaYVhlkTrhIX1TElroCx1KQyrwHMMJIx4aRb8W7K+o/1D7FwYDEDdyz6/BnAeLsBNJAzMamyR2szBPcNSCTwEIyFBTg3NSHgvKx6a9Nak6nd1RaaSULcB1A2RPBXPUwLpnq0bkuwLoxHgqpg3APY9U9wQldSSAtLPXv03qcd09Un+rxxMhy9VwAsKhD+AEnnalfVrk4je8tlj/mSI9bWvhPMewGMzjGAb7+fD/8kteKQ/s+b2eS03na2+11SwqkBqLFabwm42Eu9jWWKP24XZE7gVCf688kiWS4gTZHA/F8XervoC5HnnXEhECObX/6nPy5mJcf6AAAAAElFTkSuQmCC" />
        </div>
        <div id="button_signin">
            <a href="sign_in.php">Connectez Vous</a>
            <img
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAA1BJREFUSEvFlluITHEcx7+/MzvWbSOcGbuI2O2c2VUe5JI3SUlSVlYeln3QyvWNODNqys5MLYkQSwqhjXUpDx6EpCikPLAzaxU27M7MukWyO/P/cfbCXM5lZqz2/3h+l8/vdv7/H2GYDg0TF3mDY62huZBEBQSm9AUt4R2SaJMrvU/zSSIncPR5qBwO3g7wGgClJoB3TGhOJvlIWaXvjV0QluAPL4OyQ/AJMKrtHKXImYmaRyZ6to2r8n80szMFd73cN0tKSrcZmJ4HNFX1VULwErPsDcHvXzRML5LoMQC5QGi/GaGrKOGYP6Fq99tMP1ngjo6Do4q//3gEYPY/Qf8aP/3iKFlUUbHjZ6q/LHA0HDwM8I4hgg4kzgdk1bfTFNzd3jAtkaB2AkYMJRjADxKYJVd6Pwz6Tcs42ho4CsJWE2g3M45aBUSE5QDmGekQsF9WvbuywMxMsUgwBmCimXNmPuX2+OrN5NFw4BiALSby9y7V23/p9M3dwIlHQvMEC32oLA8DTS5F20xEnKloUzFIRJ5JihZOA0dbgxtAfMYO3CdnnJNVrS4TbpMxmGiVW9GuZ4I1EAdyATPogkvZU5s3GLTFrWrH08HhoA/gfXbgfmjPeiK/yCq1dY/BRuBYa6CeCU024BZZ6V2rQ5n9UjziPCsIt9yK95xuZ19qrnYrvmsZGYeWAeKmOZguy0r5OqKaJN/1F8VKR1wceK30Gd3oUrXTdsNFAnMHn88/U935bP8YqbjnEwBnJpyBj18dJWX6tcdPmpzRsfEWAlam6hFRPQueY3EPxGVFcw3ORfoFEmm4AaYVhlkTrhIX1TElroCx1KQyrwHMMJIx4aRb8W7K+o/1D7FwYDEDdyz6/BnAeLsBNJAzMamyR2szBPcNSCTwEIyFBTg3NSHgvKx6a9Nak6nd1RaaSULcB1A2RPBXPUwLpnq0bkuwLoxHgqpg3APY9U9wQldSSAtLPXv03qcd09Un+rxxMhy9VwAsKhD+AEnnalfVrk4je8tlj/mSI9bWvhPMewGMzjGAb7+fD/8kteKQ/s+b2eS03na2+11SwqkBqLFabwm42Eu9jWWKP24XZE7gVCf688kiWS4gTZHA/F8XervoC5HnnXEhECObX/6nPy5mJcf6AAAAAElFTkSuQmCC" />
        </div>

    </div>
    <div class="info-sections">
        <section class="info-card">
            <img src="assets/img/fresh.jpg" alt="Produits Frais">
            <div class="card-content">
                <h3>Fraîcheur garantie</h3>
                <p>Vivez l'expérience du goût authentique. Notre approche directe de la ferme à la table vous assure de
                    recevoir les produits les plus frais, directement des agriculteurs locaux.</p>
            </div>
        </section>

        <section class="info-card">
            <img src="assets/img/eco friend.jpg" alt="Écologique">
            <div class="card-content">
                <h3>Pratiques écologiques</h3>
                <p>En réduisant la distance que parcourent les aliments, nous diminuons les émissions de carbone et vous
                    aidons à contribuer à une planète plus saine.</p>
            </div>
        </section>

        <section class="info-card">
            <img src="assets/img/Local-farms-and-food-producers-in-Al-Rayyan.jpg" alt="Soutien à la communauté">
            <div class="card-content">
                <h3>Soutien aux économies locales</h3>
                <p>Chaque achat soutient l'agriculture locale, maintient l'argent au sein de la communauté et renforce
                    les économies locales.</p>
            </div>
        </section>
    </div>
    <div class="impact-visualization-tool">
        <h2>Understand Your Impact</h2>
        <p>Select the types of food you often purchase to see the real impact of choosing local.</p>
        <div class="food-cards">
            <div class="food-card" onclick="calculateImpact('Fruits')">
                <img src="assets/img/fruits.jpg" alt="Fruits">
                <h3>Fruits</h3>
            </div>
            <div class="food-card" onclick="calculateImpact('Vegetables')">
                <img src="assets/img/vegetables.jpg" alt="Vegetables">
                <h3>Vegetables</h3>
            </div>
            <div class="food-card" onclick="calculateImpact('Meat')">
                <img src="assets/img/meat.jpg" alt="Meat">
                <h3>Meat</h3>
            </div>
            <div class="food-card" onclick="calculateImpact('Dairy')">
                <img src="assets/img/dairy.jpg" alt="Dairy">
                <h3>Dairy</h3>
            </div>
        </div>
        <div id="impactResults" class="impact-results-grid">
            <!-- Results will be populated by JavaScript -->
        </div>

    </div>




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

    function calculateImpact(foodType) {
        const impacts = {
            Fruits: { carbon: "2kg", water: "150L", land: "1m²" },
            Vegetables: { carbon: "1kg", water: "50L", land: "0.5m²" },
            Meat: { carbon: "10kg", water: "1000L", land: "5m²" },
            Dairy: { carbon: "5kg", water: "300L", land: "2m²" }
        };

        const impact = impacts[foodType];
        const resultsDiv = document.getElementById('impactResults');
        resultsDiv.innerHTML = `
        <div class="impact-card">
            <img src="assets/img/carbon-icon.png" alt="Carbon">
            <div class="impact-text">
                <div class="impact-value">${impact.carbon} CO2</div>
                <div class="impact-description">Carbon Emissions</div>
            </div>
        </div>
        <div class="impact-card">
            <img src="assets/img/water-icon.png" alt="Water">
            <div class="impact-text">
                <div class="impact-value">${impact.water}</div>
                <div class="impact-description">Water Used</div>
            </div>
        </div>
        <div class="impact-card">
            <img src="assets/img/land-icon.png" alt="Land">
            <div class="impact-text">
                <div class="impact-value">${impact.land}</div>
                <div class="impact-description">Land Preserved</div>
            </div>
        </div>
    `;
    }

</script>

</html>