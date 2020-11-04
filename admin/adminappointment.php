<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Colectii</title>
</head>

<body>

    
<?php
include("../conect.php");
?>

<?php
include("adminheader.php");
?>


<article>

<div class="title">
<span style="font-size:30px;cursor:pointer;float:left; display:none" id="opennav">&#9776; </span>
<h2> PROGRAMARI</h2>
</div>



<div style="margin-top:50px">
<?php
$result = $mysqli->query("SELECT MIN(ora) as minimum, MAX(ora) as maximum FROM orar");

$row = mysqli_fetch_assoc($result); 

$minimum = $row['minimum'];
$maximum=$row['maximum'];
                echo"<h4>ORAR: ".$minimum."-".$maximum."</h4><br>"; 
   

?>
</div>
<a style="margin-bottom:5px; color:black; text-decoration:none;border-bottom:1px solid black" href="schedule.php"> Schimba orarul </a>

<button style="margin-top:50px"  class="add" id="total">TOATE PROGRAMARILE</button>

<div id="totalapp" style="display:none; margin-top:30px">

<?php
include("../conect.php");

if($result = $mysqli->query("SELECT * FROM programari ORDER BY ziua"))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>ID</th><th>Nume</th><th>Prenume</th><th>E-mail</th><th>Nr.Telefon</th><th>Data evenimentului</th><th>Detalii</th><th>Dataprogramare</th><th>Ora</th><th></th><th></th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";
			echo "<td>".$row->id."</td>";
			echo "<td>".$row->nume."</td>";
            echo "<td>".$row->prenume."</td>";
            echo "<td>".$row->email."</td>";
            echo "<td>".$row->tel."</td>";
            echo "<td>".$row->dataeveniment."</td>";
            echo "<td>".$row->detalii."</td>";
            echo "<td>".$row->ziua."</td>";
            echo "<td>".$row->ora."</td>";
			echo "<td><a onclick='openNav()' style='text-decoration:none;color:blue' href='updatecollection.php?id=".$row->id."'>MODIFICA</a></td>";
			echo "<td><a style='text-decoration:none;color:red' href='admincolectii.php?id=". $row->id."'>STERGE</a></td>";
			echo "</tr>";
		}
		
		echo"</table>";		
	}
	else
	{
		echo "Nu sunt inregistrari in tabela!";
	}
}
	
?>

</div>

<button style="margin-top:20px" class="add" id="month">PROGRAMARI PE LUNA CURENTA</button>

<div id="monthapp" style="display:none; margin-top:30px">

<?php
include("../conect.php");

if($result = $mysqli->query("SELECT * FROM programari WHERE MONTH(ziua) = MONTH(CURRENT_DATE()) AND YEAR(ziua) = YEAR(CURRENT_DATE())"))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>ID</th><th>Nume</th><th>Prenume</th><th>E-mail</th><th>Nr.Telefon</th><th>Data evenimentului</th><th>Detalii</th><th>Dataprogramare</th><th>Ora</th><th></th><th></th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";
			echo "<td>".$row->id."</td>";
			echo "<td>".$row->nume."</td>";
            echo "<td>".$row->prenume."</td>";
            echo "<td>".$row->email."</td>";
            echo "<td>".$row->tel."</td>";
            echo "<td>".$row->dataeveniment."</td>";
            echo "<td>".$row->detalii."</td>";
            echo "<td>".$row->ziua."</td>";
            echo "<td>".$row->ora."</td>";
			echo "<td><a onclick='openNav()' style='text-decoration:none;color:blue' href='updatecollection.php?id=".$row->id."'>MODIFICA</a></td>";
			echo "<td><a style='text-decoration:none;color:red' href='admincolectii.php?id=". $row->id."'>STERGE</a></td>";
			echo "</tr>";
		}
		
		echo"</table>";		
	}
	else
	{
		echo "Nu sunt inregistrari in tabela!";
	}
}
	
?>

</div>
<button style="margin-top:20px" class="add" id="week">PROGRAMARILE PE SAPTAMANA CURENTA</button>
<div id="weekapp" style="display:none; margin-top:30px">

<?php

include("../conect.php");

if($result = $mysqli->query("SELECT * FROM programari  WHERE YEARWEEK(`ziua`, 1) = YEARWEEK(CURDATE(), 1)"))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>ID</th><th>Nume</th><th>Prenume</th><th>E-mail</th><th>Nr.Telefon</th><th>Data evenimentului</th><th>Detalii</th><th>Dataprogramare</th><th>Ora</th><th></th><th></th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";
			echo "<td>".$row->id."</td>";
			echo "<td>".$row->nume."</td>";
            echo "<td>".$row->prenume."</td>";
            echo "<td>".$row->email."</td>";
            echo "<td>".$row->tel."</td>";
            echo "<td>".$row->dataeveniment."</td>";
            echo "<td>".$row->detalii."</td>";
            echo "<td>".$row->ziua."</td>";
            echo "<td>".$row->ora."</td>";
			echo "<td><a onclick='openNav()' style='text-decoration:none;color:blue' href='updatecollection.php?id=".$row->id."'>MODIFICA</a></td>";
			echo "<td><a style='text-decoration:none;color:red' href='admincolectii.php?id=". $row->id."'>STERGE</a></td>";
			echo "</tr>";
		}
		
		echo"</table>";		
	}
	else
	{
		echo "Nu sunt inregistrari in tabela!";
	}
}
	
?>

</div>




<div class="row" style="margin-top:80px">
  <div class="columna">
    <div class="card">
      <p><i class="fa fa-user"></i></p>

      <?php 
    $result = $mysqli->query("SELECT COUNT(id) AS sapt FROM programari WHERE YEARWEEK(`ziua`, 1) = YEARWEEK(CURDATE(), 1)");
    
      $row = mysqli_fetch_assoc($result); 
      $sapt=$row['sapt'];
	
      echo"<h3>".$sapt."</h3>";

?>
      <p>PE SAPTAMANA CURENTA</p>
    </div>
  </div>

  <div class="columna">
    <div class="card">
    <p><i class="fa fa-user"></i></p>

      <?php 
    $result = $mysqli->query("SELECT COUNT(id) AS luna FROM programari WHERE MONTH(ziua) = MONTH(CURRENT_DATE()) AND YEAR(ziua) = YEAR(CURRENT_DATE())");
    
      $row = mysqli_fetch_assoc($result); 
      $luna=$row['luna'];
	
      echo"<h3>".$luna."</h3>";

?>
      <p>PE LUNA CURENTA</p>
    </div>
  </div>
  
  <div class="columna">
    <div class="card">
    <p><i class="fa fa-user"></i></p>
      <?php 
    $result = $mysqli->query("SELECT COUNT(id) AS programari FROM programari");
    
      $row = mysqli_fetch_assoc($result); 
      $programari=$row['programari'];
	
      echo"<h3>".$programari."</h3>";

?>
      <p>TOTAL PROGRAMARI</p>
    </div>
  </div>
  
</div>



</article>

<script> 
$(document).ready(function(){
  $("#total").click(function(){
    $("#totalapp").slideToggle("slow");
  });
});
</script>
<script> 
$(document).ready(function(){
$("#month").click(function(){
    $("#monthapp").slideToggle("slow");
  });
});
</script>
<script> 
$(document).ready(function(){
  $("#week").click(function(){
    $("#weekapp").slideToggle("slow");
  });
});
</script>
<script src="../js/selectcustom.js"></script>
<script src="js/navtoggle.js"></script>
</body>
</html>