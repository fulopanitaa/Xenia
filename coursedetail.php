<?php

require_once('conect.php');

session_start();
$idclient='';
$firstname = '';
$lastname = '';
$email = '';
$notlogged='';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  if ($mysqli->connect_error) {
        die("error");
    }
    $sql = "SELECT id, nume, prenume, email FROM clienti WHERE email = ?";
    if ($stmt = $mysqli->prepare($sql))
    {
        $stmt->bind_param("s", $_SESSION["email"]);

        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($idclient,$firstname, $lastname, $email);
            $stmt->fetch();

        }
    }
}

else{
  $notlogged="Te rugam sa te autentifici pentru a comanda un curs!";
}


?>




<!DOCTYPE html>
<html lang="ro">
    
<header>
<?php include('header.php'); 
?>
</header>
<body>

<?php include('navbar.php'); ?>
<!-- navbar -->


<?php 
  		if($result = $mysqli->query("SELECT * FROM cursuri WHERE id='".$_GET['id']."'"))
					{
						if($result->num_rows>0)
						{
							$row = $result->fetch_object(); ?>



<div class="containertop">
    <h2 style="font-family:Linden Hill;"><?php echo $row->nume; ?> </h2>
    <hr class="curs">
</div>


<?php if(isset($_SESSION['response'])){ ?>
  <div id="mypopup" class="popup">
<div class="popup-content">
<a href="javascript:void(0)" class="closebtn" style="top:0px;right:2px;color:black" onclick="closepop()">&times;</a>
<p><b><?=$_SESSION['response'];?></b></p>

</div>
</div>
<?php } unset($_SESSION['response'])?>







<?php if($_GET["id"]== 1){?>
	<button onclick="openc()" class="buycourse"> COMANDA CURSUL </button>
    <?php }
     else if($_GET["id"]== 2)
    {?>
	<button onclick="openc()" class="buycourse i"> COMANDA CURSUL </button>

    <?php }
    else {?>
     <button onclick="openc()" class="buycourse a"> COMANDA CURSUL </button>
    <?php }?>
    

<!-- FORMULAR COMANDA -->

<div id="myOrder" class="moverlay" style="overflow-x:hidden;z-index:9999">
<div class="moverlay-content">
<a href="javascript:void(0)" class="closebtn" style="top:0px;right:2px;color:black" onclick="closec()">&times;</a>
<h2 ><b><?php echo $row->nume; ?></b></h2><br>
<p style="padding:20px 60px; font-size:14px">Dupa completarea formularului vei primi un mail cu linkul catre platforma cu cursuri online</p>
<p style="font-size:14px; color:red"> <?php echo $notlogged ?></p>
<hr style="border-color:gray">

<form class="orderc"method="post" action="send_script.php">

																<div class="row">
																	<div class="r1" >
                               <?php echo' <img src="data:image/jpeg;base64,'.base64_encode($row->copertamica).'" >';?>
                                </div>
                                <div class="r1" >
                  
                                    <input type="hidden" class="ad c" name="id" value="<?php echo $row->id ?>">
                                    <input type="hidden"  class="ad c" name="idclient" value="<?php echo $idclient; ?>" >
                                    <label for="email">E-mail</label><br>
																		<input type="text"  readonly  class="ad c" name="email" value="<?php echo $email; ?>" required>
																		<span class="error"> </span><br><br>
																		<label for="nume">Nume</label><br>
																		<input type="text" readonly class="ad c" name="nume"  value="<?php echo $firstname; ?>"required>
																		<span class="error"> </span><br><br>
																		<label for="prenume">Prenume</label><br>
                                    <input type="text" readonly class="ad c" name="prenume"  value="<?php echo $lastname; ?>" required>
                                    <span class="error"> </span><br><br>
																	
                                    
                                   
                                  
                                    <div class="containersubmit">
																<input type="submit" name="send_message_btn" value="COMANDA CURSUL">
															</div>
                                </div>
</div>

															
	

														</form>
														
</div><!--overlay-->
</div>
                          <!-- FULL PAGE TABS ------------------------------------------------------------------------> 
                      <div class="tabs">

                        <?php if($_GET["id"]== 1)
                        {?>
                            <button class="tablink" onclick="openPage('Program', this, 'white')" >Program</button>
                            <button class="tablink" onclick="openPage('Despre', this, 'white')" id="defaultOpen">Despre curs</button>
                            <button class="tablink" onclick="openPage('Tarif', this, 'white')" >Tarif</button>                     
                        <?php }
                        else if($_GET["id"]== 2)
                        {?>
                            <button class="tablink i" onclick="openPage('Program', this, 'white')" >Program</button>
                            <button class="tablink i" onclick="openPage('Despre', this, 'white')" id="defaultOpen">Despre curs</button>
                            <button class="tablink i" onclick="openPage('Tarif', this, 'white')" >Tarif</button> 

                        <?php }
                        else {?>
                            <button class="tablink a" onclick="openPage('Program', this, 'white')" >Program</button>
                            <button class="tablink a" onclick="openPage('Despre', this, 'white')" id="defaultOpen">Despre curs</button>
                            <button class="tablink a" onclick="openPage('Tarif', this, 'white')" >Tarif</button> 
                        <?php }?>
                    
                          <div id="Program" class="tabcontent">

                            <div class="row">
                                  <div class="modul" >
                                                <h4>Modul 1 - <?php echo $row->modul1_titlu ?> </h4>
                                                <p style="text-align:justify">  <?php echo $row->modul1 ?> </p>
                      
                                  </div>
                                  <div class="modul" >
                                              <h4>Modul 1 - <?php echo $row->modul2_titlu ?></h4>
                                              <p style="text-align:justify"><?php echo  $row->modul2 ?></p>
                     
                                </div>
                                  <div class="modul" >
                                              <h4 >Modul 1 - <?php echo  $row->modul3_titlu ?></h4> 
                                              <p style="text-align:justify"> <?php echo  $row->modul3 ?></p>
                                      
                                  </div>
                            </div> <!--row-->
                            </div><!--Program-->

                            <div id="Despre" class="tabcontent">
                            <div class="tabby-content">
                            <?php echo' <img src="data:image/jpeg;base64,'.base64_encode($row->copertamica).'" >';?>
                              
                                <h4 >Descriere</h4><br>
                                <p style="text-align:justify">  <?php echo $row->descriere ?> </p>
  
                            
                                </div>
                                     
                                </div><!--Despre-->
                         


                          <div id="Tarif" class="tabcontent">
                                
                                  <h4>Termeni de plată:</h4>
                                    <p style="margin:10px">Costul cursului este de <b> <?php echo  $row->tarif?></b> de lei</p>
                                    <p style="margin:10px">Nu se accepta plata in transe</p>
                          </div><!--Tarfif-->


                      </div> <!--Tabs------------------------------------------------------------------------------------------------->


                      <?php }  ?>
	<?php }  ?>

<div class="containertop" style="background-color:white;margin-top:10px">
    <h1 class="titlecourse" style="font-size:20px">  RECOMANDARI </h1><br>
</div>

 <div class="content courses" >			



 <?php
	include("conect.php");
		$result = $mysqli->query("SELECT * FROM cursuri WHERE id != '".$_GET['id']."'");
		if($result->num_rows > 0)
	{
        while($row=$result->fetch_object())
		{
		
     echo'<div class="responsive courses" data-aos="zoom-in" data-aos-delay="100">';
      echo'<div class="gallery">';
      echo'<a href="coursedetail.php?id='.$row->id.'">';
        echo'<img class="image" src="data:image/jpeg;base64,'.base64_encode($row->coperta).'" >';
        echo'<div class="middle courses"> <div class="textcurs"><h1>'.$row->numescurt.'</h1><p style="text-decoration:underline;padding-bottom:5px">Detalii curs</p></div>';
        echo'</div>';
        echo'</a>';
    
      echo'</div>';
    echo'</div>';


      
			
		}
	}
	echo"<div class='clearfix'></div>";
	echo"</div> ";
	$mysqli->close();
	?>


<!-----------------------------------------SCRIPTS------------------------------------------------------------>



<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<script>
function openc() {
  document.getElementById("myOrder").style.height = "100%";
}

function closec() {
  document.getElementById("myOrder").style.height = "0%";
}
</script>
<script>
function closepop() {
  document.getElementById("mypopup").style.display = "none";
}
</script>
<script src="js/search.js"></script>
</body>
<?php include('footer.php'); ?>
</html>