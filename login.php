<?php
session_start();

// Replace these variables with your actual database credentials
$host = 'localhost';
$username = "Admin";
$password = 'password123';
$dbname = "dolphin_crm";

// Create connection
$conn = mysqli_connect($host , $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to securely hash passwords
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate user input
    if (empty($email) || empty($password)) {
        echo "Please enter both email and password.";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();
            
            //echo "email $email";

            // Verify password
            if (password_verify($password, $hashed_password))  {
                // Password is correct, start a session
                $_SESSION["user_id"] = $user_id;
                if ($email=="admin@project2.com"){ 
                   
                    header("Location: addUser.php"); 
                    exit();
                }
              
                header("Location: dashboard.php"); 
                exit();
            } else {
                
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }

        $stmt->close();
    }
}

// Logout logic
if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();
    header("Location: login.php");
    exit();
}

$conn->close();
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Dolphin CRM</title>
     <link rel="stylesheet" href="styles.css">
     <script src="log.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 </head>
 <body>
    
   <header>
         <img src="dolphin.png" id="header-pic">
         <h3>Dolphin CRM</h3>
     </header>
    
     <div id="login">
         <form action="#" method="post">
             <label for="email">Email:</label>
            <input type="email" name="email" required><br>
    
             <label for="password">Password:</label>
             <input type="password" name="password" required><br>
    
             <button type="submit"><i class="fas fa-lock"></i> Login</button>
         </form>
     </div>
    
     <footer>
         <p>Copyright &copy; 2022 Dolphin CRM.</p>
     </footer>
    
 </body>
 </html>
