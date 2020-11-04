

<!--------------------------------STERGERE-------------------------------->

<?php
include("../conect.php");
session_start();


if(isset($_GET['id'])&&is_numeric($_GET['id']))
{
    $id=$_GET['id'];
   
	if($stmt=$mysqli->prepare("DELETE FROM clienti WHERE id=? LIMIT 1"))
	{
		$stmt->bind_param("i",$id);
		$stmt->execute();
        $stmt->close();
        $_SESSION['response']="STERGERE CU SUCCES";
    }
        
	else
	{
		echo "alert('ERROR:Nu se poate executa stergerea.)";
	}
	

}

?>






<!DOCTYPE html>
<html>
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
<h2> CLIENTI</h2>
</div>



<div class="row" style="margin-top:20px">


  <div class="column c">
    <div class="card">


      <?php 
    $result = $mysqli->query("SELECT COUNT(id) AS luna FROM clienti WHERE MONTH(creat) = MONTH(CURRENT_DATE()) AND YEAR(creat) = YEAR(CURRENT_DATE())");
    
      $row = mysqli_fetch_assoc($result); 
      $luna=$row['luna'];
	
      echo"<h3>".$luna."</h3>";

?>
      <p><b>CLIENTI NOI</b></p>
    </div>
  </div>
  
  <div class="column c">
    <div class="card">
      <?php 
    $result = $mysqli->query("SELECT COUNT(id) AS total FROM clienti");
    
      $row = mysqli_fetch_assoc($result); 
      $total=$row['total'];
	
      echo"<h3>".$total."</h3>";

?>
      <p><b>CLINETI IN TOTAL</b></p>
    </div>
  </div>
  
</div>
<h2 style="margin-top:40px;">Clineti</h2>

<?php if(isset($_SESSION['response'])){ ?>
<div id="alert">
  <a type="button" class="close" >x</a>
  <b class="text-center"><?=$_SESSION['response'];?></b>
  <?php } unset($_SESSION['response'])?>

</div>



<div class style="overflow:auto;margin-top:20px;margin-bottom:20px">
<?php
include("../conect.php");

if($result = $mysqli->query("SELECT * FROM clienti ORDER BY creat"))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>ID</th><th>Nume</th><th>E-mail</th><th>Parola</th><th>Creat</th><th></th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";
			echo "<td>".$row->id."</td>";
			echo "<td>".$row->nume."</td>";
            echo "<td>".$row->email."</td>";
            echo "<td>".$row->parola."</td>";
            echo "<td>".$row->creat."</td>";
			echo "<td><a style='text-decoration:none;color:red' href='adminclients.php?id=". $row->id."'>STERGE</a></td>";
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

<button style="margin-top:20px" href="addcollection.php" class="add" id="email">Adrese de e-mail</button>

<div id="emailclients" style="display:none; margin-top:30px;padding:20px 200px">

<?php
include("../conect.php");

if($result = $mysqli->query("SELECT id,email FROM clienti"))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>E-mail</th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";

            echo "<td>".$row->email."</td>";
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




</article>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
  $("#email").click(function(){
    $("#emailclients").slideToggle("slow");
  });
});
</script>
<script src="../js/selectcustom.js"></script>
<script src="js/navtoggle.js"></script>
</body>
</html>