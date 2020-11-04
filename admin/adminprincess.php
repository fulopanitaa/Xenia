<!--------------------------------ADD PRODUS FETITE-------------------------------->
<?php
include('../conect.php');
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nume = htmlentities($_POST['nume'],ENT_QUOTES);
    $pret = htmlentities($_POST['pret'],ENT_QUOTES);
    $descriere= htmlentities($_POST['descriere'],ENT_QUOTES);
    $descmaterial = htmlentities($_POST['descmaterial'],ENT_QUOTES);
    $descintretinere = htmlentities($_POST['descintretinere'],ENT_QUOTES);
    $categorie = htmlentities($_POST['categorie'],ENT_QUOTES);
    $marimi = htmlentities($_POST['marimi'],ENT_QUOTES);

    $file = $_FILES['poza']['tmp_name'];
    if (!isset ($file)){
        $error = 'ERROR: Campuri goale ';
    }else{
    $imagep = addslashes(file_get_contents($_FILES['poza']['tmp_name']));
    $image_size = getimagesize($_FILES['poza']['tmp_name']);
    }
    if($image_size==false){
    $error = 'ERROR:Fisierul ales nu este imagine!';
    }
		

else{

  $insert = $mysqli->query("INSERT INTO produse (nume,poza, pret,descriere,descmaterial, descintretinere,marimi,categorie) VALUES ('$nume','$imagep','$pret','$descriere','$descmaterial','$descintretinere','$marimi','$categorie')") or die("Problem uploading image.");
  
}
}
$mysqli->close();
?>
<!--------------------------------ADD PRODUS FETITE-------------------------------->

<!--------------------------------STERGERE-------------------------------->

<?php
include("../conect.php");
if(isset($_GET['id'])&& is_numeric($_GET['id']))
{
    $id=$_GET['id'];
   
	if($stmt=$mysqli->prepare("DELETE FROM produse WHERE id=? LIMIT 1"))
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
<title>PRODUSE</title>
<link rel="stylesheet" href="css/bootstrap.min.css"/>

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
<h2> FETITE</h2>
</div>
<!--------------------------------ADAUGARE PRODUS FETITE-------------------------------->

<div id="addcollection"> 
<div id="hide">
<?php
if($error!='')
{
	echo "<div style='padding:4px;border:1px solid red'>".$error."</div>";
}
?>
<div class="container">
                <form  method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="column" >
                       
                    <label for="nume"><b>Nume</b></label>
                    <input type="text" id="nume" name="nume" required>

                    <label for="poza">Poza</label>
                    <input type="file" name="poza" id="poza" value=""  />

                    <label for="pret">Pret</label>
                    <input type="number" id="pret" name="pret" required >

                    <label for="descriere">Descriere</label>
                    <textarea name="descriere" rows="15" cols="30" id="descriere" required></textarea>

                    </div>
                    <div class="column" >
                    <label for="descmaterial">Descriere material</label>
                    <textarea name="descmaterial" rows="10" cols="30" id="descmaterial"></textarea>

                    <label for="descintretinere">Intretinere</label>
                    <textarea name="descintretinere" rows="10" cols="30" id="descintretinere"></textarea>
                    <input type="hidden" id="categorie" name="categorie" value='fetite' >

                    <label for="marimi"><b>Marimi (Despartiti marimile prin virgula!)</b></label>
                    <input type="text" id="marimi" name="marimi" required>
                  
                    </div>

                 </div><!--row-->
                    <input type="submit" value="TRIMITE">
                </form>

                </div><!--container-->
</div><!--hide-->
   <button href="addcollection.php" class="add">ADAUGA PRODUS</button>

</div> 




<!---------------------------------LISTARE PRODUSE FETITE-------------------------------->


<div class style="overflow:auto;margin-top:20px">


<?php
include("../conect.php");

if($result = $mysqli->query("SELECT * FROM produse WHERE categorie='fetite' "))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>ID</th><th>Nume</th><th>Poza</th><th>Pret</th><th>Descriere</th><th>Descriere Material</th> <th>Intretinere</th><th>Marimi</th><th>Categorie</th><th></th> <th></th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";
			echo "<td>".$row->id."</td>";
			echo "<td>".$row->nume."</td>";
            echo '<td><img class="image" src="data:image/jpeg;base64,'.base64_encode($row->poza).'" alt=""  height="150"></td>';
            echo "<td>".$row->pret."</td>";
            echo "<td>".$row->descriere."</td>";
            echo "<td>".$row->descmaterial."</td>";
            echo "<td>".$row->descintretinere."</td>";
            echo "<td>".$row->marimi."</td>";
            echo "<td>".$row->categorie."</td>";
			echo "<td><a onclick='openNav()' style='text-decoration:none;color:blue' href='updateprincess.php?id=".$row->id."'>MODIFICA</a></td>";
			echo "<td><a style='text-decoration:none;color:red' href='adminprincess.php?id=". $row->id."'>STERGE</a></td>";
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
<script src="../js/selectcustom.js"></script>
<script src="js/navtoggle.js"></script>
</body>
</html>