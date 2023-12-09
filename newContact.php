<?php
session_start();

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
  $title=$_POST["title"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $telephone=$_POST["telephone"];
  $company=$_POST["company"];
  $type=$_POST["type"];
  $assignTo=$_POST["usersAssigned"];

  // Insert user into the database
  $sql = "INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to,created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssss", $title,$firstname, $lastname, $email, $telephone, $company,$type,$assignTo);
  
  


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

  // Redirect back to newContact.php
  header("Location: newContact.php");
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
            <h2>New Contact</h2>

            <section>
                <form method="post" action="#" >
                <label for="title">Title</label>
                <br>
                <select id="title" name="title">
                    <option value="mr">Mr</option>
                    <option value="ms">Ms</option>
                    <option value="mrs">Mrs</option>
                </select>
                <br>

                <label for="firstname">First Name</label>        
                <label for="lastname">Last Name</label>

                <input id="firstname" type="firstname" name="firstname" placeholder="John" required/>
                <input id="lastname" type="lastname" name="lastname" placeholder="Doe" required/>

                <label for="email">Email</label>
                <label for="telephone">Telephone</label>

                <input id="email" type="email" name="email" placeholder="example@gmail.com" required/>
                <input id="telephone" type="telephone" name="telephone" required>

                <label for="company">Company</label>
                <label for="type">Type</label>

                <input id="company" type="company" name="company" required>
                <select id="type" name="type" required>
                    <option value="salesLead">Sales Lead</option>
                    <option value="support">Support</option>
                </select>

                <label for="assigned">Assigned To</label>
                <br>
                <select id="usersAssigned" name="usersAssigned" required>
                    
                    <option value="user">user1</option>
                    <!-- ADD USERS FROM DATABSE -->
                  

                    
                    
                </select>

                <div class="btn">
                    <button>Save</button></div> </form>

            </section>

        </div>

        <aside>
            <a href="dashboard.php"><i class="fa-solid fa-house"></i>Home</a>
            <br />
            <a href="newContact.php"><i class="fa-solid fa-user"></i>New Contact</a>
            <br />
            <a href="User.html" onclick="showUsersTable()"><i class="fa-solid fa-users"></i></i>Users</a>
            <br />
            <br />
            <a href="login.php?logout=true"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
        </aside>
    </body>
</html>
