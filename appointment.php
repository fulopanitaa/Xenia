
<?php

require_once('conect.php');

session_start();

$nume = '';
$prenume = '';
$email = '';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	if ($mysqli->connect_error) {
        die("error");
    }

    $sql = "SELECT nume, prenume, email FROM clienti WHERE email = ?";

    if ($stmt = $mysqli->prepare($sql))
    {
        $stmt->bind_param("s", $_SESSION["email"]);

        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($nume, $prenume, $email);
            $stmt->fetch();

        }
        else{
          $nume='';
          $prenume='';
          $email='';
        }
    
    }

    $mysqli->close();
}


 include("conect.php");
//  define variables and set to empty values

 $tel=$detalii=$ziua= $ora="";
 $nume_err = $prenume_err= $email_err=$tel_err=$dataeven_err=$detalii_err=$ziua_err=$ora_err="";



 if ($_SERVER["REQUEST_METHOD"] == "POST") {


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
         $prenume_err = "*Va rugam sa introduceti prenumele";      
         } else {
         $prenume = test_input($_POST["prenume"]);
         // check if name only contains letters and whitespace
         if (!preg_match("/^[a-zA-Z ]*$/",$prenume)) {
           $prenume_err = "*Va rugam sa folositi doar litere";
         }
 	  }
	  

   if (empty($_POST["email"])) {
 		$email_err = "*Te rugam sa introduci adresa de mail";
 	  } else {
 		$email = test_input($_POST["email"]);
 		// check if e-mail address is well-formed
 		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $email_err = "*Formatul adresei de mail este incorect";
         }
     }
    
   if (empty($_POST["tel"])) {
 		$tel_err = "*Te rugam sa introduci un numarul de telefon";
 	  } else {
 		$tel = test_input($_POST["tel"]);
 		// check if tel is well-formed
 		if(!preg_match('/^[0-9]{10}+$/', $tel)){
 		$tel_err = "*Numar incorect";
 		}
       }
      


   if (empty($_POST["ziua"])) {
 		$ziua_err = "*Te rugam sa selectezi o zi";
 	   } 
 	   else {
 		$ziua = test_input($_POST["ziua"]);
 	  }
   if (empty($_POST["ora"])) {
 		$ora_err = "*Te rugam sa selectezi o ora";
      } 
      
    
      $sql = "INSERT INTO programari (nume, prenume, email, tel, dataeveniment, detalii, ziua, ora) VALUES(?,?,?,?,?,?,?,?)";
      if ($stmt = $mysqli->prepare($sql))
      {
          $stmt->bind_param("ssssssss", $_POST['nume'], $_POST['prenume'], $_POST['email'], $_POST['tel'], $_POST['dataeveniment'], $_POST['detalii'], $_POST['ziua'], $_POST['ora']);
      
          // echo $_POST['nume'], $_POST['prenume'], $_POST['email'], $_POST['tel'], $_POST['dataeveniment'], $_POST['detalii'], $_POST['ziua'], $_POST['ora'];
      
          $stmt->execute();
      
          if ($stmt->affected_rows > 0) {
       
            $_SESSION['response']="Programare efectuata cu succes! Ti-am trimis un mail cu datele programarii. ";
        }
        
      } 
      else {
   
    $_SESSION['response']="Programare esuata. Te rugam sa incerci din nou.  ";
      }

      // TRIMITERE MAIL
$data=$_POST['ziua'];
$ora=$_POST['ora'];
$email= $_POST['email'];
$header = "From: XENIA ";
//$header .= "Content-type: X-Mailer: php\r\n";
$header.= "MIME-Version: 1.0" . "\n";
$header .= "Content-type:text/html;charset=UTF-8" . "\n";
$subject ="Confirmare programare";
$message = "
<html>
<head>
<title>Confirmare programare</title>

</head>
<body>


<div style='background-color:rgb(235, 233, 226); text-align:center;  padding:40px 40px; '>
<div style='background-color:white; padding:50px 20px; border:1px solid rgb(173, 172, 172); font-family: Linden Hill; color:black; '>

<br>
<p style=' color:black; font-size:14px'> Iti multumim pentru programarea facuta! </p>
<p style=' color:black; font-size:14px'> Te asteptam in data de <b>$data</b>, ora:<b> $ora. </b></p>

<p style=' color:black; font-size:14px'>Daca nu reusesti sa ajungi, te rugam sa apelezi la numarul 0748666890.</p>



<div style='text-align:right;padding-right:10%;'>
        <h1 style=' color:black;'> Echipa Xenia </h1>

    </div>
</div>
</div>

</body>
</html>
";
if (mail($email,$subject,$message,$header));


    } 

 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }
  $mysqli->close();


?> 



<!DOCTYPE html>
<html lang="ro">
<head>
<?php include('header.php'); ?>

</head>

<body>
<?php include('navbar.php'); ?>
<!-- navbar -->
<!-- include navbarul peste tot -->

	

  <div class="containertop" >
	<h2 style="font-family:Linden Hill;">FA-TI O PROGRAMARE LA SHOWROOM</h2>
	<br>

    <p>Pentru a programa o întalnire la atelierul nostru, completeaza formularul de mai jos. Pentru asistenta imediata, te rugam sa suni la numarul afisat</p>
  </div>

  <?php if(isset($_SESSION['response'])){ ?>
  <div id="mypopup" class="popup">
<div class="popup-content">
<a href="javascript:void(0)" class="closebtn" style="top:0px;right:2px;color:black" onclick="closepop()">&times;</a>
<p><b><?=$_SESSION['response'];?></b></p>

</div>
</div>
<?php } unset($_SESSION['response'])?>



</div>



  <form method="post"  id="appointment_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="border:none">  
  
  <div class="containertext" style="background-color:white">


	<label for="nume">Nume</label><br>
	<input type="text" placeholder="Nume" name="nume" value="<?php echo $nume; ?>">
  <span class="error"> <?php echo $nume_err;?></span><br><br>

	<label for="prenume">Prenume</label><br>
	<input type="text" placeholder="Prenume" name="prenume"  value="<?php echo $prenume; ?>">
  <span class="error"> <?php echo $prenume_err;?></span><br><br>
	<label for="email">E-mail</label><br>
	<input type="email" placeholder="Email address" name="email"  value="<?php echo $email; ?>">
  <span class="error"><?php echo $email_err;?></span><br><br>
	<label for="tel">Numar de telefon</label><br>
	<input type="tel" placeholder="Numar de telefon" name="tel" value="<?php echo $tel;?>">
  <span class="error"> <?php echo $tel_err;?></span><br><br>

	<label for="dataeveniment">Data evenimentului</label><br>
	<input type="date" name="dataeveniment"><br>

	<label for="detalii">Detalii</label><br>
	<textarea id="textarea" rows="4" cols="50" name="detalii" ></textarea><br>

	<label for="ziua">Alege ziua programarii</label><br>
	<input id="ziua" type="date" name="ziua"  value="<?php echo $ziua;?>">
  <span class="error"> <?php echo $ziua_err;?></span><br><br>

	<label for="select" required >Alege ora</label><br>
	<select id="ora" name="ora" disabled>

		<!-- echo "<option value='".$row->ora."'>".$row->ora."</option>"; -->

	</select>
	<span class="error"> <?php echo $ora_err;?></span><br><br>

 
  </div>

  <div class="containersubmit">
    <input type="submit" name="submit" value="TRIMITE">
  </div>
</form>

<?php include('footer.php'); ?>
<script src="js/search.js"></script> 
<script src="jquery/jquery.js" type="text/javascript"></script>
<script src="js/appointment.js" type="text/javascript"></script>
<script>
function closepop() {
  document.getElementById("mypopup").style.display = "none";
}
</script>

</body>
</html>