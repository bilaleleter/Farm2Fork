<?php 
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../FrontOfficeUser/sign_in.php");
    exit;
}

// Handle logout request
if (isset($_POST['logout'])) {
    $_SESSION = array();

    session_destroy();

    header("Location: ../FrontOfficeUser/sign_in.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consomateur Profile</title>
</head>
<body>
    <h1>Hi Consomateur, <?php echo htmlspecialchars($_SESSION['email']); ?></h1>

    <!-- Logout Button -->
    <form action="" method="post">
        <button type="submit" name="logout" value="1" class="btn btn-danger">Logout</button>
    </form>
</body>
</html>
