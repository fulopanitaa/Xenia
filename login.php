
<?php

// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
 header("location: index.php");
 exit;
}


// Include config file
require_once "conect.php";


// Define variables and initialize with empty values
$email = $login_password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

	// Check if username is empty
	if(empty(trim($_POST["email"]))){
		$email_err = "Va rugam sa introduceti adresa de mail";
		} else{
		$email = trim($_POST["email"]);
	 }

	// Check if password is empty 
	 if(empty(trim($_POST["password"]))){
		 $password_err = "Va rugam sa introduceti parola";
		 } else{
		 $login_password = trim($_POST["password"]);
	 }
 
	 // Validate credentials
	 if(empty($email_err) && empty($password_err)){
	 // Prepare a select statement
	 $sql = "SELECT id, email, parola FROM clienti WHERE email = ?"; 
 
	 if($stmt = $mysqli->prepare($sql)){
	 // Bind variables to the prepared statement as parameters
	 $stmt->bind_param("s", $param_email);

	 // Set parameters
	 $param_email = $email;
 
	 // Attempt to execute the prepared statement
	 if($stmt->execute()){
	 // Store result
	 $stmt->store_result();
 
	 // Check if username exists, if yes then verify password
	 if($stmt->num_rows == 1){
	 // Bind result variables
	 $stmt->bind_result($id, $email, $hashed_password);
	 if($stmt->fetch()){
			 if(password_verify($login_password, $hashed_password)){
			 // Password is correct, so start a new session
					session_start();

					// Store data in session variables
					$_SESSION["loggedin"] = true;
					$_SESSION["id"] = $id;
					$_SESSION["email"] = $email; 

					if($email=='admin@yahoo.com')
					{
						header("location: admin/admin.php");
					}
					else{	 
					// Redirect user to welcome page
					header("location: index.php");
					}
			 }
			  else{
			 // Display an error message if password is not valid
			 $password_err = "The password you entered was not valid.";
			}
	}
				}

 else{
 // Display an error message if username doesn't exist
 $email_err = "No account found with that username.";
 }
} else{
 echo "Oops! Something went wrong. Please try again later.";
 }
  // Close statement
 $stmt->close();
 }

 }

 // Close connection
 $mysqli->close();
}
?>



<!DOCTYPE html>
<html lang="ro">
<head>

<?php include('header.php');?>
</head>


<body>
<?php include('navbar.php'); ?>
<!-- navbar -->

<div class="containertop">
	<h2 style="font-family:Linden Hill;">AUTENTIFICARE</h2>
	<br>
  </div>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


  <div class="containertext" style="background-color:white">
    <label for="email">E-mail</label><br>
	<input type="email" placeholder="Introduceti adresa de mail" name="email"  value="<?php echo $email;?>">
    <span class="error"><?php echo $email_err;?></span><br><br>
    
    <label for="password"><b>Parola</b></label><br>
    <input type="password" placeholder="Introduceti parola" name="password" value="<?php echo $login_password; ?>">
    <span class="error"><?php echo $password_err; ?></span><br><br>

  </div>
  
  <div class="containersubmit">
  <input type="submit" value="AUTENTIFICARE"><br>
</div>
<center><p style="font-size:13px">Esti client nou? <a href="registration.php">Inregistreaza-te aici</a>.</p></center>
</form>

<script src="js/search.js"></script>					
			
</body>
<?php include('footer.php'); ?>
</html>