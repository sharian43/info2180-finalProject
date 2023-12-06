function addcontact() {
  // Redirect to the newContact.html page
  window.location.href = "newContact.html";
  console.log("Add Contact button clicked!");
  return false;
}

// Sample user data
var userData = [
  { title:"Mr", name: "John Doe", email: "john@example.com", company: "ABC Inc.", type: "Sales Lead" },
  { title:"Mr", name: "Jane Smith", email: "jane@example.com", company: "XYZ Corp", type: "Support" }
];

// Function to filter and display contacts
function showContacts(filter) {
  var tableBody = document.querySelector("#userTable tbody");
  tableBody.innerHTML = ""; // Clear existing rows

  userData.forEach(function (user) {
    // Apply filters
    if (filter === "full" || user.type.toLowerCase() === filter.toLowerCase()) {
      var row = tableBody.insertRow();
      var nameCell = row.insertCell(0);
      var emailCell = row.insertCell(1);
      var companyCell = row.insertCell(2);
      var typeCell = row.insertCell(3);
      var viewCell = row.insertCell(4);

      nameCell.textContent = user.title + '.' + user.name;
      emailCell.textContent = user.email;
      companyCell.textContent = user.company;
      typeCell.textContent = user.type;
      typeCell.setAttribute("type", user.type);
      
      // Add a "View" button
      var viewButton = document.createElement("button");
      viewButton.textContent = "View";
      viewButton.className = "view-button";
      viewButton.onclick = function () {
          // Redirect to the full contact page
          window.location.href = "fullContact.html?userId=" + user.id;
      };
  
          viewCell.appendChild(viewButton);
      }
  });
}

// Function to handle filter selection
function handleFilterChange() {
    var filterSelect = document.getElementById("filterSelect");
    var selectedFilter = filterSelect.value;

    showContacts(selectedFilter);
}

// Function to initialize the page
function initPage() {
    // Populate filter options
    var filterSelect = document.getElementById("filterSelect");
    var filterOptions = ["Full", "Sales Lead", "Support", "Assigned to Me"];

    filterOptions.forEach(function (option) {
        var filterOption = document.createElement("option");
        filterOption.value = option.toLowerCase();
        filterOption.textContent = option;
        filterSelect.appendChild(filterOption);
    });

    // Initial display with "Full" filter
    showContacts("full");
}

// Call the initPage function when the page loads
window.onload = initPage;
