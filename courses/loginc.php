

<?php

// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page



// Include config file
require_once "../conect.php";


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
	 $sql = 'SELECT c.prenume, c.email, c.parola, p.idclient FROM clienti AS c INNER JOIN comenzi_curs AS p ON c.id = p.idclient WHERE email = ? LIMIT 1'; 
 
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
	 $stmt->bind_result( $prenume, $email, $hashed_password, $idclient);
	 if($stmt->fetch()){
			if(password_verify($login_password, $hashed_password)){
			 // Password is correct, so start a new session
					session_start();

					// Store data in session variables
					$_SESSION["loggedin"] = true;
					$_SESSION["id"] = $idclient;
					$_SESSION["email"] = $email; 
					$_SESSION["prenume"] = $prenume; 
                    
                    header('location: indexc.php');

				
			 }
			  else{
			 // Display an error message if password is not valid
			 $password_err = "The password you entered was not valid.";
			}
	}
				}

 else{
 // Display an error message if username doesn't exist
 $email_err = "Nu s-a gasit nici un cont cu aceasta adresa de mail.";
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
<link rel="stylesheet" type="text/css" href="stylecourses.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>


<body>

<div class="back">
<div class="signin">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1> Autentificare </h1>
        <div class="textbox">
        <input type="text" name="email" placeholder="Adresa de mail" value="<?php echo $email;?>">
        </div>
        <span class="error"><?php echo $email_err;?></span><br><br>
        <div class="textbox">
        <input type="password" name="password" placeholder="Parola" value="<?php echo $login_password; ?>" >
        </div>
        <span  class="error"><?php echo $password_err; ?></span><br><br>
        <button class="btn"> Acceseaza cursurile </button>
    </form>

</div> 
</div>
</body>


</html>