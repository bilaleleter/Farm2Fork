var roleSelect = document.getElementById("role-select");
var locateMeButton = document.getElementById("locate-me-button_agri");
var countrySelect = document.getElementById("country_agri");
var cityField = document.getElementById("city_agri");
var addressField = document.getElementById("address_agri");

function updateFieldsByRole() {
  if (roleSelect.value == 1) {
    locateMeButton = document.getElementById("locate-me-button_agri");
    countrySelect = document.getElementById("country_agri");
    cityField = document.getElementById("city_agri");
    addressField = document.getElementById("address_agri");
  } else if (roleSelect.value == 2) {
    locateMeButton = document.getElementById("locate-me-button_cons");
    countrySelect = document.getElementById("country_cons");
    cityField = document.getElementById("city_cons");
    addressField = document.getElementById("address_cons");
  }

  locateMeButton.removeEventListener("click", handleLocateMeClick);
  locateMeButton.addEventListener("click", handleLocateMeClick);
}

function handleLocateMeClick() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(getLocationDetails, showError);
  } else {
    alert("La géolocalisation n'est pas supportée par votre navigateur.");
  }
}

// Function to get location details and update the fields
function getLocationDetails(position) {
  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;

  const apiKey = "69417a999d3f49c8b3217b6ae258a57a";
  const url = `https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=${apiKey}`;

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      if (data && data.results && data.results.length > 0) {
        const locationData = data.results[0].components;

        const countryCode = locationData["country_code"].toUpperCase();
        const countryOption = Array.from(countrySelect.options).find(
          (option) => option.value === countryCode
        );
        if (countryOption) {
          countrySelect.value = countryCode;
        }

        const city =
          locationData.city || locationData.state || locationData.village;
        if (city) {
          cityField.value = city;
        }

        const road = locationData.road || "";
        const county = locationData.county || "";
        const postcode = locationData.postcode || "";
        const fullAddress = data.results[0].formatted;
        if (fullAddress !== ",") {
          addressField.value = fullAddress;
        }
      }
    })
    .catch((error) => {
      console.error("Error fetching location data:", error);
      alert("Impossible d'obtenir les détails de localisation.");
    });
}

function showError(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      alert("Permission de localisation refusée.");
      break;
    case error.POSITION_UNAVAILABLE:
      alert("Les informations de localisation ne sont pas disponibles.");
      break;
    case error.TIMEOUT:
      alert("La requête de localisation a expiré.");
      break;
    case error.UNKNOWN_ERROR:
      alert("Une erreur inconnue s'est produite.");
      break;
  }
}

roleSelect.addEventListener("change", updateFieldsByRole);
updateFieldsByRole();
