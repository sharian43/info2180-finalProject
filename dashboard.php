<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Replace these variables with your actual database credentials
$host = 'localhost';
$username = "new_user";
$password = 'password123';
$dbname = "dolphin_crm";

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data for the dashboard
$user_id = $_SESSION["user_id"];
$sql = "SELECT title, name, email, company, type FROM contacts WHERE assigned_to = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin CRM</title>
    <link rel="stylesheet" href="dash.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="dash.js"></script>
</head>
<body>
    <header>
        <img src="dolphin.png" id="header-pic" />
        <h3>Dolphin CRM</h3>
    </header>
    <div class="container">
      <h2>Dashboard</h2>
      <button id="addContactButton" onclick="addcontact()"><i class="fas fa-plus"></i> Add Contact</button>

      <!-- Filter buttons -->
      <div id="filterButtons">
        <h3><i class="fa-solid fa-filter"></i>Fliter By: </h3>
          <button onclick="showContacts('full')">Full</button>
          <button onclick="showContacts('sales lead')">Sales Lead</button>
          <button onclick="showContacts('support')">Support</button>
          <button onclick="showContacts('assigned to me')">Assigned to Me</button>
      </div>
      
      <table id="userTable">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Company</th>
                  <th>Type</th>
              </tr>
          </thead>
          <tbody>
            <?php
              // Display user data in the table
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["title"] . ". " . $row["name"] . "</td>";
                  echo "<td>" . $row["email"] . "</td>";
                  echo "<td>" . $row["company"] . "</td>";
                  echo "<td>" . $row["type"] . "</td>";
                  echo "</tr>";
              }
            ?>
          </tbody>
      </table>
    </div>
    <aside>
      <a href="dashboard.php"><i class="fa-solid fa-house"></i>Home</a>
      <br />
      <a href="newContact.html"><i class="fa-solid fa-user"></i>New Contact</a>
      <br />
      <a href=""onclick="showUsersTable()"><i class="fa-solid fa-users"></i></i>Users</a>
      <br />
      <br />
      <hr>
      <a href="login.php?logout=true"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>

    </aside>
</body>
</html>

<?php
$stmt->close();
?>
