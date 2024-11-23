<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm2Fork Sign In</title>
    <link rel="stylesheet" href="sign_in.css">
</head>
<header>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="start_page.php">
                    <img src="assets\img\farm2fork v1.png" alt="Logo" />
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
    <form id="login-form" action="..\..\login.php" method="POST" autocomplete="off" novalidate="true">
        <div id="signin-fields" class="form-step active">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <label for="password">Mot de Passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de Passe" required>
            
            <div class="nav-buttons">
                <button type="submit" class="nav-button">Se Connecter</button>
            </div>
        </div>
        
        <div class="signup-link">
            <p>Pas de compte? <a href="sign_up.php">S'inscrire</a></p>
        </div>
    </form>
</body>
<script src="sign_in_validation.js"></script>

</html>
