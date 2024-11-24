<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="sign_in.css"> <!-- Assuming your CSS file is named style.css -->
</head>

<body>
    <div class="navbar">
        <!-- Navbar content here -->
    </div>
    <form id="forgot-password-form" action="send_reset_link.php" method="post" autocomplete="off" novalidate="true"
        class="overlay">
        <h1>Forgot Your Password?</h1>
        <label for="email">Enter your email address:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" class="nav-button">Send Reset Link</button>
    </form>
    <script src="forgot_password.js"></script>
    <spline-viewer url="https://prod.spline.design/W9FvZRtvN7bpFnEI/scene.splinecode"></spline-viewer>
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
</body>

</html>