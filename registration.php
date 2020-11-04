

<?php
// Include config file
require_once "conect.php";


// Define variables and initialize with empty values
$email=$nume=$prenume= $login_password = $confirm_password = "";
$email_err=$nume_err=$prenume_err= $login_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if (empty($_POST["nume"])) {
      $nume_err = "*Te rugam sa introduci numele";
    } else {
      $nume = test_input($_POST["nume"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$nume)) {
      $nume_err = "*Te rugam sa folosesti doar litere";
      }
    }
    
   
    if (empty($_POST["prenume"])) {
          $prenume_err = "*Te rugam sa introduci prenumele";
        } else {
          $prenume = test_input($_POST["prenume"]);
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z ]*$/",$prenume)) {
            $prenume_err = "*Te rugam sa folosesti doar litere";
          }
      }
      

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Te rugam sa introduci adresa de email.";
        } else{

                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $email_err = "*Formatul adresei de mail este incorect";
                }
        // Prepare a select statement
        $sql = "SELECT email FROM clienti WHERE email = ?";

        if($stmt = $mysqli->prepare($sql)){
                        // Bind variables to the prepared statement as parameters
                        $stmt->bind_param("s", $param_email);

                        // Set parameters
                        $param_email = trim($_POST["email"]);

                        // Attempt to execute the prepared statement
                        if($stmt->execute()){
                        // store result
                        $stmt->store_result();

                        if($stmt->num_rows == 1){
                        $email_err = "Adresa de mail a fost deja folosita";
                        } else{
                        $email = trim($_POST["email"]);
                        }

                } else{
                echo "Oops! A aparut o eroare. Te rugam sa incerci din nou mai tarziu.";
                }
                $stmt->close();
            }

        }

     


 // Validate password
 if(empty(trim($_POST["password"]))){
 $login_password_err = "Te rugam sa introduci o parola.";
 } elseif(strlen(trim($_POST["password"])) < 6){
 $login_password_err = "Parola trebuie sa fie de cel putin 6 caractere.";
 } else{
 $login_password = trim($_POST["password"]);
 }

 // Validate confirm password
 if(empty(trim($_POST["confirm_password"]))){
 $confirm_password_err = "Te rugam sa confirmi parola.";
 } else{
 $confirm_password = trim($_POST["confirm_password"]);
 if(empty($login_password_err) && ($login_password != $confirm_password)){
 $confirm_password_err = "Parolele introduse difera.";
 }
 }


 // Check input errors before inserting in database
 if(empty($email_err) && empty($login_password_err) && empty($confirm_password_err)){

 // Prepare an insert statement
 $sql = "INSERT INTO clienti (email,nume,prenume, parola) VALUES (?, ?,?,?)";

 if($stmt = $mysqli->prepare($sql)){
 // Bind variables to the prepared statement as parameters
 $stmt->bind_param("ssss", $param_email,$param_nume,$param_prenume, $param_password);

 // Set parameters
 $param_nume = $nume;
 $param_prenume = $prenume;
 $param_email = $email;
 $param_password = password_hash($login_password, PASSWORD_DEFAULT); // Creates a password hash
 
 
				// Attempt to execute the prepared statement
				if($stmt->execute()){
				// Redirect to login page
				header("location: login.php");
				} else{
				echo "Something went wrong. Please try again later.";
        }
      
  $stmt->close();
 }


 // Close statement
 }

 
 // Close connection
 $mysqli->close();
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>


<!DOCTYPE html>
<html lang="ro">
<head>

<?php include('header.php'); 

?>
</head>


<body>
<?php include('navbar.php'); ?>
<!-- navbar -->

<div class="containertop">
	<h2 style="font-family:Linden Hill;">CREARE CONT</h2>
	<br>
    <p>Va rugam sa completezi formularul pentru a crea un cont</p>
  </div>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


  <div class="containertext" style="background-color:white">
    <label for="email">E-mail</label><br>
	<input type="email" placeholder="Introduceti adresa de mail" name="email"  value="<?php echo $email;?>">
    <span class="error"><?php echo $email_err;?></span><br><br>

    <label for="nume">Nume</label><br>
	<input type="text" placeholder="Introduceti numele" name="nume"  value="<?php echo $nume;?>">
    <span class="error"><?php echo $nume_err;?></span><br><br>

    <label for="prenume">Prenume</label><br>
	<input type="text" placeholder="Introduceti prenumele" name="prenume"  value="<?php echo $prenume;?>">
    <span class="error"><?php echo $prenume_err;?></span><br><br>
    
    <label for="password"><b>Parola</b></label><br>
    <input type="password" placeholder="Introduceti parola" name="password" value="<?php echo $login_password; ?>">
    <span class="error"><?php echo $login_password_err; ?></span><br><br>

    <label for="confirm_password"><b>Confirma parola</b></label><br>
    <input type="password" placeholder="Introduceti din nou parola"" name="confirm_password" value="<?php echo $confirm_password; ?>">
    <span class="error"><?php echo $confirm_password_err; ?></span><br><br>


 
  </div>
  <div class="containersubmit">
  <input type="submit" value="Creaza"><br>
  <input type="reset" value="Reseteaza">
  </div>
  <center><p style="font-size:13px">Ai deja un cont? <a href="login.php">Intra in cont aici</a>.</p></center>
</form>

<script src="js/search.js"></script>					
			
</body>
<?php include('footer.php'); ?>
</html>