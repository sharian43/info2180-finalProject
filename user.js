function showUsersTable() {
    // Assume userRole is a variable containing the user's role (retrieved from the server)
    var userRole = "admin"; // Change this according to the user's actual role

    // Check if the user is an admin
    if (userRole === "admin") {
        document.getElementById("userTable").style.display = "block";
        // You would fetch and populate user data from the server here
        // For demonstration purposes, let's add a sample row
        var userData = {
            name: "John Doe",
            email: "john@example.com",
            role: "Admin",
            dateCreated: "2023-01-01"
        };
        populateUserTable(userData);
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