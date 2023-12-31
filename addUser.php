<?php
session_start();
// if (!isset($_SESSION["user_id"])) {
//   header("Location: login.php");

//   exit();
// }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Replace these variables with your actual database credentials
  $host = 'localhost';
  $username = "Admin";
  $password = 'password123';
  $dbname = "dolphin_crm";

  // Create connection
  $conn = mysqli_connect($host, $username, $password, $dbname);

  // Check connection and handle errors
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Collect form data
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
  $role = $_POST["role"];

  // Insert user into the database
  $sql = "INSERT INTO users (firstname, lastname, email, password, role, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $firstname, $lastname, $email, $password, $role);

  if ($stmt->execute()) {
      // User added successfully
      $_SESSION["success_message"] = "User added successfully!";
  } else {
      // Error occurred
      $_SESSION["error_message"] = "Error adding user: " . $stmt->error;
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();

  // Redirect back to addUser.php
  header("Location: addUser.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="addUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Dolphin CRM</title>
  </head>

  <body>
    <header>
      <img src="dolphin.png" id="header-pic" />
      <h3>Dolphin CRM</h3>
    </header>
    <div class="container">
        <h2>New User</h2>

    <section> 
        <form method="post" action="#" >

        <label for="firstname">First Name</label>        
        <label for="lastname">Last Name</label>

        <input id="firstname" type="firstname" name="firstname" placeholder="John" required/>
        <input id="lastname" type="lastname" name="lastname" placeholder="Doe" required/>

        <label for="email">Email</label>
        <label for="password">Password</label>

        <input id="email" type="email" name="email" placeholder="example@gmail.com" required/>
        <input id="password" type="password" name="password" required/>

        <label for="role">Role</label>
        <br/>

       <select id="role" name="role" required>
         <option value="Admin">Admin</option>
         <option value="Member">Member</option>
       </select>
       <br/>
    <div class="btn">
    <button>Save</button></div> </form>
</section>
</div>
     
  <aside>
    
    <a href="dashboard.php"><i class="fa-solid fa-house"></i>Home</a>
    <br />
    <a href="newContact.php"><i class="fa-solid fa-user"></i>New Contact</a>
    <br />
    <a href="User.html"onclick="showUsersTable()"><i class="fa-solid fa-users"></i></i>Users</a>
    <br />
    <br />
    
    <a href="login.php?logout=true"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>

  </aside>
</body>
</html>
