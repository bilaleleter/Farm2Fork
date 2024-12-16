<?php

session_start();

if (!isset($_SESSION['email'])) {
  $_SESSION = array();
  session_destroy();
  header("Location: ../../../FrontOfficeUser/sign_in.php");
  exit;
}

// Check if logout has been requested
if (isset($_POST['logout'])) {
  $_SESSION = array();
  session_destroy();
  header("Location: ../../../FrontOfficeUser/start_page.php");
  exit;
}

require_once '../../../../Controller/UserController.php';  // Adjust path as needed
$userController = new UserController();
$user = $userController->getUserByEmail($_SESSION['email']);
if ($user == null) {
  echo "error getting user info";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $updatedUser = new UserModel();
  $updatedUser->setEmail($user['email']);
  $updatedUser->setPhoneNumber($user['phone_number']);
  $updatedUser->setCountry($user['country']);
  $updatedUser->setCity($user['city']);
  $updatedUser->setAddress($user['address']);
  $updatedUser->setFarmName($user['farm_name']);
  $updatedUser->setFarmOwnerName($user['farm_owner_name']);
  $updatedUser->setFarmDescription($user['farm_description']);
  $updatedUser->setPassword($user['password']);
  $updatedUser->setRoleId($user['role_id']);
  $updatedUser->setProfilePic($user['profile_pic']); //default
  // Handling profile update
  if (isset($_POST['updateProfile'])) {
    $profile_pic = $_FILES['profile_pic'];

    if (!empty($_POST['phone_number']) && $_POST['phone_number'] != $user['phone_number']) {
      $updatedUser->setPhoneNumber($_POST['phone_number']);
    }
    if (!empty($_POST['farmName']) && $_POST['farmName'] != $user['farm_name']) {
      $updatedUser->setFarmName($_POST['farmName']);
    }
    if (!empty($_POST['farmOwner']) && $_POST['farmOwner'] != $user['farm_owner_name']) {
      $updatedUser->setFarmOwnerName($_POST['farmOwner']);
    }
    //pfp
    if (!empty($profile_pic) && isset($profile_pic) && $profile_pic['error'] == UPLOAD_ERR_OK) {
      $uploadDir = '../../../FrontOfficeUser/assets/profile_pics/';
      $tmpName = $profile_pic['tmp_name'];
      $fileName = basename($profile_pic['name']);
      $pathParts = pathinfo($fileName);
      $ext = strtolower($pathParts['extension']);

      // Validate file extension
      $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
      if (in_array($ext, $allowedExts)) {
        $newFileName = md5(uniqid(rand(), true)) . '.' . $ext; // Create a unique name for the file
        $finalPath = $uploadDir . $newFileName;

        if (move_uploaded_file($tmpName, $finalPath)) {
          $profile_pic = "assets/profile_pics/" . $newFileName;
          $updatedUser->setProfilePic($profile_pic); //default

        } else {
          echo '<p>Failed to save file.</p>';
          exit();
        }
      } else {
        echo '<p>Invalid file type.</p>';
        exit();
      }
    }

    // Perform update
    $result = $userController->updateUser($updatedUser, $user['user_id']);
    echo $result ? '<p>Profile updated successfully.</p>' : '<p>Failed to Update Profile.</p>';
    if ($result) {
      header('Location: agriculteur_profile.php');
      exit;
    }
  }

  // Handling security settings
  if (isset($_POST['updateSecurity'])) {
    $current_password = $_POST['currentPassword'];
    $new_password = $_POST['newPassword'];
    $new_password_confirm = $_POST['confirmNewPassword'];
    $newEmail = $_POST['newEmail'];
    if (isset($new_password) && isset($new_password_confirm) && isset($current_password) && $new_password_confirm == $new_password) {
      if (password_verify($current_password, $user['password'])) {
        // Update password if different
        if (!empty($new_password) && !password_verify($new_password, $user['password'])) {
          $updatedUser->setPassword(password_hash($new_password, PASSWORD_DEFAULT));
        }
        $result = $userController->updateUser($updatedUser, $user['user_id']);
        echo $result ? "<p>Password updated successfully.</p>" : "<p>Failed to update password.</p>";
        if ($result) {
          header('Location: agriculteur_profile.php');
          exit;
        }
        }else{
          echo "<p>Current password is incorrect.</p>";
        }
    } else {
      echo '<p>Passwords do not match</p>';
    }

    if (isset($newEmail)) {
      if ($user['email'] != $newEmail) {
        if (!empty($newEmail)) {
          $updatedUser->setEmail($newEmail);
          $result = $userController->updateUser($updatedUser, $user['user_id']);
          echo $result ? "<p>User update was successful</p>" : "<p>Update Email Fail</p>";
          if ($result) {
            $_SESSION['email'] = $newEmail;
            header('Location: agriculteur_profile.php');
            exit;
          }
        }
      } else {
        echo "<p>New email can't be the same as the old one</p>";
      }
    }
  }
}

?>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
  <title>Profile</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

</head>
<style>
  label {
    color: #e91e63;
  }

  .profile-pic {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #fff;
  }
</style>

<body class="g-sidenav-show bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
        target="_blank">
        <img src="../../../FrontOfficeUser/assets/img/farm2fork v1.png" class="navbar-brand-img" alt="main_logo" />
        <span class="ms-1 text-sm text-dark">Farm2Fork</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2" />
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeBilel\index.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Marketplace</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeBilel\pages\listeProduit.html">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Gestion des Produits</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeBilel\pages\listeCategorie.html">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Gestion des Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\OfficeFeedback\AfficherAvis.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Reponse au Avis</span>
          </a>
        </li>
        
        <!--<li class="nav-item">
          <a class="nav-link text-dark" href="../pages/logs.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Logs</span>
          </a>
        </li>-->
        <!--
          <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account</h6>
          </li>
          -->
      </ul>
    </div>
    <form method="post" name="SignOutForm" id="SignOutForm"></form>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3">
        <a class="btn btn-outline-dark mt-4 w-100" href="agriculteur_profile.php" type="button">Profil</a>
        <button type="submit" class="btn bg-gradient-dark w-100" form="SignOutForm" name="logout">Se Deconnecter</button>
      </div>
    </div>
  </aside>
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">

        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
          <ul class="navbar-nav d-flex align-items-center justify-content-end">
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
              </a>
            </li>
            <li class="nav-item dropdown pe-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="material-symbols-rounded">notifications</i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" />
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span>
                          from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg"
                          class="avatar avatar-sm bg-gradient-dark me-3" />
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by
                          Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary me-3 my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background"
                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                    opacity="0.593633743"></path>
                                  <path class="color-background"
                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                  </path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="../pages/profile.html" class="nav-link text-body font-weight-bold px-0">
                <i class="material-symbols-rounded">account_circle</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="
            background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2');
          ">
        <span class="mask bg-gradient-dark opacity-6"></span>
      </div>
      <div class="card card-body mx-2 mx-md-2 mt-n6 overflow-hidden">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../../../FrontOfficeUser/<?php echo htmlspecialchars($user['profile_pic']) ?>" alt="profile_image"
                class="profile-pic" />
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo htmlspecialchars($user['farm_name']); ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">Agriculteur</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <button class="btn btn-primary" onclick="editProfile()">
              Edit Profile
            </button>
            <button class="btn btn-secondary" onclick="editSecurity()">
              Security Settings
            </button>
          </div>
        </div>
        <div class="row">

          <!-- Public and Private Information -->
          <div class="col-12">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Profile Information</h6>
              </div>
              <div class="card-body p-3">
                <div class="row">
                  <!-- Public Information -->
                  <div class="col-xl-8">
                    <ul class="list-group">
                      <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <strong class="text-dark">Nom de la ferme:</strong>
                        <?php echo htmlspecialchars($user['farm_name']); ?>
                      </li>
                      <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">Nom du Proprietere:</strong>
                        <?php echo htmlspecialchars($user['farm_owner_name']); ?>
                      </li>
                      <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">Email:</strong>
                        <?php echo htmlspecialchars($user['email']); ?>
                      </li>
                      <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">Telephone:</strong> (+<?php echo htmlspecialchars($user['country']); ?>)
                        <?php echo htmlspecialchars($user["phone_number"]); ?>
                      </li>
                      <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">Adresse:</strong>
                        <?php echo htmlspecialchars($user['city']); ?>,
                        <?php echo htmlspecialchars($user['address']); ?>,<?php echo htmlspecialchars($user['country']); ?>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-symbols-rounded py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">UI Configuration</h5>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-symbols-rounded">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1" />
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark active" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2" data-class="bg-gradient-dark" onclick="sidebarType(this)">
            Dark
          </button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">
            Transparent
          </button>
          <button class="btn bg-gradient-dark px-3 mb-2 active ms-2" data-class="bg-white" onclick="sidebarType(this)">
            White
          </button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">
          You can change the sidenav type just on desktop view.
        </p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)" />
          </div>
        </div>
        <hr class="horizontal dark my-3" />
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf("Win") > -1;
    if (win && document.querySelector("#sidenav-scrollbar")) {
      var options = {
        damping: "0.5",
      };
      Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
    }
  </script>
  <script>
    function editProfile() {
      const profileInfo = `
      <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" enctype="multipart/form-data" name="editProfileForm" id="editProfileForm" autocomplete="off">
              <div class="form-group">
                  <label for="profile_pic">Profile Picture</label>
                  <input type="file" class="form-control-file" id="profile_pic" name="profile_pic" accept="image/*">
                </div>
                <div class="form-group">
                  <label for="farmName">Nom de la ferme</label>
                  <input type="text" class="form-control" id="farmName" name="farmName" value="<?php echo htmlspecialchars($user['farm_name']); ?>">
                </div>
                <div class="form-group">
                  <label for="farmOwner">Owner Name</label>
                  <input type="text" class="form-control" id="farmOwner" name="farmOwner" value="<?php echo htmlspecialchars($user['farm_owner_name']); ?>">
                </div>
                <div class="form-group">
                  <label for="farmDescription">Description</label>
                  <textarea class="form-control" id="farmDescription" name="farmDescription"><?php echo htmlspecialchars($user['farm_description']); ?></textarea>
                </div>
                <div class="form-group">
                  <label for="phone_number">Description</label>
                  <text class="form-control" id="phone_number" name="phone_number"><?php echo htmlspecialchars($user['phone_number']); ?></text>
                </div>
                
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" form="editProfileForm" name="updateProfile" onclick="saveProfileChanges()">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      `;
      document.body.innerHTML += profileInfo;
      var modal = new bootstrap.Modal(document.getElementById('editProfileModal'));
      modal.show();
    }

    function saveProfileChanges() {

      alert("Changes saved! (simulated)");
    }

    function editSecurity() {
      const securityInfo = `
    <div class="modal fade" id="editSecurityModal" tabindex="-1" role="dialog" aria-labelledby="editSecurityModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editSecurityModalLabel">Security Settings</h5>
          </div>
          <div class="modal-body">
            <form method="POST" autocomplete="off" name="securitySettingsForm" id="securitySettingsForm">
              <div class="form-group">
                <label for="profileEmail">Change Email</label>
                <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="Enter new email">
              </div>
              <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Enter current password">
              </div>
              <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password">
              </div>
              <div class="form-group">
                <label for="confirmNewPassword">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Re-enter new password">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" onclick="saveSecurityChanges()" form="securitySettingsForm" name="updateSecurity">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  `;
      document.body.innerHTML += securityInfo;
      var modal = new bootstrap.Modal(document.getElementById('editSecurityModal'));
      modal.show();
    }

    function saveSecurityChanges() {
      const email = document.getElementById('profileEmail').value;
      const currentPassword = document.getElementById('currentPassword').value;
      const newPassword = document.getElementById('newPassword').value;
      const confirmNewPassword = document.getElementById('confirmNewPassword').value;
      console.log('Saving Security Changes:', email, currentPassword, newPassword, confirmNewPassword);
      // Here, integrate with backend to actually save the changes
      alert('Security Changes saved! (simulated)');
    }

  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>