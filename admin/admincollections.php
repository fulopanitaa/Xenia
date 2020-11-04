


<!--------------------------------ADD COLECTIE-------------------------------->
<?php
include('../conect.php');
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$denumire = htmlentities($_POST['denumire'],ENT_QUOTES);
	$file = $_FILES['coperta']['tmp_name'];
		if($denumire =='')
		{
			$error = 'ERROR: Campuri goale!';
		}
        if (!isset ($file)){
			$error = 'ERROR: Campuri goale ';
		}else{
		$image = addslashes(file_get_contents($_FILES['coperta']['tmp_name']));
		$image_size = getimagesize($_FILES['coperta']['tmp_name']);
		}
		if($image_size==false){
		$error = 'ERROR:Fisierul ales nu este imagine!';
}
else{

  $insert = $mysqli->query("INSERT INTO colectii (denumire,coperta) VALUES ('$denumire','$image')") or die("Problem uploading image.");
  $_SESSION['response']="ADAUGAT CU SUCCES";
}
}

$mysqli->close();
?>
<!--------------------------------ADD COLECTIE-------------------------------->

<!--------------------------------STERGERE-------------------------------->

<?php
include("../conect.php");
if(isset($_GET['id'])&&is_numeric($_GET['id']))
{
    $id=$_GET['id'];
   
	if($stmt=$mysqli->prepare("DELETE FROM colectii WHERE id=? LIMIT 1"))
	{
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$stmt->close();
    }
        
	else
	{
		echo "alert('ERROR:Nu se poate executa stergerea.)";
	}
	

}

?>
<!--------------------------------STERGERE-------------------------------->


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
<h2> COLECTII</h2>
<span style="font-size:30px;cursor:pointer;float:left; display:none" id="opennav">&#9776; </span>
<?php if(isset($_SESSION['response'])){ ?>
<div id="alert">
  <a type="button" class="close" >x</a>
  <b class="text-center"><?=$_SESSION['response'];?></b>
  <?php } unset($_SESSION['response'])?>

</div>
<span style="font-size:30px;cursor:pointer;float:left; display:none;" id="opennav">&#9776; </span>
<!--------------------------------ADAUGARE COLECTIE-------------------------------->

<div id="addcollection"> 

<?php
if($error!='')
{
	echo "<div style='padding:4px;border:1px solid red'>".$error."</div>";
}
?>

	<form  class="form-inline" method="post" enctype="multipart/form-data">			
        <div id="hide">
		<label for="denumire"><b>Denumire</b></label><input required class="diff"type="text" name="denumire" value=""/>
		<label for="coperta"><b>Coperta</b></label><input required class="diff" type="file" name="coperta" id="coperta" value=""/>
		<button type="submit" name="add" value="TRIMITE">TRIMITE</button>
		</div>
   
   </form>

   <button href="addcollection.php" class="add">ADAUGA COLECTIE</button>

</div> 
<!----------------------------------------UPDATE---------------------------------->



<!---------------------------------LISTARE COLECTII-------------------------------->


<div class style="overflow:auto;margin-top:20px;">


<?php
include("../conect.php");

if($result = $mysqli->query("SELECT * FROM colectii ORDER BY creat"))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>ID</th><th>Denumire</th><th>Coperta</th><th>Creat</th><th></th><th></th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";
			echo "<td>".$row->id."</td>";
			echo "<td>".$row->denumire."</td>";
			echo '<td><img class="image" src="data:image/jpeg;base64,'.base64_encode($row->coperta).'" alt=""  height="150"></td>';
			echo "<td>".$row->creat."</td>";
			echo "<td><a onclick='openNav()' style='text-decoration:none;color:blue' href='updatecollection.php?id=".$row->id."'>MODIFICA</a></td>";
			echo "<td><a style='text-decoration:none;color:red' href='admincollections.php?id=". $row->id."'>STERGE</a></td>";
			echo "</tr>";
		}
		
		echo"</table>";		
	}
	else
	{
		echo "Nu sunt inregistrari in tabela!";
	}
}
	
	$mysqli->close();
?>
</div>
</article>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
  $(".add").click(function(){
    $("#hide").slideToggle("slow");
  });
});
</script>


<script src="navtoggle.js"></script>
</body>
</html>