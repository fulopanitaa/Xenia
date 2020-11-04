


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
<h2> STATISTICI</h2>
</div>
<?php
($result = $mysqli->query("SELECT COUNT(id) AS prog FROM programari  WHERE YEARWEEK(`ziua`, 1) = YEARWEEK(CURDATE(), 1)"));
    
    $row = mysqli_fetch_assoc($result); 
    $prog=$row['prog'];

?>

<div class='news' id="weekadmin">
<p class='text-center'><h3><?php echo $prog ; ?> Programari pe saptama aceasta!</p>
</div>


<div id="weekappadmin" style="display:none; margin-top:30px">
<?php

include("../conect.php");

if($result = $mysqli->query("SELECT * FROM programari  WHERE YEARWEEK(`dataprogramare`, 1) = YEARWEEK(CURDATE(), 1)"))
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
            echo "<td>".$row->dataprogramare."</td>";
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



<div class="row">
  <div class="columnb">
    <div class="card">

      <?php 
    $result = $mysqli->query("SELECT COUNT(id) AS clienti FROM clienti");
    
      $row = mysqli_fetch_assoc($result); 
      $clienti=$row['clienti'];
	
      echo"<h3>".$clienti."</h3>";

?>
      <p>CLIENTI</p>
    </div>
  </div>

  <div class="columnb">
    <div class="card">


      <?php 
    $result = $mysqli->query("SELECT COUNT(id) AS programari FROM programari");
    
      $row = mysqli_fetch_assoc($result); 
      $programari=$row['programari'];
	
      echo"<h3>".$programari."</h3>";

?>
      <p>PROGRAMARI</p>
    </div>
  </div>
  
  <div class="columnb">
    <div class="card">

    <?php 
    $result = $mysqli->query("SELECT COUNT(id_comanda) AS comenzi  FROM comenzi_produse");
    
      $row = mysqli_fetch_assoc($result); 
      $comenzi=$row['comenzi'];
	
      echo"<h3>".$comenzi."</h3>";

?>
      <p>COMENZI</p>
    </div>
  </div>
  
  <div class="columnb">
    <div class="card">
    <?php 
    $result = $mysqli->query("SELECT COUNT( DISTINCT idclient) AS cursanti  FROM comenzi_curs");
    
      $row = mysqli_fetch_assoc($result); 
      $cursanti=$row['cursanti'];
	
      echo"<h3>".$cursanti."</h3>";

?>
      
      <p>CURSANTI</p>
    </div>
  </div>
</div>




  </article>

  <script> 
$(document).ready(function(){
  $(".weekadmin").click(function(){
    $("#weekappadmin").slideToggle("slow");
  });
});
</script>

  <script src="js/navtoggle.js"></script>
</body>