<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="sign_in.css"> <!-- Assuming your CSS file is named style.css -->
</head>
<style>
    spline-viewer {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 0;
}

.overlay {
    position: absolute;
    text-align: center;
    z-index: 1;
    /*pointer-events: none; makhaletnich nhoveri aal buttons*/
}
</style>
<body>
    <form action="reset_password_server.php" id="reset-password-form" method="POST" autocomplete="off" novalidate="true" class="overlay">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password">
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <button type="submit" class="nav-button">Reset Password</button>
    </form>
    <spline-viewer url="https://prod.spline.design/W9FvZRtvN7bpFnEI/scene.splinecode"></spline-viewer>
</body>
<script src="forgot_password.js"></script>
<script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.42/build/spline-viewer.js"></script>
<script>
    const viewer = document.querySelector('spline-viewer');
    window.addEventListener('load', () => {
        if(viewer) {
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

</html>
