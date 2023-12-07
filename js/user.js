function showUsersTable() {
    // Assume userRole is a variable containing the user's role (retrieved from the server)
    var userRole = "admin"; 

  // Check if the user is an admin
  if (userRole === "admin") {
      document.getElementById("userTable").style.display = "block";

      // AJAX request to fetch user data from the server
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "url_to_your_server_endpoint", true);

      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Parse the JSON response from the server
                var userData = JSON.parse(xhr.responseText);
                populateUserTable(userData);
            } else {
                // Handle errors or no data received from the server
                console.error("Error fetching user data");
            }
        }
    };
      // Send the request
      xhr.send();
  } else {
      alert("You do not have permission to view this page.");
  }
}

function populateUserTable(userData) {
    var tableBody = document.querySelector("#userTable tbody");
    tableBody.innerHTML = ""; // Clear existing rows

    var row = tableBody.insertRow();
    var nameCell = row.insertCell(0);
    var emailCell = row.insertCell(1);
    var roleCell = row.insertCell(2);
    var dateCreatedCell = row.insertCell(3);

    nameCell.textContent = userData.name;
    emailCell.textContent = userData.email;
    roleCell.textContent = userData.role;
    dateCreatedCell.textContent = userData.dateCreated;
}

function addUser() {
    // Redirect to the newContact.html page
    window.location.href = "newContact.html";
}
