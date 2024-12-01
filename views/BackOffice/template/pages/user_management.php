<?php

session_start();

if (!isset($_SESSION['email'])) {
  $_SESSION = array();
  session_destroy();
  header("Location: ../../../FrontOffice/sign_in.php");
  exit;
}

// Check if logout has been requested
if (isset($_POST['logout'])) {
  // Destroy the session
  $_SESSION = array();
  session_destroy();

  // Redirect to the login page
  header("Location: ../../../FrontOffice/start_page.php");
  exit;
}

require_once '../../../../controllers/UserController.php';  // Adjust path as needed
$userController = new UserController();
$consommateurs = $userController->getConsommateurs();
$agriculteurs = $userController->getAgriculteurs();

?>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
  <title>Admin - Gestion Utilisateur</title>
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
  <link id="pagestyle" href="../assets/css/material-dashboard.css" rel="stylesheet" />
</head>

<style>
  label {
    color: #e91e63 !important;
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
        <img src="../../../FrontOffice/assets/img/farm2fork v1.png" class="navbar-brand-img" alt="main_logo" />
        <span class="ms-1 text-sm text-dark">Farm2Fork</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2" />
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/dashboard.html">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="../pages/user_management.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">User Management</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/logs.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Logs</span>
          </a>
        </li>
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
        <a class="btn btn-outline-dark mt-4 w-100" href="profile.php" type="button">Account</a>
        <button type="submit" class="btn bg-gradient-dark w-100" form="SignOutForm" name="logout">Sign out</button>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
              <a class="opacity-5 text-dark" href="javascript:;">Admin Name</a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
              User Management
            </li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Search User</label>
              <input type="text" class="form-control" id="user_search" />
              <button onclick="performSearch()" class="btn btn-outline-primary"
                style="border-left: 0px;">Search</button>
            </div>
          </div>


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
              <a href="../pages/profile.php" class="nav-link text-body font-weight-bold px-0">
                <i class="material-symbols-rounded">account_circle</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <!-- User Management Section Header -->
      <div class="container-fluid py-4">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">User Management</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <ul class="nav nav-tabs" id="userTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="consommateur-tab" data-bs-toggle="tab"
                  data-bs-target="#consommateur" type="button" role="tab" aria-controls="consommateur"
                  aria-selected="true">
                  Consommateur
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="agriculteur-tab" data-bs-toggle="tab" data-bs-target="#agriculteur"
                  type="button" role="tab" aria-controls="agriculteur" aria-selected="false">
                  Agriculteur
                </button>
              </li>
              <!-- Place this in your HTML where it's visible above the tables -->
              <div id="alertPlaceholder" style="padding: 0 1.5rem;"></div>

            </ul>

            <div class="tab-content" id="userTabContent">
              <!-- Consommateur Table -->
              <div class="tab-pane fade show active" id="consommateur" role="tabpanel"
                aria-labelledby="consommateur-tab">
                <div class="table-responsive p-2">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($consommateurs as $user): ?>
                        <tr>
                          <td>
                            <img src="../../../FrontOffice/<?php echo htmlspecialchars($user['profile_pic']) ?>"
                              class="avatar avatar-sm me-3" alt="user">
                            <?= htmlspecialchars($user["nom_consomateur"]) . " " . htmlspecialchars($user["prenom_consomateur"]); ?>
                          </td>
                          <td><?= htmlspecialchars($user["email"]); ?></td>
                          <td>
                            <?= htmlspecialchars($user["phone_number"]) . "(" . htmlspecialchars($user['country'] . ")"); ?>
                          </td>
                          <td>
                            <form class="btn btn-success btn-sm">
                              <input type="hidden" name="user_id" value="<?= $user["user_id"]; ?>">
                              <button type="button" class="btn btn-success btn-sm edit-button" style="margin-bottom:0px;"
                                data-user-id="<?= $user['user_id']; ?>"
                                data-user-type="<?= $user['role_id']; ?>">Edit</button>
                            </form>

                            <?php if ($user['ban_until'] && new DateTime($user['ban_until']) > new DateTime()): ?>
                              <form method="post" action="../../unban_user.php" class="btn btn-success btn-sm"
                                style="display: inline;">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <button type="submit" name="unban" class="btn btn-success btn-sm">Unban</button>
                              </form>
                            <?php else: ?>
                              <form class="btn btn-warning btn-sm">

                                <button type="button" onclick="showBanModal(<?= $user['user_id'] ?>)" class="btn btn-warning btn-sm"
                                  style="margin:0px;">Ban</button>
                              </form>
                            <?php endif; ?>

                            <form method="POST" action="../../delete_user.php" class="btn btn-danger btn-sm"
                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                              <input type="hidden" name="user_id" value="<?= $user["user_id"]; ?>">
                              <button type="submit" class="btn btn-danger btn-sm"
                                style="margin-bottom:0px;">Delete</button>
                            </form>

                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Agriculteur Table -->
              <div class="tab-pane fade" id="agriculteur" role="tabpanel" aria-labelledby="agriculteur-tab">
                <div class="table-responsive p-2">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th>Farm Name</th>
                        <th>Farm Owner</th>
                        <th>Email</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($agriculteurs as $user): ?>
                        <tr>
                          <td>
                            <img src="../../../FrontOffice/<?php echo htmlspecialchars($user['profile_pic']) ?>"
                              class="avatar avatar-sm me-3" alt="user">
                            <?= htmlspecialchars($user["farm_name"]); ?>
                          </td>
                          <td><?= htmlspecialchars($user["farm_owner_name"]); ?></td>
                          <td><?= htmlspecialchars($user["email"]); ?></td>
                          <td>
                            <form class="btn btn-success btn-sm">
                              <input type="hidden" name="user_id" value="<?= $user["user_id"]; ?>">
                              <button type="button" class="btn btn-success btn-sm edit-button" style="margin-bottom:0px;"
                                data-user-id="<?= $user['user_id']; ?>"
                                data-user-type="<?= $user['role_id']; ?>">Edit</button>
                            </form>

                            <?php if ($user['ban_until'] && new DateTime($user['ban_until']) > new DateTime()): ?>
                              <form method="post" action="../../unban_user.php" class="btn btn-success btn-sm"
                                style="display: inline;">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <button type="submit" name="unban" class="btn btn-success btn-sm">Unban</button>
                              </form>
                            <?php else: ?>
                              <form class="btn btn-warning btn-sm">

                                <button type="button" onclick="showBanModal(<?= $user['user_id'] ?>)" class="btn btn-warning btn-sm"
                                  style="margin:0px;">Ban</button>
                              </form>
                            <?php endif; ?>

                            <form method="POST" action="../../delete_user.php" class="btn btn-danger btn-sm"
                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                              <input type="hidden" name="user_id" value="<?= $user["user_id"]; ?>">
                              <button type="submit" class="btn btn-danger btn-sm"
                                style="margin-bottom:0px;">Delete</button>
                            </form>

                          </td>

                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                Add New User
              </button>
            </div>

            <!-- Modal for Adding New User -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">
                      Add New User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="addUserForm" method="post" action="../../add_user.php">
                      <!-- Dynamic fields inserted here based on selected role -->
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-dark" form="addUserForm">
                      Add User
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
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
  <!-- Edit User Modal -->
  <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editUserForm" method="POST" action="../../edit_user.php">
            <!-- Dynamic user fields will be inserted here -->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="editUserForm" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Ban User Modal -->
  <div class="modal fade" id="banUserModal" tabindex="-1" aria-labelledby="banUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="banUserModalLabel">Ban User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form content will be injected here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="banForm" class="btn btn-warning">Ban User</button>
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
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
  <!-- USER ADD SCRIPT FORM-->

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var addUserModal = document.getElementById("addUserModal");
      addUserModal.addEventListener("show.bs.modal", function () {
        var activeTabButton = document.querySelector(
          ".nav-tabs .nav-link.active"
        );
        var activeTab = activeTabButton
          ? activeTabButton.textContent.trim()
          : "";
        var form = document.getElementById("addUserForm");
        form.innerHTML = ""; // Ensure form is cleared each time modal opens

        console.log("Active Tab:", activeTab); // Check what text content is actually retrieved

        if (activeTab === "Consommateur") {
          // Make sure spelling and case are correct
          console.log("Setting up form for Consommateur");
          form.innerHTML = `
        <!-- Consommateur-specific fields -->
          <input type="hidden" class="form-control" id="role_id" name="role_id" value="2">
        <div class="mb-3">
          <label for="userProfilePic" class="form-label">Profile Picture</label>
          <input type="file" class="form-control" id="userProfilePic" name="profilePic">
        </div>
<div class="mb-3">
  <label for="userFirstName" class="form-label">First Name</label>
  <input type="text" class="form-control" id="userFirstName" name="firstName" required>
</div>
<div class="mb-3">
  <label for="userLastName" class="form-label">Last Name</label>
  <input type="text" class="form-control" id="userLastName" name="lastName" required>
</div>
<div class="mb-3">
  <label for="userEmail" class="form-label">Email</label>
  <input type="email" class="form-control" id="userEmail" name="email" required>
</div>
<div class="mb-3">
  <label for="userPassword" class="form-label">Password</label>
  <input type="password" class="form-control" id="userPassword" name="password" required>
</div>
<div class="mb-3">
  <label for="userPhone" class="form-label">Phone Number</label>
  <input type="text" class="form-control" id="userPhone" name="phone" required>
</div>
<div class="mb-3">
  <label for="userGender" class="form-label">Gender</label>
  <select class="form-select" id="userGender" name="gender" required>
    <option value="">Select Gender...</option>
    <option value="M">Male</option>
    <option value="F">Female</option>
    <option value="O">Other</option>
  </select>
</div>
<div class="mb-3">
  <label for="userAddress" class="form-label">Address</label>
  <input type="text" class="form-control" id="userAddress" name="address" required>
</div>
<div class="mb-3">
  <label for="userCity" class="form-label">City</label>
  <input type="text" class="form-control" id="userCity" name="city" required>
</div>
<div class="mb-3">
  <label for="userCountry" class="form-label">Country</label>
  <input type="text" class="form-control" id="userCountry" name="country" required>
</div>

      `;
        } else if (activeTab === "Agriculteur") {
          console.log("Setting up form for Agriculteur");
          form.innerHTML = `
        <!-- Agriculteur-specific fields -->
          <input type="hidden" class="form-control" id="role_id" name="role_id" value="1">
        
        <div class="mb-3">
          <label for="farmProfilePic" class="form-label">Farm Profile Picture</label>
          <input type="file" class="form-control" id="farmProfilePic" name="farmProfilePic">
        </div>
<div class="mb-3">
  <label for="farmName" class="form-label">Farm Name</label>
  <input type="text" class="form-control" id="farmName" name="farmName" required>
</div>
<div class="mb-3">
  <label for="farmOwner" class="form-label">Farm Owner</label>
  <input type="text" class="form-control" id="farmOwner" name="farmOwner" required>
</div>
<div class="mb-3">
  <label for="farmDescription" class="form-label">Farm Description</label>
  <textarea class="form-control" id="farmDescription" name="farmDescription"></textarea>
</div>
<div class="mb-3">
  <label for="userEmail" class="form-label">Email</label>
  <input type="email" class="form-control" id="userEmail" name="email" required>
</div>
<div class="mb-3">
  <label for="userPassword" class="form-label">Password</label>
  <input type="password" class="form-control" id="userPassword" name="password" required>
</div>

      `;
        } else {
          console.log("No valid tab selected");
        }
      });

      // Optional: Submit form handler
      /*document.getElementById("addUserForm")
        .addEventListener("submit", function (event) {
          event.preventDefault();
          // Add logic to process form data
          console.log("Form submitted");
        });*/
    });
  </script>
  <!-- USER EDIT SCRIPT FORM-->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const userTabContent = document.getElementById('userTabContent');

      // Event delegation for edit buttons
      userTabContent.addEventListener('click', function (event) {
        let target = event.target;

        // Traverse up to find the closest button if the clicked element isn't the button itself
        while (target != this && !target.matches('.edit-button')) {
          target = target.parentNode;
        }

        if (target.matches('.edit-button')) {
          console.log("Edit button clicked: ", target);
          const userId = target.getAttribute('data-user-id');
          const userType = target.getAttribute('data-user-type') == 1 ? "Agriculteur" : "Consommateur";
          console.log("User ID: ", userId, "User Type: ", userType);
          populateEditForm(userId, userType); // Call your function to populate and show the modal form
        }
      });

      function populateEditForm(userId, userType) {
        console.log("inside populate edit form / user_id:", userId);
        fetch(`get_user_details.php?user_id=${userId}`)  // Assuming get_user_details.php returns user details in JSON format
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
          })
          .then(user => {
            const form = document.getElementById('editUserForm');
            console.log("form", form);
            form.innerHTML = '';
            console.log("got response");
            if (userType === 'Agriculteur') {
              console.log("inside agri");
              form.innerHTML = `
                    <input type="hidden" name="user_id" value="${user.user_id}">
<input type="hidden" name="role_id" value="1">
<div class="mb-3">
    <label for="farmName" class="form-label">Farm Name</label>
    <input type="text" class="form-control" id="farmName" name="farmName" required value="${user.farm_name}">
</div>
<div class="mb-3">
    <label for="farmOwner" class="form-label">Farm Owner</label>
    <input type="text" class="form-control" id="farmOwner" name="farmOwner" required value="${user.farm_owner_name}">
</div>
<div class="mb-3">
    <label for="farmDescription" class="form-label">Farm Description</label>
    <textarea class="form-control" id="farmDescription" name="farmDescription">${user.farm_description || ''}</textarea>
</div>
<div class="mb-3">
    <label for="userEmail" class="form-label">Email</label>
    <input type="email" class="form-control" id="userEmail" name="email" required value="${user.email}">
</div>
<div class="mb-3">
    <label for="userPassword" class="form-label">Password (leave blank to keep current)</label>
    <input type="password" class="form-control" id="userPassword" name="password">
</div>
<div class="mb-3">
    <label for="phoneNumber" class="form-label">Phone Number</label>
    <input type="text" class="form-control" id="phoneNumber" name="phone_number" required value="${user.phone_number}">
</div>
<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address" required value="${user.address}">
</div>
<div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" name="city" required value="${user.city}">
</div>
<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <input type="text" class="form-control" id="country" name="country" required value="${user.country}">
</div>

                `;
            } else { // Consommateur
              console.log("inside cons");
              form.innerHTML = `
                    <input type="hidden" name="user_id" value="${user.user_id}">
<input type="hidden" name="role_id" value="2">
<div class="mb-3">
    <label for="userFirstName" class="form-label">First Name</label>
    <input type="text" class="form-control" id="userFirstName" name="firstName" required value="${user.nom_consomateur}">
</div>
<div class="mb-3">
    <label for="userLastName" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="userLastName" name="lastName" required value="${user.prenom_consomateur}">
</div>
<div class="mb-3">
    <label for="userGender" class="form-label">Gender</label>
    <select class="form-select" id="userGender" name="gender" required>
        <option value="M" ${user.genre === 'M' ? 'selected' : ''}>Male</option>
        <option value="F" ${user.genre === 'F' ? 'selected' : ''}>Female</option>
        <option value="O" ${user.genre === 'O' ? 'selected' : ''}>Other</option>
    </select>
</div>
<div class="mb-3">
    <label for="userEmail" class="form-label">Email</label>
    <input type="email" class="form-control" id="userEmail" name="email" required value="${user.email}">
</div>
<div class="mb-3">
    <label for="userPassword" class="form-label">Password (leave blank to keep current)</label>
    <input type="password" class="form-control" id="userPassword" name="password">
</div>
<div class="mb-3">
    <label for="phoneNumber" class="form-label">Phone Number</label>
    <input type="text" class="form-control" id="phoneNumber" name="phone_number" required value="${user.phone_number}">
</div>
<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address" required value="${user.address}">
</div>
<div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" name="city" required value="${user.city}">
</div>
<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <input type="text" class="form-control" id="country" name="country" required value="${user.country}">
</div>

                `;
            }

            // Display the modal now that it's populated
            var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editUserModal.show();
          })
          .catch(error => console.error('Error loading user details:', error));
      }
    });

  </script>
  <!--USER SEARCH SCRIPT-->
  <script>
    function performSearch() {
      const query = document.getElementById('user_search').value.trim();
      let [searchType, searchTerm] = query.split(":");

      if (searchType !== 'email' && searchType !== 'phone') {
        displayAlert("Please enter a valid search query in the format 'email:example@mail.com' or 'phone:1234567890'", 'danger');
        return;
      }

      searchTerm = searchTerm.trim();
      fetch(`../../search_users.php?type=${searchType}&term=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            console.log(data.error);
            displayAlert(data.error, 'danger'); // Display error as an alert
          } else {
            updateTables(data);
            if (data.length > 0) {
              let userType = data[0].role_id == 1 ? "Agriculteur" : "Consommateur";
              console.log("user type: ", userType);
              setActiveTab(userType);
            }
          }
        })
        .catch(error => {
          console.error('Error fetching data:', error);
          displayAlert('Failed to fetch user data.', 'danger');
        });
    }
    function updateTables(users) {
      const consommateurTable = document.querySelector("#consommateur .table tbody");
      const agriculteurTable = document.querySelector("#agriculteur .table tbody");

      // Clear existing entries
      consommateurTable.innerHTML = '';
      agriculteurTable.innerHTML = '';

      if (users.length === 0) {
        displayAlert('No users found matching the search criteria.', 'warning');
        return;
      }

      users.forEach(user => {
        let userRow;
        console.log("user fetched: ", user);
        if (user.role_id === 1) { // Agriculteur
          userRow = `
                <tr>
                    <td><img src="${user.profile_pic}" class="avatar avatar-sm me-3" alt="user">${user.farm_name}</td>
                    <td>${user.farm_owner_name}</td>
                    <td>${user.email}</td>
                    <td>
                            <form class="btn btn-success btn-sm">
                              <input type="hidden" name="user_id" value="${user.user_id}">
                              <button type="button" class="btn btn-success btn-sm edit-button" style="margin-bottom:0px;"
                                data-user-id="${user.user_id}"
                                data-user-type="${user.role_id}">Edit</button>
                            </form>

                            <?php if ($user['ban_until'] && new DateTime($user['ban_until']) > new DateTime()): ?>
                              <form method="post" action="../../unban_user.php" class="btn btn-success btn-sm"
                                style="display: inline;">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <button type="submit" name="unban" class="btn btn-success btn-sm">Unban</button>
                              </form>
                            <?php else: ?>
                              <form class="btn btn-warning btn-sm">

                                <button type="button" onclick="showBanModal(<?= $user['user_id'] ?>)" class="btn btn-warning btn-sm"
                                  style="margin:0px;">Ban</button>
                              </form>
                            <?php endif; ?>

                            <form method="POST" action="../../delete_user.php" class="btn btn-danger btn-sm"
                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                              <input type="hidden" name="user_id" value="${user.user_id}">
                              <button type="submit" class="btn btn-danger btn-sm"
                                style="margin-bottom:0px;">Delete</button>
                            </form>

                          </td>
                </tr>
            `;
          agriculteurTable.insertAdjacentHTML('beforeend', userRow);
        } else if (user.role_id === 2) { // Consommateur
          userRow = `
                <tr>
                    <td><img src="${user.profile_pic}" class="avatar avatar-sm me-3" alt="user">${user.nom_consomateur} ${user.prenom_consomateur}</td>
                    <td>${user.email}</td>
                    <td>${user.phone_number} (${user.country})</td>
                    <td>
                            <form class="btn btn-success btn-sm">
                              <input type="hidden" name="user_id" value="${user.user_id}">
                              <button type="button" class="btn btn-success btn-sm edit-button" style="margin-bottom:0px;"
                                data-user-id="${user.user_id}"
                                data-user-type="${user.role_id}">Edit</button>
                            </form>

                            <?php if ($user['ban_until'] && new DateTime($user['ban_until']) > new DateTime()): ?>
                              <form method="post" action="../../unban_user.php" class="btn btn-success btn-sm"
                                style="display: inline;">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <button type="submit" name="unban" class="btn btn-success btn-sm">Unban</button>
                              </form>
                            <?php else: ?>
                              <form class="btn btn-warning btn-sm">

                                <button type="button" onclick="showBanModal(<?= $user['user_id'] ?>)" class="btn btn-warning btn-sm"
                                  style="margin:0px;">Ban</button>
                              </form>
                            <?php endif; ?>

                            <form method="POST" action="../../delete_user.php" class="btn btn-danger btn-sm"
                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                              <input type="hidden" name="user_id" value="${user.user_id}">
                              <button type="submit" class="btn btn-danger btn-sm"
                                style="margin-bottom:0px;">Delete</button>
                            </form>

                          </td>
                </tr>
            `;
          consommateurTable.insertAdjacentHTML('beforeend', userRow);
        }
      });
    }

    function displayAlert(message, type) {
      const alertBox = document.createElement('div');
      alertBox.classList.add('alert', `alert-${type}`);
      alertBox.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="display: flex; align-items-end; float:right;">
            <span aria-hidden="true">&times;</span>
        </button>
    `;



      const container = document.querySelector('.card-body');
      container.prepend(alertBox);

      alertBox.querySelector('.close').addEventListener('click', function () {
        alertBox.remove();
      });


    }

    function setActiveTab(userType) {
      const consommateurTab = document.getElementById('consommateur-tab');
      const agriculteurTab = document.getElementById('agriculteur-tab');
      const consommateurPane = document.getElementById('consommateur');
      const agriculteurPane = document.getElementById('agriculteur');

      // Reset all tabs to inactive
      consommateurTab.classList.remove('active');
      agriculteurTab.classList.remove('active');
      consommateurPane.classList.remove('show', 'active');
      agriculteurPane.classList.remove('show', 'active');

      // Set the appropriate tab and pane active
      if (userType === 'Consommateur') {
        consommateurTab.classList.add('active');
        consommateurPane.classList.add('show', 'active');
      } else if (userType === 'Agriculteur') {
        agriculteurTab.classList.add('active');
        agriculteurPane.classList.add('show', 'active');
      }
    }



  </script>
<style>
  .alert {
    position: fixed;
    top: 20px; /* Distance from top */
    right: 20px; /* Distance from right */
    border: 1px solid transparent;
    border-radius: 4px;
    padding: 10px;
    z-index: 1050; /* Make sure it's above other content */
    box-shadow: 0 4px 6px rgba(0,0,0,.1); /* Slight shadow for 3D effect */
    animation: slideInFromRight 0.5s ease-in-out;
    width: auto; /* Auto width based on content */
    max-width: 300px; /* Maximum width */
    display: inline-block;
    color: #fff; /* White text color */
}

/* Animation for alert sliding in */
@keyframes slideInFromRight {
    0% {
        right: -50%; /* Start from outside the right */
    }
    100% {
        right: 20px; /* Settle in its place */
    }
}

.alert-success {
    background-color: #28a745; /* Green for success */
}

.alert-danger {
    background-color: #dc3545; /* Red for danger/error */
}

.alert-info {
    background-color: #17a2b8; /* Blue for information */
}

.alert-warning {
    background-color: #ffc107; /* Yellow for warning */
}

/* Close button styling */
.alert .close {
    cursor: pointer;
    background-color: transparent;
    border: 0;
    color: #fff; /* White color for close button */
    opacity: 0.8;
    font-size: 20px; /* Larger close button */
}

.alert .close:hover {
    opacity: 1; /* Fully opaque on hover */
}
</style>
  <script>
    function showBanModal(userId) {
    console.log("Function called for user ID:", userId);  // Check if this logs correctly when you click the ban button
    const formHtml = `
        <form id="banForm" action="../../ban_user.php" method="post">
            <input type="hidden" name="user_id" value="${userId}">
            <div class="mb-3">
                <label for="ban_until" class="form-label">Ban Until:</label>
                <input type="date" id="ban_until"  class="form-control" name="ban_until" id="ban_until" min="<?php $date = new DateTime(); echo $date->format('Y-m-d'); ?>" required>
            </div>
        </form>
    `;
    document.querySelector('#banUserModal .modal-body').innerHTML = formHtml;
    var banModal = new bootstrap.Modal(document.getElementById('banUserModal'));
    banModal.show();
}


  </script>
  <script>
document.addEventListener("DOMContentLoaded", function() {
    function displayAlert(message, type) {
        const alertBox = document.createElement('div');
        alertBox.classList.add('alert', `alert-${type}`);
        alertBox.innerHTML = `
            ${message}
            <button type="button" class="close" onclick="this.parentElement.style.display='none';" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        `;

        document.body.appendChild(alertBox); // Append to the body or to a specific div if required
    }

    // Function to fetch query parameters from the URL
    function getQueryParams() {
        var params = {};
        var parser = document.createElement('a');
        parser.href = window.location.href;
        var query = parser.search.substring(1);
        var vars = query.split('&');
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split('=');
            params[pair[0]] = decodeURIComponent(pair[1]);
        }
        return params;
    }

    // Get message from URL parameters and display it
    var params = getQueryParams();
    if (params.message) {
        displayAlert(params.message, params.status || 'info'); // Default type is 'info'
    }
});
</script>


</body>

</html>