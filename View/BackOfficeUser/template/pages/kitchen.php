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

require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Controller\UserController.php';
$userController = new UserController();
$user = $userController->getUserByEmail($_SESSION['email']);
if ($user == null) {
  echo "error getting user info";
  exit();
}

$user_name = $user["nom_consomateur"].' '.$user['prenom_consomateur'];
?>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Kitchen
  </title>
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .chatbox {
      height: 400px;
      overflow-y: scroll;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #f9f9f9;
      padding: 10px;
    }

    .message-input {
      width: 100%;
      padding: 10px;
      border-radius: 10px;
      border: 1px solid #ddd;
      margin-top: 20px;
    }

    .send-btn {
      background-color: #43A047;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
    }

    .user-msg {
      background-color: #43A047;
      color: white;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 8px;
      text-align: right;
    }

    .chef-msg {
      background-color: #f5f5f5;
      color: #333;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 8px;
    }
  </style>

</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
        target="_blank">
        <img src="../../../FrontOffice/assets/img/farm2fork v1.png" class="navbar-brand-img" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Farm2Fork</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
       <li class="nav-item">
          <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\FrontOfficeBilel\index.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Marketplace</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeNadine\pages\tables.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Recettes</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="kitchen.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Kitchen</span>
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
        <a class="btn btn-outline-dark mt-4 w-100" href="consomateur_profile.php" type="button">Profil</a>
        <button type="submit" class="btn bg-gradient-dark w-100" form="SignOutForm" name="logout">Se deconnecter</button>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"></a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Cuisine</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Search Logs</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav d-flex align-items-center  justify-content-end">
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
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
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
                          class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
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
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
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
    <div class="container mt-5">
      <h3>Welcome to Your Kitchen Chat</h3>
      <div class="chatbox" id="chatbox">
        <!-- Messages will be appended here dynamically -->
      </div>

      <!-- Input Field for User -->
      <div class="input-group mt-3">
        <input type="text" id="user-input" placeholder="Type a message..."
          autofocus>
        <button id="send-btn" class="btn btn-primary">Send</button>
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
  <input type="hidden" value="<?php echo $user_name?>" id="userName">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      var userName =document.getElementById("userName").value;
        let conversationStep = 1;
        let conversationHistory = []; // Store the conversation history
        let ingredients = []; // Array to hold ingredients
        let missingIngredients = []; // Array to hold missing ingredients
        let userAllergies = ''; // String to hold user allergies
        let userGoals = ''; // String to hold user goals
        const chefName = 'Chef Lablebi'; // Chef's name

        // Start the conversation
        startChat();

        // When the user sends a message
        $('#send-btn').on('click', function () {
            const userInput = $('#user-input').val();

            // Prevent double-click and ensure user input is not empty
            if (!userInput.trim() || $(this).prop('disabled')) return;

            $(this).prop('disabled', true); // Disable the button to prevent multiple clicks

            // Append user's message
            appendMessage("You", userInput);
            $('#user-input').val(''); // Clear input field

            // Add user's message to conversation history
            conversationHistory.push({ sender: "You", message: userInput });

            // Send the conversation history to the backend for context
            $.ajax({
                url: 'kitchen_backend_with_history.php',
                method: 'POST',
                data: {
                    user_input: userInput,
                    step: conversationStep,
                    conversation_history: conversationHistory,
                    ingredients: ingredients,
                    missing_ingredients: missingIngredients,
                    user_allergies: userAllergies,
                    user_goals: userGoals
                },
                success: function (response) {
                    const data = JSON.parse(response);
                    const chefMessage = formatChefMessage(data.chefMessage);  // Format Chef's response
                    conversationStep = data.nextStep;

                    // Add Chef's response to conversation history
                    conversationHistory.push({ sender: chefName, message: chefMessage });

                    // Update the chat with Chef's message
                    appendMessage(chefName, chefMessage);

                    // Re-enable the send button after response
                    $('#send-btn').prop('disabled', false);
                }
            });
        });

        // Append messages to the chat box
        function appendMessage(sender, message) {
            // Check if the sender is the user or chef
            const messageClass = sender === "You" ? "user-msg" : "chef-msg";

            // Format the message to improve design
            const messageHTML = `
                <div class="${messageClass}">
                    <strong>${sender}:</strong> <span>${message}</span>
                </div>
            `;

            // Add the message to the chatbox
            $('#chatbox').append(messageHTML);
            $('#chatbox').scrollTop($('#chatbox')[0].scrollHeight); // Auto scroll to bottom
        }

        // Initialize chat with a greeting from Chef Gemini
        function startChat() {
          console.log("user name ", userName);
            appendMessage(chefName, 'Hello '+userName+', I am your personal chef. Which language would you prefer me to speak in?');
        }

        // Custom function to format chef's message for better readability (like ingredients, steps)
        function formatChefMessage(message) {
            // Format ingredients in a cleaner list
            message = message.replace(/\*\*Ingredients\*\*/g, "<strong class='chef-highlight'>Ingredients:</strong>");
            message = message.replace(/\*\*Nutrition Facts\*\*/g, "<strong class='chef-highlight'>Approximate Nutrition Facts:</strong>");
            message = message.replace(/\*\*/g, "");  // Remove other unnecessary asterisks

            // Convert ingredients to a clean list format
            message = message.replace(/Ingredients:\s*(.*?)\s*Nutrition/g, function(match, p1) {
                return "Ingredients:<ul>" + p1.trim().split('\n').map(item => `<li>${item.trim()}</li>`).join('') + "</ul>Nutrition";
            });

            // Format nutrition facts into a cleaner list
            message = message.replace(/Nutrition Facts:([\s\S]*?)Are you missing any/g, function(match, p1) {
                return "Nutrition Facts:<ul>" + p1.trim().split('\n').map(item => `<li>${item.trim()}</li>`).join('') + "</ul>";
            });

            // Return the cleaned message
            return message;
        }

        // Function to handle response from Gemini API
        function getChefResponse(conversationHistory) {
            let prompt = '';
            conversationHistory.forEach(item => {
                prompt += `${item.sender}: ${item.message}\n`;
            });

            const data = {
                model: "gemini-1.5-flash",
                contents: [{ parts: [{ text: prompt }] }]
            };

            return fetch('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=YOUR_API_KEY', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => data.contents[0].parts[0].text);
        }
    });
</script>

<style>
 /* User Message Styles (Right aligned) */
.user-msg {
    background-color: green; /* Blue for user messages */
    color: white;
    padding: 12px 20px;
    margin: 8px 0;
    border-radius: 25px;
    max-width: 75%;
    align-self: flex-end;
    display: inline-block;
    clear: both;
    font-size: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.user-msg:hover {
    background-color: darkgreen; /* Darker blue on hover */
    transform: scale(1.05); /* Slight zoom effect */
}

/* Chef Message Styles (Left aligned) */
.chef-msg {
    background-color: #e9ecef; /* Light gray for chef messages */
    color: #343a40; /* Dark gray text */
    padding: 12px 20px;
    margin: 8px 0;
    border-radius: 25px;
    max-width: 75%;
    align-self: flex-start;
    display: inline-block;
    clear: both;
    font-size: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
    transition: background-color 0.3s ease, transform 0.2s ease, color 0.3s ease;

}

.chef-msg:hover {
    background-color: grey; /* Darker blue on hover */
    transform: scale(1.05); /* Slight zoom effect */
    color: white;
}
/* Chef Highlight (Ingredients, Steps, Recipe) */
.chef-highlight {
    font-weight: bold;
    color: #e74c3c;  /* Red for Ingredients */
    font-size: 1.1em;
    padding: 8px 12px;
    background-color: #f9e2e0; /* Soft red background */
    border-radius: 5px;
    margin: 8px 0;
    display: inline-block;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

/* Ingredients List */
ul {
    list-style-type: none;
    padding-left: 0;
}

ul li {
    padding: 12px 16px;
    background-color: #ffffff; /* White background for clarity */
    color: #333;
    border-radius: 10px;
    margin: 8px 0;
    font-size: 1.1em;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    transition: background-color 0.3s ease, transform 0.2s ease;
}

ul li:hover {
    background-color: #f0f0f0; /* Light gray on hover */
    transform: scale(1.02); /* Slight zoom effect */
}

/* Step List */
ol {
    padding-left: 20px;
}

ol li {
    padding: 12px 16px;
    border-radius: 10px;
    margin: 8px 0;
    font-size: 1.1em;
    background-color: #f8f9fa; /* Very light gray background */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    transition: background-color 0.3s ease, transform 0.2s ease;
}

ol li:hover {
    background-color: #e9ecef; /* Light gray hover effect */
    transform: scale(1.02); /* Slight zoom effect */
    color: black;
}

/* Highlight Recipe and Step titles */
strong.chef-highlight {
    color: #32cd32;  /* Lime green for Step/Recipe */
    font-size: 1.3em;
    font-weight: 600;
    margin-top: 10px;
    display: inline-block;
}

#chatbox {
    padding: 20px;
    background-color: #ffffff; 
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); 
    margin-top: 20px;
    max-height: 500px;
    overflow-y: auto; 
}

/* User Input Field */
#user-input {
    padding: 14px 20px;
    margin-right: 15px;
    font-size: 16px;
    width: calc(90%);
    border: 1px solid #ddd;
    border-radius: 25px;
    margin-bottom: 15px;
    transition: border-color 0.3s;
}

#user-input:focus {
    border-color: #28a745;  /* Green border on focus */
    outline: none;
}

/* Floating Send Button */
#send-btn {
    background-color: olive;
    color: white;
    padding: 14px 20px;
    border-radius: 30px;
    font-size: 1.2em;
    border: none;
    transition: background-color 0.3s ease, transform 0.2s ease;
    cursor: pointer;
}

#send-btn:hover {
    background-color: darkgreen;  /* Darker green when hovered */
    transform: scale(1.05);  /* Slight zoom effect */
}

#send-btn:disabled {
    background-color: #d6d6d6;  /* Gray when disabled */
    cursor: not-allowed;
}


</style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>