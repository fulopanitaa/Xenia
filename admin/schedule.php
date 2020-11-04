<?php 

include("scheduleaction.php");
?>


<?php
include("adminheader.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Colectii</title>
</head>


<body>
<article>
<a href="adminappointment.php" class="back">Inapoi la programari </a>

<div class="title2">
<span style="font-size:30px;cursor:pointer;float:left; display:none" id="opennav">&#9776; </span>
    <h1> ORAR PENTRU PROGRAMARI LA ATELIER </h1>
	
    <hr>
<?php if(isset($_SESSION['response'])){ ?>
<div id="alert">
  <a type="button" class="close" >x</a>
  <b class="text-center"><?=$_SESSION['response'];?></b>
  <?php } unset($_SESSION['response'])?>
</div>
</div>

<div id="orarapp" style="padding:50px 100px">
<?php
include("../conect.php");

if($result = $mysqli->query("SELECT * FROM orar ORDER BY ora"))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>Ora</th><th></th><th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";
            echo "<td>".$row->ora."</td>";
			echo "<td><a  style='text-decoration:none;color:blue' href='schedule.php?edit=".$row->id."'>MODIFICA</a></td>";
			echo "<td><a style='text-decoration:none;color:red' href='scheduleaction.php?id=". $row->id."' onclick='return confirm('Doriti sa stergeti acest elemnt?')'>STERGE</a></td>";
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

<?php if($update==true){?>
	<h3 style="margin-top:0"> MODIFICA ORA</h3>
	<?php } else {?>
	<h3 style="margin-top:0"> ADAUGA ORA </h3>
	<?php }?>
<form action="scheduleaction.php" method="post">
	
	<input type="hidden" name="id" value="<?= $id; ?>">
	<input style="margin-top:20px;text-align:center" class="diff" type="text" name="ora" id="ora" value="<?= $ora; ?>" required><br>
	<?php if($update==true){?>
	<input style="" class="dif" type="submit" name="update" value="Modifica">
	<?php } else {?>
	<input style="" class="dif" type="submit" name="adauga" value="Adauga">
	<?php }?>
</form>


</article>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/navtoggle.js"></script>

<script>
$(document).ready(function(){
  $("#close").click(function(){
  $("#alert").css("color", "red");
  });
});
</script>
</body>
</html>

